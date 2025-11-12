<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    // optional: expose current "view as" role if you set it in session
    public $viewAs;
    public $role; // expose $role for views that expect it

    public function mount()
    {
        $this->viewAs = session('view_as', auth()->check() ? auth()->user()->role : 'student');

        // alias so blade files that expect $role won't break
        $this->role = $this->viewAs;
    }

    // emit to the admin shell specifically so it reacts
    public function showSection(string $section)
    {
        // target the admin dashboard shell component explicitly
        $this->emitTo('admin.dashboard-shell', 'showSection', $section);
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
