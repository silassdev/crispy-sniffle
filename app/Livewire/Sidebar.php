<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public string $role = 'guest';
    public bool $open = true;

    public function mount()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                $this->role = 'admin';
            } elseif (auth()->user()->isTrainer()) {
                $this->role = 'trainer';
            } else {
                $this->role = 'student';
            }
        }
    }

    public function render()
    {
        return view('livewire.sidebar', [
            'role' => $this->role,
            'open' => $this->open,
        ]);
    }
}
