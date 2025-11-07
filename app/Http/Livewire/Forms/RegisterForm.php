<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentWelcomeMail;
use App\Mail\TrainerApplicationReceivedMail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class RegisterForm extends Component
{
    public $role = 'student';
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required','confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'role' => 'required|in:student,trainer',
        ];
    }

    public function mount($role = null)
    {
        $roleFromQuery = request()->query('role');
        $role = $role ?? $roleFromQuery ?? 'student';
        $role = in_array($role, ['trainer','student']) ? $role : 'student';
        $this->role = $role;
    }

    public function submit()
 {
    $this->resetValidation();

    try {
        $this->validate();
    } catch (\Illuminate\Validation\ValidationException $e) {
        $msg = implode(' - ', $e->validator->errors()->all());
        $this->emit('appToast', ['title' => 'Validation error', 'message' => $msg, 'ttl' => 8000]);
        return;
    }

    // Determine role value to store in DB
    $roleVal = $this->role === 'trainer' ? \App\Models\User::ROLE_TRAINER : \App\Models\User::ROLE_STUDENT;
    $approved = $roleVal === \App\Models\User::ROLE_TRAINER ? false : true;

    try {
        $user = \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => \Illuminate\Support\Facades\Hash::make($this->password),
            'role' => $roleVal,
            'approved' => $approved,
        ]);
    } catch (\Throwable $e) {
        \Log::error('Registration failed: '.$e->getMessage());
        $this->emit('appToast', ['title' => 'Error', 'message' => 'Unable to create account. Try again.', 'ttl' => 7000]);
        return;
    }

    // Send queued mails (non-blocking)
    try {
        if ($roleVal === \App\Models\User::ROLE_TRAINER) {
            \Illuminate\Support\Facades\Mail::to($user->email)->queue(new \App\Mail\TrainerApplicationReceivedMail($user));
            session()->flash('trainer_email', $user->email);
            session()->flash('success', 'Application submitted. An admin will review your application.');
            return redirect()->route('trainer.pending');
        }

        // Student flow: welcome and login
        \Illuminate\Support\Facades\Mail::to($user->email)->queue(new \App\Mail\StudentWelcomeMail($user));
        \Illuminate\Support\Facades\Auth::login($user);
        return redirect()->route('student.dashboard')->with('success', 'Account created — welcome!');
    } catch (\Throwable $e) {
        // Don't break creation on mail error; fallback with toast
        \Log::warning('Mail fail after registration: '.$e->getMessage());
        $this->emit('appToast', ['title' => 'Notice', 'message' => 'Account created. Mail may have failed.', 'ttl' => 6000]);
        if ($roleVal === \App\Models\User::ROLE_TRAINER) {
            return redirect()->route('trainer.pending');
        }
        \Illuminate\Support\Facades\Auth::login($user);
        return redirect()->route('student.dashboard')->with('success', 'Account created — welcome!');
    }


    }

    public function render()
    {
        return view('livewire.forms.register-form');
    }
}
