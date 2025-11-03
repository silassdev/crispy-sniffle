<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginForm extends Component
{
    // <-- MUST be public so Livewire can set it from the tag attribute
    public $role = 'student';
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|string',
    ];

    public function mount($role = null)
    {
        $roleFromQuery = request()->query('role');
        $role = $role ?? $roleFromQuery ?? 'student';
        $role = in_array($role, ['trainer', 'student']) ? $role : 'student';
        $this->role = $role;
    }

    public function submit()
    {
        $this->resetValidation();
        $this->validate();

        $key = $this->throttleKey();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('too_many_attempts', "Too many login attempts. Try again in {$seconds} seconds.");
            return;
        }

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], (bool)$this->remember)) {
            RateLimiter::hit($key, 60);
            $this->addError('credentials', 'The provided credentials are incorrect.');
            return;
        }

        RateLimiter::clear($key);
        session()->regenerate();

        $user = Auth::user();

        if ($user->isTrainer() && ! $user->approved) {
            Auth::logout();
            session()->flash('error', 'Your trainer account is pending approval. We will notify you by email when approved.');
            return redirect()->route('login');
        }

        if (session()->has('url.intended')) {
            return redirect()->intended(session('url.intended'));
        }

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, admin!');
        } elseif ($user->isTrainer()) {
            return redirect()->route('trainer.dashboard')->with('success', 'Welcome back, trainer!');
        }

        return redirect()->route('student.dashboard')->with('success', 'Welcome back!');
    }

    protected function throttleKey()
    {
        return Str::lower($this->email).'|'.request()->ip();
    }

    public function render()
    {
        return view('livewire.forms.login-form');
    }
}
