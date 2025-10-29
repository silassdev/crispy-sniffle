<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Featured courses (if model exists)
        $featuredCourses = Cache::remember('home.featured_courses', 60, function () {
            if (class_exists(\App\Models\Course::class)) {
                // adjust query to your schema: e.g. published/visibility flags
                try {
                    return \App\Models\Course::with('trainer')
                        ->where('visibility', 'public') // optional: only if you have this column
                        ->latest()
                        ->take(6)
                        ->get();
                } catch (\Throwable $e) {
                    // fallback if columns differ
                    return \App\Models\Course::latest()->take(6)->get();
                }
            }
            return collect();
        });

        // Latest community posts (if model exists)
        $latestPosts = Cache::remember('home.latest_posts', 60, function () {
            if (class_exists(\App\Models\CommunityPost::class)) {
                return \App\Models\CommunityPost::with('user')
                    ->latest()
                    ->take(6)
                    ->get();
            }
            return collect();
        });

        // Example: pass a small stats block (users count) if available
        $counts = Cache::remember('home.counts', 60, function () {
            $data = [
                'users' => null,
                'courses' => null,
                'posts' => null,
            ];

            try {
                $data['users'] = class_exists(\App\Models\User::class) ? \App\Models\User::count() : null;
                $data['courses'] = class_exists(\App\Models\Course::class) ? \App\Models\Course::count() : null;
                $data['posts'] = class_exists(\App\Models\CommunityPost::class) ? \App\Models\CommunityPost::count() : null;
            } catch (\Throwable $e) {
                // ignore errors, keep counts null
            }

            return $data;
        });

        // Optional: capture incoming query (search/filter)
        $q = $request->query('q');

        return view('home', compact('featuredCourses', 'latestPosts', 'counts', 'q'));
    }
}
