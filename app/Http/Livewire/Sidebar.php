<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public $viewAs;
    public $role;
    public $section = 'courses'; // default active section

    public function mount($viewAs = null)
    {
        $this->viewAs = $viewAs ?? session('view_as');
        $this->role = $this->viewAs ?? optional(auth()->user())->role ?? 'student';
    }

    public function showSection(string $section)
    {

        $this->section = $section;

       
        $this->emitTo(\App\Http\Livewire\Admin\DashboardShell::class, 'showSection', $section);
    }

    // computed property available in Blade as $headerBg
    public function getHeaderBgProperty()
    {
        $map = [
            'admin'   => 'bg-indigo-600 text-white',
            'trainer' => 'bg-emerald-600 text-white',
            'student' => 'bg-sky-600 text-white',
            'community'=> 'bg-amber-600 text-white',
            'courses' => 'bg-emerald-600 text-white',
        ];

        return $map[$this->section] ?? $map[$this->role] ?? 'bg-gray-700 text-white';
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
