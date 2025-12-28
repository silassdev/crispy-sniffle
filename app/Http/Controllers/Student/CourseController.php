<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->enrolledCourses()->latest()->get();
        return view('student.courses.index', compact('courses'));
    }
}
