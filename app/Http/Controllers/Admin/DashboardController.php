<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{
    public function index()
    { 
        $counts =\DB::table('users')->select('role', \DB::raw('count(*) as
        total'))->groupBy('role')->pluck('total', 'role')->toArray();

        $counters = [
            'students' => $counts['student'] ?? 0,
            'trainers' => $counts['trainer'] ?? 0,
            'admins' => $counts['admin'] ?? 0,
            'posts' => \App\Models\Post::count(),

            'invites' => \App\Models\AdminInvitation::count(),
        ];
        
        
        return view('admin.dashboard', compact('counters')); 
    }
}
