<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public $confirming = false;

    public function confirmLogout()
    {
        $this->confirming = true;
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.actions.logout');
    }
}