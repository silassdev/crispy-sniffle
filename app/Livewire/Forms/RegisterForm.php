<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterForm extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = 'student';

    // fallback payload for older Livewire versions
    public $toast = null;

    protected $rules = [
        'name' => 'required|string|max:190',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|confirmed|min:8',
        'role' => 'nullable|string',
    ];

    public function mount($role = null)
    {
        $roleFromQuery = request()->query('role');
        $role = $role ?? $roleFromQuery ?? 'student';
        $this->role = in_array($role, ['trainer', 'student']) ? $role : 'student';
    }

    public function submit()
    {
        $this->resetValidation();

        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // repopulate Livewire error bag so @error() works
            $messages = $e->validator->errors()->getMessages();
            foreach ($messages as $field => $msgs) {
                foreach ($msgs as $m) {
                    $this->addError($field, $m);
                }
            }

            $this->sendToast([
                'title' => 'Validation error',
                'message' => implode(' - ', $e->validator->errors()->all()),
                'ttl' => 8000,
                'type' => 'error',
            ]);

            return;
        }

        $roleVal = $this->role === 'trainer' ? User::ROLE_TRAINER : User::ROLE_STUDENT;
        $approved = $roleVal === User::ROLE_TRAINER ? false : true;

        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => $roleVal,
                'approved' => $approved,
            ]);
        } catch (\Throwable $e) {
            Log::error('RegisterForm::create_failed', ['error' => $e->getMessage()]);

            $this->sendToast([
                'title' => 'Error',
                'message' => 'Unable to create account. Try again later.',
                'ttl' => 8000,
                'type' => 'error',
            ]);
            return;
        }

        // Trainer flow: show toast and reset the form (stay on page)
        if ($roleVal === User::ROLE_TRAINER) {
            $this->sendToast([
                'title' => 'Application submitted',
                'message' => 'An administrator will review your profile.',
                'ttl' => 8000,
                'type' => 'success',
            ]);

            $this->reset(); // clear fields & validation
            return;
        }

        // Student flow: auto-login and then perform a server-side redirect with session flash.
        try {
            Auth::login($user);
        } catch (\Throwable $e) {
            Log::warning('RegisterForm::auto_login_failed', ['error' => $e->getMessage()]);
            // Continue: we'll redirect regardless
        }

        return redirect()->route('student.dashboard')
            ->with('success', 'Account created — welcome!');
    }

    /**
     * Try multiple ways to notify the browser:
     * 1. dispatchBrowserEvent (modern Livewire)
     * 2. emit (common Livewire)
     * 3. fallback to setting $this->toast which the blade will output as inline script
     */
    protected function sendToast(array $payload)
    {
        if (method_exists($this, 'dispatchBrowserEvent')) {
            $this->dispatchBrowserEvent('app-toast', $payload);
            return;
        }

        if (method_exists($this, 'emit')) {
            $this->emit('app-toast', $payload);
            return;
        }

        // fallback: store the payload so the component view can render an inline script
        $this->toast = $payload;
    }

    public function render()
    {
        return view('livewire.forms.register-form');
    }
}
