<?php
namespace App\Http\Livewire\Admin;
use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\AdminInvitation;
use Livewire\WithPagination;

class DashboardShell extends Component
{
    use WithPagination;
    public $section = 'overview'; // default section
    public $perPage = 10;

    protected $listeners = ['showSection' => 'setSection'];

    public function setSection($name)
    {
        $this->section = $name ?: 'overview';
        $this->resetPage();
    }

    public function render()
    {
        // counters
        $counters = [
            'students' => User::where('role', User::ROLE_STUDENT)->count(),
            'trainers' => User::where('role', User::ROLE_TRAINER)->count(),
            'admins'   => User::where('role', User::ROLE_ADMIN)->count(),
            'posts'    => Post::count(),
            'invites'  => AdminInvitation::count(),
        ];

        // data for lists (only when needed)
        $recentApprovedTrainers = User::where('role', User::ROLE_TRAINER)
            ->where('approved', true)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('livewire.admin.dashboard-shell', compact('counters','recentApprovedTrainers'));
    }
}
