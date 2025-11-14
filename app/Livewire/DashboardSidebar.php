<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardSidebar extends Component
{
    public ?string $viewAs = null;
    public string $role;
    public string $activeSection = 'dashboard';

    protected $listeners = [
        'showSection' => 'showSection',
    ];

    public function mount($viewAs = null, $initial = null)
    {
        $this->viewAs = $viewAs;
        $this->role = $this->viewAs
            ?? session('view_as')
            ?? (Auth::check() ? (Auth::user()->role ?? 'student') : 'student');

        if ($initial) {
            $this->activeSection = $initial;
        }
    }

    public function showSection(string $section)
    {
        // canonicalise input
        $section = trim($section);
        $this->activeSection = $section;

        // emit to parent components/pages to handle switching main content
        $this->emitUp('dashboardSectionChanged', $section);
        $this->emit('dashboard:section-changed', $section); // global if needed
    }

    public function render()
    {
        $colors = [
            'admin'   => 'bg-indigo-600 text-white',
            'trainer' => 'bg-emerald-600 text-white',
            'student' => 'bg-sky-600 text-white',
        ];

        $bg = $colors[$this->role] ?? 'bg-gray-700 text-white';

        return view('livewire.dashboard-sidebar', [
            'role' => $this->role,
            'bg' => $bg,
        ]);
    }
}
