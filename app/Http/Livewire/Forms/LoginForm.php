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
            $this->dispatchBrowserEvent('app-toast', [
                'title' => 'Validation error',
                'message' => $msg,
                'ttl' => 8000
            ]);
            return;
        }

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
            return redirect()->to($intended);
        }

        // ---- default role dashboards ----
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
