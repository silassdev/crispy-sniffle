<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardShell extends Component
{
    use WithPagination;

    public $section = 'overview';
    public $perPage = 10;

    // Listen for events
    protected $listeners = [
        'showSection' => 'setSection',
        'refreshDashboardCounters' => 'refreshCounters',
        'refreshCounters' => 'refreshCounters',
    ];

    public function mount()
    {
        $this->refreshCounters();
    }

    public function setSection($name)
{
    $this->section = $name ?: 'overview';
    $this->resetPage();

    // notify the frontend Livewire components
    $this->emit('dashboardSectionChanged', $this->section);

    $this->dispatchBrowserEvent('dashboard:section-changed', ['section' => $this->section]);
}


    /**
     * Refresh counters and recent trainers.
     */
    public function refreshCounters()
    {
        try {
            $rolesCounts = DB::table('users')
                ->select('role', DB::raw('count(*) as total'))
                ->groupBy('role')
                ->pluck('total', 'role')
                ->toArray();
        } catch (\Throwable $e) {
            Log::error('DashboardShell rolesCounts error: '.$e->getMessage());
            $rolesCounts = [];
        }

        $studentKey = \App\Models\User::ROLE_STUDENT;
        $trainerKey = \App\Models\User::ROLE_TRAINER;
        $adminKey   = \App\Models\User::ROLE_ADMIN;

        $students = (int) ($rolesCounts[$studentKey] ?? $rolesCounts['student'] ?? \App\Models\User::where('role', $studentKey)->count());
        $trainers = (int) ($rolesCounts[$trainerKey] ?? $rolesCounts['trainer'] ?? \App\Models\User::where('role', $trainerKey)->count());
        $admins   = (int) ($rolesCounts[$adminKey]   ?? $rolesCounts['admin']   ?? \App\Models\User::where('role', $adminKey)->count());

        try {
            $posts = \App\Models\Post::count();
        } catch (\Throwable $e) {
            Log::warning('DashboardShell posts count error: '.$e->getMessage());
            $posts = 0;
        }

        try {
            $invites = \App\Models\AdminInvitation::count();
        } catch (\Throwable $e) {
            Log::warning('DashboardShell invites count error: '.$e->getMessage());
            $invites = 0;
        }

        $this->counters = [
            'students' => $students,
            'trainers' => $trainers,
            'admins'   => $admins,
            'posts'    => $posts,
            'invites'  => $invites,
        ];

        try {
            $this->recentApprovedTrainers = \App\Models\User::where('role', $trainerKey)
                ->where('approved', true)
                ->orderByDesc('created_at')
                ->limit(10)
                ->get();
        } catch (\Throwable $e) {
            Log::error('DashboardShell recentApprovedTrainers error: '.$e->getMessage());
            $this->recentApprovedTrainers = collect();
        }

        Log::info('DashboardShell refreshed counters', $this->counters);
    }

    public function render()
    {
        $counters = [
            'students' => \App\Models\User::where('role', \App\Models\User::ROLE_STUDENT)->count(),
            'trainers' => (int) DB::table('users')->where('role', \App\Models\User::ROLE_TRAINER)->count(),
            'admins'   => (int) DB::table('users')->where('role', \App\Models\User::ROLE_ADMIN)->count(),
            'posts'    => (int) DB::table('posts')->count(),
            'invites'  => (int) DB::table('admin_invitations')->count(),
        ];

        Log::debug('dashboard counters', $counters);

        $recentApprovedTrainers = \App\Models\User::where('role', \App\Models\User::ROLE_TRAINER)
            ->where('approved', true)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('livewire.admin.dashboard-shell', [
            'counters' => $counters,
            'recentApprovedTrainers' => $recentApprovedTrainers,
            'section' => $this->section ?? 'overview',
        ]);
    }
}
