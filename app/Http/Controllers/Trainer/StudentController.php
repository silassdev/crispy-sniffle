<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * List students across trainer's courses (paginated).
     * View: resources/views/trainer/students/index.blade.php
     */
    public function index(Request $request)
    {
        $trainerId = Auth::id();

        // get student ids from course_user pivot for trainer's courses
        $studentQuery = \DB::table('course_user')
            ->join('courses','course_user.course_id','courses.id')
            ->join('users','course_user.user_id','users.id')
            ->where('courses.trainer_id', $trainerId)
            ->select('users.id','users.name','users.email','course_user.course_id','course_user.created_at as enrolled_at')
            ->groupBy('users.id','course_user.course_id','course_user.created_at','users.name','users.email');

        $students = $studentQuery->orderByDesc('enrolled_at')->paginate(20);

        return view('trainer.students.index', compact('students'));
    }

    /**
     * Show student profile (trainer view) and enrolled courses for this trainer.
     * View: resources/views/trainer/students/show.blade.php
     */
    public function show($id)
    {
        $trainerId = Auth::id();
        $student = User::findOrFail($id);

        // confirm student is in at least one of trainer's courses
        $exists = \DB::table('course_user')
            ->join('courses','course_user.course_id','courses.id')
            ->where('course_user.user_id', $student->id)
            ->where('courses.trainer_id', $trainerId)
            ->exists();

        if (! $exists) abort(404);

        // fetch enrollments under this trainer
        $enrollments = \DB::table('course_user')
            ->join('courses','course_user.course_id','courses.id')
            ->where('course_user.user_id', $student->id)
            ->where('courses.trainer_id', $trainerId)
            ->select('courses.id','courses.title','course_user.created_at as enrolled_at')
            ->get();

        return view('trainer.students.show', compact('student','enrollments'));
    }
}
