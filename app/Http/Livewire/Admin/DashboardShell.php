<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class DashboardShell extends Component
{
    use WithPagination;

    public $section = 'overview';
    public $perPage = 10;

    // Listen for the event named "showSection"
    protected $listeners = ['showSection' => 'setSection'];

    public function setSection($name)
    {
        $this->section = $name ?: 'overview';
        $this->resetPage();
    }
    public function render()
    {
        // safe grouped counts from DB (fast)
        try {
            $rolesCounts = \DB::table('users')
                ->select('role', \DB::raw('count(*) as total'))
                ->groupBy('role')
                ->pluck('total', 'role')
                ->toArray();
        } catch (\Throwable $e) {
            \Log::error('DashboardShell rolesCounts error: '.$e->getMessage());
            $rolesCounts = [];
        }
    
        $studentKey = defined('App\Models\User::ROLE_STUDENT') ? \App\Models\User::ROLE_STUDENT : 'student';
        $trainerKey = defined('App\Models\User::ROLE_TRAINER') ? \App\Models\User::ROLE_TRAINER : 'trainer';
        $adminKey   = defined('App\Models\User::ROLE_ADMIN')   ? \App\Models\User::ROLE_ADMIN   : 'admin';
    
        $students = (int) ($rolesCounts[$studentKey] ?? $rolesCounts['student'] ?? \App\Models\User::where('role', $studentKey)->count());
        $trainers = (int) ($rolesCounts[$trainerKey] ?? $rolesCounts['trainer'] ?? \App\Models\User::where('role', $trainerKey)->count());
        $admins   = (int) ($rolesCounts[$adminKey]   ?? $rolesCounts['admin']   ?? \App\Models\User::where('role', $adminKey)->count());
    
        try {
            $posts = \App\Models\Post::count();
            $invites = \App\Models\AdminInvitation::count();
        } catch (\Throwable $e) {
            \Log::error('DashboardShell other counters error: '.$e->getMessage());
            $posts = 0; $invites = 0;
        }
    
        $counters = [
            'students' => $students,
            'trainers' => $trainers,
            'admins'   => $admins,
            'posts'    => $posts,
            'invites'  => $invites,
        ];
    
        // Log counters so you can check storage/logs/laravel.log
        \Log::info('Dashboard counters', $counters);
    
        // recent approved trainers
        try {
            $recentApprovedTrainers = \App\Models\User::where('role', $trainerKey)
                ->where('approved', true)
                ->orderByDesc('created_at')
                ->limit(10)
                ->get();
        } catch (\Throwable $e) {
            \Log::error('recentApprovedTrainers error: '.$e->getMessage());
            $recentApprovedTrainers = collect();
        }
    
        return view('livewire.admin.dashboard-shell', [
            'counters' => $counters,
            'recentApprovedTrainers' => $recentApprovedTrainers,
            'section' => $this->section ?? 'overview',
        ]);
    }
    

    
}
