<?php
namespace App\Livewire\Admin;
use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\AdminInvitation;
use Livewire\WithPagination;

class DashboardShell extends Component
{
    use WithPagination;
    public $section = 'overview';
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
        'students' => \App\Models\User::where('role', \App\Models\User::ROLE_STUDENT)->count(),
        'trainers' => \App\Models\User::where('role', \App\Models\User::ROLE_TRAINER)->count(),
        'admins'   => \App\Models\User::where('role', \App\Models\User::ROLE_ADMIN)->count(),
        'posts'    => \App\Models\Post::count(),
        'invites'  => \App\Models\AdminInvitation::count(),
    ];

    // recent approved trainers
    $recentApprovedTrainers = \App\Models\User::where('role', \App\Models\User::ROLE_TRAINER)
        ->where('approved', true)
        ->orderByDesc('created_at')
        ->limit(10)
        ->get();

    // explicitly pass the section property so the blade always has $section and counters
    return view('livewire.admin.dashboard-shell', [
        'counters' => $counters,
        'recentApprovedTrainers' => $recentApprovedTrainers,
        'section' => $this->section ?? 'overview',
    ]);
 }

}


