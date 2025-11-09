<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class LoginForm extends Component
{
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

    try {
        $this->validate();
    } catch (\Illuminate\Validation\ValidationException $e) {
        $this->dispatch('app-toast', [
            'title' => 'Validation Error',
            'message' => implode(' - ', $e->validator->errors()->all()),
            'ttl' => 8000,
        ]);
        return;
    }

    $key = $this->throttleKey();
    if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 5)) {
        $seconds = RateLimiter::availableIn($key);
        $this->dispatch('app-toast', [
            'title' => 'Too Many Attempts',
            'message' => "Please wait {$seconds} seconds before trying again.",
            'ttl' => 6000,
        ]);
        return;
    }

    if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
        RateLimiter::hit($key, 60); // Throttle failed login attempts
        $this->dispatch('app-toast', [
            'title' => 'Login Failed',
            'message' => 'The provided credentials are incorrect.',
            'ttl' => 6000,
        ]);
        return;
    }

    RateLimiter::clear($key);
    session()->regenerate();

    $user = Auth::user();

    // Handle pending trainer scenario
    if ($user->isTrainer() && !$user->approved) {
        Auth::logout();

        // Store email in session before redirect
        session()->put('trainer_email', $this->email);

        $this->dispatch('app-toast', [
            'title' => 'Account Pending',
            'message' => 'Your trainer account is pending administrator approval.',
            'ttl' => 8000,
        ]);

        return redirect()->route('trainer.pending');
    }

    // Handle other roles
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard')
            ->with('success', 'Welcome back Admin!');
    }

    if ($user->isTrainer()) {
        return redirect()->route('trainer.dashboard')
            ->with('success', 'Welcome back Trainer!');
    }

    return redirect()->route('student.dashboard')
        ->with('success', 'Welcome back Student!');
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