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
        $this->role = in_array($role, ['trainer','student']) ? $role : 'student';
    }

    public function submit()
    {
        $this->resetValidation();

        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $msg = implode(' - ', $e->validator->errors()->all());
            Log::info('RegisterForm::validation_failed', ['errors' => $e->validator->errors()->all()]);
            $this->dispatch('app-toast', [
                'title' => 'Validation error',
                'message' => $msg,
                'ttl' => 8000
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
                'ttl' => 8000
            ]);
            return;
        }

        // Trainer flow: don't auto-login, show toast and redirect with browser event
        if ($roleVal === User::ROLE_TRAINER) {
            $this->dispatch('app-toast', [
                'title' => 'Application submitted',
                'message' => 'An administrator will review your profile.',
                'ttl' => 8000
            ]);
            $this->dispatch('trainer-pending-redirect');
            $this->reset(); // Clear form fields
            return;
        }

        // Student flow: auto-login and go to student dashboard
        try {
            Auth::login($user);
        } catch (\Throwable $e) {
            Log::warning('RegisterForm::auto_login_failed', ['error' => $e->getMessage()]);
        }

        $this->dispatch('app-toast', [
            'title' => 'Registration successful',
            'message' => 'Account created — welcome!',
            'ttl' => 5000
        ]);
        $this->dispatch('student-dashboard-redirect');
        return;
    }

    public function render()
    {
        return view('livewire.forms.register-form');
    }
}