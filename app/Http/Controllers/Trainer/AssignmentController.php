<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    /**
     * List assignments for trainer's courses.
     * View: resources/views/trainer/assignments/index.blade.php
     */
    public function index(Request $request)
    {
        $trainerId = Auth::id();

        $assignments = Assignment::whereHas('course', function($q) use ($trainerId) {
            $q->where('trainer_id', $trainerId);
        })->with('course')->orderByDesc('created_at')->paginate(12);

        return view('trainer.assignment.index', compact('assignments'));
    }

    /**
     * Show create form. Provide trainer's courses for selection.
     * View: resources/views/trainer/assignments/create.blade.php
     */
    public function create()
    {
        $courses = Course::where('trainer_id', Auth::id())->get();
        return view('trainer.assignment.create', compact('courses'));
    }

    /**
     * Store new assignment (single or tied to course).
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'type' => 'required|string|in:quiz,assignment,project,task',
            'due_at' => 'nullable|date',
            'max_score' => 'nullable|numeric',
            'attachment' => 'nullable|file|mimes:pdf,zip,doc,docx|max:20480'
        ]);

        $course = Course::findOrFail($request->course_id);
        if ($course->trainer_id !== Auth::id()) abort(403);

        $assignment = Assignment::create([
            'course_id' => $course->id,
            'title' => $request->title,
            'instructions' => $request->instructions,
            'type' => $request->type,
            'due_at' => $request->due_at,
            'max_score' => $request->max_score ?: 100,
            'slug' => Str::slug($request->title).'-'.Str::random(5),
        ]);

        // optional attachment via Spatie medialibrary
        if ($request->hasFile('attachment')) {
            $tmp = $request->file('attachment')->store('temp', 'public');
            $assignment->addMedia(storage_path('app/public/'.$tmp))->toMediaCollection('attachments');
            \Storage::disk('public')->delete($tmp);
        }

        session()->flash('success', 'Assignment created.');
        return redirect()->route('trainer.assignments.index');
    }

    /**
     * Show a single assignment with submissions.
     * View: resources/views/trainer/assignments/show.blade.php
     */
    public function show(Assignment $assignment)
    {
        // ensure assignment belongs to trainer
        if ($assignment->course->trainer_id !== Auth::id() && ! (Auth::user()->isAdmin() ?? false)) abort(403);

        $submissions = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->with('user')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('trainer.assignment.show', compact('assignment','submissions'));
    }

    /**
     * Show edit form for assignment.
     */
    public function edit(Assignment $assignment)
    {
        if ($assignment->course->trainer_id !== Auth::id()) abort(403);
        $courses = Course::where('trainer_id', Auth::id())->get();
        return view('trainer.assignment.edit', compact('assignment','courses'));
    }

    /**
     * Update assignment.
     */
    public function update(Request $request, Assignment $assignment)
    {
        if ($assignment->course->trainer_id !== Auth::id()) abort(403);

        $request->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'due_at' => 'nullable|date',
            'max_score' => 'nullable|numeric'
        ]);

        $assignment->update($request->only(['title','instructions','due_at','max_score']));

        if ($request->hasFile('attachment')) {
            $tmp = $request->file('attachment')->store('temp', 'public');
            $assignment->addMedia(storage_path('app/public/'.$tmp))->toMediaCollection('attachments');
            \Storage::disk('public')->delete($tmp);
        }

        session()->flash('success','Assignment updated.');
        return redirect()->route('trainer.assignments.show', $assignment);
    }

    /**
     * Delete assignment.
     */
    public function destroy(Assignment $assignment)
    {
        if ($assignment->course->trainer_id !== Auth::id()) abort(403);
        $assignment->delete();
        session()->flash('success','Assignment removed.');
        return redirect()->route('trainer.assignments.index');
    }

    /**
     * Grade a submission (ajax or post).
     */
    public function grade(Request $request, AssignmentSubmission $submission)
    {
        if ($submission->assignment->course->trainer_id !== Auth::id()) abort(403);

        $request->validate([
            'score' => 'required|numeric|min:0',
            'feedback' => 'nullable|string'
        ]);

        $submission->update([
            'score' => $request->score,
            'feedback' => $request->feedback,
            'graded_at' => now(),
            'graded_by' => Auth::id(),
        ]);

        // optionally notify student (dispatch email/job)
        session()->flash('success', 'Submission graded.');
        return back();
    }
}
