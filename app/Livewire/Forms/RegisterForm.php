<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentWelcomeMail;
use App\Mail\TrainerApplicationReceivedMail;

class RegisterForm extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = 'student'; // default; frontend can set 'trainer'
    public $loading = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required','confirmed', Rules\Password::defaults()],
            'role' => 'required|in:student,trainer',
        ];
    }

    public function submit()
    {
        $this->resetValidation();
        $this->validate();

        $role = $this->role === User::ROLE_TRAINER ? User::ROLE_TRAINER : User::ROLE_STUDENT;
        $approved = $role === User::ROLE_TRAINER ? false : true;

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $role,
            'approved' => $approved,
        ]);

        // Send welcome or pending mail (queue if configured)
        try {
            if ($role === User::ROLE_TRAINER) {
                if (config('queue.default') !== 'sync') {
                    Mail::to($user->email)->queue(new TrainerApplicationReceivedMail($user));
                } else {
                    Mail::to($user->email)->send(new TrainerApplicationReceivedMail($user));
                }
            } else {
                if (config('queue.default') !== 'sync') {
                    Mail::to($user->email)->queue(new StudentWelcomeMail($user));
                } else {
                    Mail::to($user->email)->send(new StudentWelcomeMail($user));
                }
            }
        } catch (\Throwable $e) {
            // log but don't block UX
            \Log::error('Registration email failed: '.$e->getMessage());
        }

        if ($role === User::ROLE_TRAINER) {
            session()->flash('trainer_email', $user->email);
            session()->flash('success', 'Application submitted. An admin will review your application.');
            return redirect()->route('trainer.pending');
        }

        // Student: auto-login and redirect
        Auth::login($user);
        return redirect()->route('student.dashboard')->with('success', 'Account created — welcome!');
    }

    public function render()
    {
        return view('livewire.forms.register-form');
    }
}
