<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    /**
     * Display aggregated scores for trainer's courses.
     * View: resources/views/trainer/scores/index.blade.php
     */
    public function index(Request $request)
    {
        $trainerId = Auth::id();

        // aggregation: per-course average score and submissions
        $courses = Course::where('trainer_id', $trainerId)->get();

        $stats = [];
        foreach ($courses as $course) {
            $assignments = $course->assignments()->pluck('id')->toArray();

            if (empty($assignments)) {
                $stats[$course->id] = [
                    'course' => $course,
                    'avg_score' => null,
                    'submission_count' => 0,
                ];
                continue;
            }

            $row = DB::table('assignment_submissions')
                ->selectRaw('AVG(score) as avg_score, COUNT(*) as submission_count')
                ->whereIn('assignment_id',$assignments)
                ->first();

            $stats[$course->id] = [
                'course' => $course,
                'avg_score' => $row->avg_score,
                'submission_count' => $row->submission_count,
            ];
        }

        return view('trainer.scores.index', compact('stats','courses'));
    }

    /**
     * Show per-assignment or per-student scores.
     * View: resources/views/trainer/scores/show.blade.php
     * Accepts query params: course_id or assignment_id or student_id
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->query('course_id');
        $assignmentId = $request->query('assignment_id');
        $studentId = $request->query('student_id');

        // basic routing logic
        if ($assignmentId) {
            $assignment = Assignment::findOrFail($assignmentId);
            if ($assignment->course->trainer_id !== $user->id) abort(403);

            $submissions = $assignment->submissions()->with('user')->paginate(20);
            return view('trainer.scores.show', compact('assignment','submissions'));
        }

        if ($courseId && $studentId) {
            $course = Course::findOrFail($courseId);
            if ($course->trainer_id !== $user->id) abort(403);

            // compute student's scores for assignments in course
            $submissions = \DB::table('assignment_submissions')
                ->join('assignments','assignment_submissions.assignment_id','assignments.id')
                ->where('assignments.course_id', $course->id)
                ->where('assignment_submissions.user_id', $studentId)
                ->select('assignments.id as assignment_id','assignments.title','assignment_submissions.score','assignment_submissions.graded_at')
                ->get();

            return view('trainer.scores.show', compact('course','submissions'));
        }

        abort(400, 'Insufficient parameters.');
    }
}
