<?php

namespace App\Http\Livewire\Forms;

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
            $this->dispatch('app-toast', [
                'title' => 'Validation error',
                'message' => implode(' - ', $e->validator->errors()->all()),
                'ttl' => 8000,
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
            $this->dispatch('app-toast', [
                'title' => 'Error',
                'message' => 'Unable to create account. Try again later.',
                'ttl' => 8000,
            ]);
            return;
        }

        // Trainer flow: show toast and stay on page
        if ($roleVal === User::ROLE_TRAINER) {
            $this->dispatch('app-toast', [
                'title' => 'Application submitted',
                'message' => 'An administrator will review your profile.',
                'ttl' => 8000,
            ]);
            $this->reset();
            return;
        }

        // Student flow: auto-login and then perform a server-side redirect with session flash.
        try {
            Auth::login($user);
        } catch (\Throwable $e) {
            Log::warning('RegisterForm::auto_login_failed', ['error' => $e->getMessage()]);
            // even if login fails, we'll redirect so user can re-login; keep behavior consistent
        }

        // Do NOT dispatch a Livewire toast here — return a server redirect with session flash
        return redirect()->route('student.dashboard')
            ->with('success', 'Account created — welcome!');
    }

    public function render()
    {
        return view('livewire.forms.register-form');
    }
}
