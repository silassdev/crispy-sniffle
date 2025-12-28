<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = \App\Models\Post::with(['author', 'tags', 'reactions', 'comments'])
            ->published()
            ->latest()
            ->take(15)
            ->get();

        if (! auth()->check()) {
            // Fetch 3 public and 3 private courses for homepage
            $publicCourses = \App\Models\Course::where('is_public', true)
                ->with('trainer')
                ->latest()
                ->take(3)
                ->get();
            
            $privateCourses = \App\Models\Course::where('is_public', false)
                ->with('trainer')
                ->latest()
                ->take(3)
                ->get();
            
            return view('home.guest', compact('posts', 'publicCourses', 'privateCourses'));
        }

        $user = auth()->user();

        if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
            return view('home.auth.admin', compact('posts'));
        }
        
        return view('home.auth.user', compact('posts', 'user'));
    }

    public function about()
    {
        return view('about');
    }

    public function pricing()
    {
        return view('pricing');
    }

    public function contribution()
    {
        return view('contribution');
    }
}