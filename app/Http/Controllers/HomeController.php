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
            return view('home.guest', compact('posts'));
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