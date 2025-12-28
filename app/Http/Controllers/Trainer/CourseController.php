<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * List courses owned by current trainer.
     * View: resources/views/trainer/courses/index.blade.php
     */
    public function index(Request $request)
    {
        $trainerId = Auth::id();
        $courses = Course::where('trainer_id', $trainerId)
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('trainer.courses.index', compact('courses'));
    }

    /**
     * Show a single course with paginated chapters.
     * View: resources/views/trainer/courses/show.blade.php
     */
    public function show(Course $course, Request $request)
    {
        $this->authorizeOwnership($course);

        $chapters = $course->chapters()->orderBy('order')->paginate(10, ['*'], 'chapters_page');

        return view('trainer.courses.show', compact('course', 'chapters'));
    }

    /**
     * Show create form.
     * View: resources/views/trainer/courses/create.blade.php
     */
    public function create()
    {
        return view('trainer.courses.create');
    }

    /**
     * Store new course.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:courses,slug',
            'description' => 'nullable|string',
            'is_public' => 'nullable|boolean',
        ]);

        $course = Course::create([
            'title' => $request->title,
            'slug' => $request->slug ?: Str::slug($request->title).'-'.Str::random(5),
            'description' => $request->description,
            'is_public' => (bool) $request->input('is_public', false),
            'trainer_id' => Auth::id(),
        ]);

        session()->flash('success', 'Course created.');
        return redirect()->route('trainer.courses.show', $course);
    }

    /**
     * Show edit form.
     */
    public function edit(Course $course)
    {
        $this->authorizeOwnership($course);
        return view('trainer.courses.edit', compact('course'));
    }

    /**
     * Update course.
     */
    public function update(Request $request, Course $course)
    {
        $this->authorizeOwnership($course);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => "nullable|string|unique:courses,slug,{$course->id}",
            'description' => 'nullable|string',
            'is_public' => 'nullable|boolean',
        ]);

        $course->update([
            'title' => $request->title,
            'slug' => $request->slug ?: $course->slug,
            'description' => $request->description,
            'is_public' => (bool) $request->input('is_public', false),
        ]);

        session()->flash('success', 'Course updated.');
        return redirect()->route('trainer.courses.show', $course);
    }

    /**
     * Delete course.
     */
    public function destroy(Course $course)
    {
        $this->authorizeOwnership($course);
        $course->delete();
        session()->flash('success', 'Course removed.');
        return redirect()->route('trainer.courses.index');
    }

    /**
     * Simple ownership check helper.
     */
    protected function authorizeOwnership(Course $course)
    {
        $user = Auth::user();
        if ($course->trainer_id !== $user->id && ! (method_exists($user,'isAdmin') && $user->isAdmin())) {
            abort(403);
        }
    }
}
