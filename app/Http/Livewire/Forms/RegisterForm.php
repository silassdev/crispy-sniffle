<?php

namespace App\Http\Livewire\Forms;

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
    } catch (ValidationException $e) {
        $msg = implode(' - ', $e->validator->errors()->all());
        $this->dispatchBrowserEvent('app-toast', [
            'title' => 'Validation error',
            'message' => $msg,
            'ttl' => 9000
        ]);
        return;
    }
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

        try {
            if ($role === User::ROLE_TRAINER) {
                Mail::to($user->email)->queue(new TrainerApplicationReceivedMail($user));
            } else {
                Mail::to($user->email)->queue(new StudentWelcomeMail($user));
            }
        } catch (\Throwable $e) {
            \Log::warning('Registration email failed: '.$e->getMessage());
        }

        if ($role === User::ROLE_TRAINER) {
            session()->flash('trainer_email', $user->email);
            session()->flash('success', 'Application submitted. An admin will review your application.');
            return redirect()->route('trainer.pending');
        }

        Auth::login($user);
        return redirect()->route('student.dashboard')->with('success', 'Account created — welcome!');
    }

    public function render()
    {
        return view('livewire.forms.register-form');
    }
}
