<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('trainer');

        // Search functionality
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('body', 'like', "%{$searchTerm}%")
                  ->orWhereJsonContains('tags', $searchTerm);
            });
        }

        // Filter functionality
        if ($request->filled('filter')) {
            switch ($request->filter) {
                case 'public':
                    $query->where('is_public', true);
                    break;
                case 'private':
                    $query->where('is_public', false);
                    break;
                case 'recent':
                    $query->where('created_at', '>=', now()->subDays(30));
                    break;
            }
        } else {
            // Default: show all public courses for guests, all for authenticated users
            if (!auth()->check()) {
                $query->where('is_public', true);
            }
        }

        $courses = $query->latest('created_at')->paginate(12);
        
        return view('courses.index', compact('courses'));
    }

    public function show($slug)
    {
        $course = Course::with('trainer')->where('slug', $slug)->firstOrFail();
        $user = auth()->user();
        
        // Check if user is enrolled (for private courses)
        $isEnrolled = false;
        if ($user) {
            $isEnrolled = $course->students()->where('user_id', $user->id)->exists();
        }

        // Public courses: accessible to everyone but don't show chapters for non-enrolled
        // Private courses: require login and enrollment
        if (!$course->is_public) {
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please log in to access this course.');
            }
            
            // Check if user is a student and enrolled
            if ($user->role === 'student' && !$isEnrolled) {
                return redirect()->route('courses.index')->with('error', 'You must enroll in this course to access it.');
            }
            
            // Trainers and admins can view without enrollment
            if (!in_array($user->role, ['trainer', 'admin'])) {
                if (!$isEnrolled) {
                    return redirect()->route('courses.index')->with('error', 'Access denied.');
                }
            }
        }

        // Load chapters only for enrolled students or for trainers/admins
        $chapters = collect();
        if ($isEnrolled || ($user && in_array($user->role, ['trainer', 'admin']))) {
            $chapters = $course->chapters()->ordered()->get();
            
            // Add unlock and completion status for each chapter
            if ($user) {
                $chapters->each(function($chapter) use ($user) {
                    $chapter->isUnlocked = $chapter->isUnlockedFor($user);
                    $chapter->isCompleted = $chapter->isCompletedBy($user);
                });
            }
        }

        return view('courses.show', compact('course', 'isEnrolled', 'chapters'));
    }
}
