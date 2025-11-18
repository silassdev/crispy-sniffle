<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public string $role;
    public string $activeSection = 'overview';

    protected $listeners = [
        // receives broadcasts from dashboard shell when section changes
        'dashboardSectionChanged' => 'setActiveSection',
    ];

    public function mount($role = null)
    {
        $this->role = $role ?? session('view_as') ?? (auth()->user()->role ?? 'student');
    }
    
    // called from the sidebar view when an item is clicked
    public function showSection(string $section)
    {
        $this->activeSection = $section;
        $this->emitTo('admin.dashboard-shell', 'showSection', $section);
    }
       
    public function setActiveSection($section)
    {
        $section = $section ?: 'overview';
        if ($this->activeSection === $section) {
            return;
        }
        $this->activeSection = $section;
    }


    public function render()
    {
        // render the existing partial so you don't have to move markup
        return view('dashboards.partials.sidebar', [
            'viewAs' => $this->role,
            'activeSection' => $this->activeSection,
        ]);
    }
}
