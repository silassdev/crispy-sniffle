<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseUser;

class CourseEnrollmentController extends Controller
{
    public function enroll(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // if not public and user not allowed, redirect
        if (! $course->is_public && ! auth()->check()) {
            return redirect()->route('login')->with('error','You must login to enroll.');
        }

        $userId = auth()->id();

        // prevent duplicate
        $exists = \DB::table('course_user')
            ->where('course_id', $course->id)
            ->where(function($q) use ($userId) {
                $q->where('user_id', $userId)
                  ->orWhereNotNull('guest_email');
            })->exists();

        // simpler: attach if not exists for user
        $already = \DB::table('course_user')->where('course_id', $course->id)->where('user_id', $userId)->exists();
        if ($already) {
            return back()->with('success','You are already enrolled.');
        }

        \DB::table('course_user')->insert([
            'course_id' => $course->id,
            'user_id' => $userId,
            'guest_email' => null,
            'enrolled_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success','Enrolled successfully.');
    }
}
