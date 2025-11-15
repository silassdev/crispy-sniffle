<?php

namespace App\Livewire\Forms;

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

    // fallback payload for older Livewire versions
    public $toast = null;

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

    // normalize email early so throttleKey is predictable
    $emailNormalized = Str::lower(trim($this->email ?? ''));

    try {
        $this->validate();
    } catch (\Illuminate\Validation\ValidationException $e) {
        // re-populate Livewire error bag so @error shows
        $messages = $e->validator->errors()->getMessages();
        foreach ($messages as $field => $msgs) {
            foreach ($msgs as $m) {
                $this->addError($field, $m);
            }
        }

        $this->sendToast([
            'title' => 'Validation Error',
            'message' => implode(' - ', $e->validator->errors()->all()),
            'ttl' => 8000,
            'type' => 'error',
        ]);

        \Illuminate\Support\Facades\Log::info('LoginForm: validation failed', [
            'email' => $emailNormalized,
            'errors' => $e->validator->errors()->all(),
        ]);

        return;
    }

    // build a deterministic throttle key (email + ip)
    $key = 'login-attempt|'.$emailNormalized.'|'.request()->ip();

    // Debug log the current attempt / key
    \Illuminate\Support\Facades\Log::info('LoginForm: submit attempt', [
        'key' => $key,
        'email' => $emailNormalized,
        'ip' => request()->ip(),
    ]);

    // throttle: max 5 attempts
    $maxAttempts = 5;
    if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
        $seconds = RateLimiter::availableIn($key);
        $this->sendToast([
            'title' => 'Too Many Attempts',
            'message' => "Too many login attempts. Try again in {$seconds} second(s).",
            'ttl' => 6000,
            'type' => 'error',
        ]);

        \Illuminate\Support\Facades\Log::warning('LoginForm: locked out', [
            'key' => $key,
            'available_in' => $seconds,
        ]);

        // optionally add an error to the form
        $this->addError('email', 'Too many login attempts. Please wait '.$seconds.' seconds.');

        return;
    }

    // try to authenticate
    if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
        // mark a failed attempt for this key (decay seconds = 60)
        RateLimiter::hit($key, 60);

        // Give user a proper error message for the field
        $this->addError('password', 'The provided credentials are incorrect.');

        $this->sendToast([
            'title' => 'Login Failed',
            'message' => 'The provided credentials are incorrect.',
            'ttl' => 6000,
            'type' => 'error',
        ]);

        \Illuminate\Support\Facades\Log::info('LoginForm: auth failed', [
            'key' => $key,
            'attempts' => RateLimiter::attempts($key),
        ]);

        return;
    }

    // success -> clear attempts for this key
    RateLimiter::clear($key);
    \Illuminate\Support\Facades\Log::info('LoginForm: auth success, clearing throttle', ['key' => $key]);

    // normal post-login flow
    session()->regenerate();

    $user = Auth::user();

    if ($user->isTrainer() && !$user->approved) {
        Auth::logout();

        return redirect()->route('login')->with('error', 'Your trainer account is pending approval. Please wait for an administrator to review your application.');
    }

    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard')->with('success', 'Welcome back Admin!');
    }

    if ($user->isTrainer()) {
        return redirect()->route('trainer.dashboard')->with('success', 'Welcome back Trainer!');
    }

    return redirect()->route('student.dashboard')->with('success', 'Welcome back Student!');
}


    /**
     * Try multiple ways to notify the browser:
     * 1. dispatchBrowserEvent (modern Livewire)
     * 2. emit (common Livewire)
     * 3. fallback to setting $this->toast which the blade will output as inline script
     */
    protected function sendToast(array $payload)
    {
        // prefer dispatchBrowserEvent if it exists
        if (method_exists($this, 'dispatchBrowserEvent')) {
            $this->dispatchBrowserEvent('app-toast', $payload);
            return;
        }

        // then try emit (some versions)
        if (method_exists($this, 'emit')) {
            $this->emit('app-toast', $payload);
            return;
        }

        // fallback: store the payload; the blade view will render an inline script that triggers APP_TOAST
        $this->toast = $payload;
    }

    protected function throttleKey()
    {
        return Str::lower($this->email).'|'.request()->ip();
    }

    public function focusPassword()
    {
        // Try same approach for focus-password
        if (method_exists($this, 'dispatchBrowserEvent')) {
            $this->dispatchBrowserEvent('focus-password');
            return;
        }

        if (method_exists($this, 'emit')) {
            $this->emit('focus-password');
            return;
        }

        $this->toast = $this->toast ?? null; // no-op, we won't use toast for focus; instead we let view handle if needed
        // fallback: we can instruct client to focus by rendering a marker — handled in Blade below
        $this->dispatchBrowserFallbackEvent('focus-password');
    }

    /**
     * Optional helper to set a fallback browser event marker for the view to pick up.
     * We'll store it in a public property as a small array. (Livewire will re-render the component,
     * the Blade will output a script that picks this up).
     */
    protected function dispatchBrowserFallbackEvent(string $name, $payload = null)
    {
        // store the fallback events in a simple structure the view can render
        $existing = $this->toast ?? null;
        $this->toast = $payload ? array_merge(['event' => $name], (array) $payload) : ['event' => $name];
    }

    public function render()
    {
        return view('livewire.forms.login-form');
    }
}
