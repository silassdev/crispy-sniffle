<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_public', true)->latest('created_at')->paginate(12);
        return view('courses.index', compact('courses'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        if (! $course->is_public && ! auth()->check()) {
            return redirect()->route('login')->with('error', 'Oops — you need to login to access this resource.');
        }

        return view('courses.show', compact('course'));
    }
}
