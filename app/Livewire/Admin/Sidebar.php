<?php
namespace App\Http\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    // optional: expose current "view as" role if you set it in session
    public $viewAs;

    public function mount()
    {
        $this->viewAs = session('view_as', auth()->check() ? auth()->user()->role : 'student');
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
