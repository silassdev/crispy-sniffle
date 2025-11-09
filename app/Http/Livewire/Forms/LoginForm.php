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
        } catch (ValidationException $e) {
            $msg = implode(' - ', $e->validator->errors()->all());
            $this->dispatch('app-toast', [
                'title' => 'Validation error',
                'message' => $msg,
                'ttl' => 8000
            ]);
            return;
        }

        $key = $this->throttleKey();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->dispatch('app-toast', [
                'title' => 'Too Many Attempts',
                'message' => "Too many login attempts. Try again in {$seconds} seconds.",
                'ttl' => 6000
            ]);
            return;
        }

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], (bool)$this->remember)) {
            RateLimiter::hit($key, 60);
            $this->dispatch('app-toast', [
                'title' => 'Login failed',
                'message' => 'The provided credentials are incorrect.',
                'ttl' => 6000
            ]);
            return;
        }

        RateLimiter::clear($key);
        session()->regenerate();

        $user = Auth::user();

        if ($user->isTrainer() && !$user->approved) {
    Auth::logout();
    session()->flash('trainer_email', $user->email);
    
    return redirect()->route('trainer.pending')
        ->with('message', 'Your trainer account is pending approval.');
}

        // ---- role-safe intended handling by route name ----
        $intended = session()->pull('url.intended');
        $intendedRouteName = null;

        if ($intended) {
            try {
                $requestForIntended = \Illuminate\Http\Request::create($intended);
                $route = app('router')->getRoutes()->match($requestForIntended);
                $intendedRouteName = $route->getName();
            } catch (\Throwable $e) {
                $intendedRouteName = null;
            }
        }

        $allowedForRole = function (?string $routeName, $user) : bool {
            if (! $routeName) return false;

            // Admin: allow admin.* or non-student/trainer routes
            if ($user->isAdmin()) {
                if (Str::startsWith($routeName, 'admin.')) return true;
                return ! (Str::startsWith($routeName, 'student.') || Str::startsWith($routeName, 'trainer.'));
            }

            // Trainer: allow trainer.* or non-admin routes
            if ($user->isTrainer()) {
                if (Str::startsWith($routeName, 'trainer.')) return true;
                return ! Str::startsWith($routeName, 'admin.');
            }

            // Student: allow student.* or non-admin/trainer routes
            if ($user->isStudent()) {
                if (Str::startsWith($routeName, 'student.')) return true;
                return ! (Str::startsWith($routeName, 'admin.') || Str::startsWith($routeName, 'trainer.'));
            }

            return false;
        };

        if ($intendedRouteName && $allowedForRole($intendedRouteName, $user)) {
            $this->dispatch('intended-redirect', ['url' => $intended]);
            return;
        }

        // ---- default role dashboards ----
        if ($user->isAdmin()) {
            $this->dispatch('admin-dashboard-redirect');
            $this->dispatch('app-toast', [
                'title' => 'Welcome',
                'message' => 'Welcome back, admin!',
                'ttl' => 6000
            ]);
            return;
        } elseif ($user->isTrainer()) {
            $this->dispatch('trainer-dashboard-redirect');
            $this->dispatch('app-toast', [
                'title' => 'Welcome',
                'message' => 'Welcome back, trainer!',
                'ttl' => 6000
            ]);
            return;
        }

        // Default: student
        $this->dispatch('student-dashboard-redirect');
        $this->dispatch('app-toast', [
            'title' => 'Welcome',
            'message' => 'Welcome back!',
            'ttl' => 6000
        ]);
        return;
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