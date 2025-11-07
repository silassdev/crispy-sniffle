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
        } catch (ValidationException $e) {
            // flatten errors into a single string message
            $errors = $e->validator->errors()->all();
            $msg = implode(' - ', $errors);

            // Use session flash for toast payload (since emit/dispatchBrowserEvent are not available)
            session()->flash('app_toast', [
                'title' => 'Validation error',
                'message' => $msg,
                'ttl' => 9000,
                'level' => 'error',
            ]);

            return;
        }

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
            Log::warning('Registration email failed: '.$e->getMessage());
        }

        if ($role === User::ROLE_TRAINER) {
            // keep the trainer email (you were already doing this)
            session()->flash('trainer_email', $user->email);

            // Flash the toast payload to the session — layout JS will convert to browser event
            session()->flash('app_toast', [
                'title' => 'Application submitted',
                'message' => 'Your application is pending admin approval.',
                'ttl' => 6000,
                'level' => 'info',
            ]);

            $this->reset(['name', 'email', 'password', 'password_confirmation']);
        } else {
            // For students — optionally flash a welcome toast
            session()->flash('app_toast', [
                'title' => 'Account created',
                'message' => 'Welcome! Your account is ready.',
                'ttl' => 4000,
                'level' => 'success',
            ]);
        }

        Auth::login($user);

        if (Route::has('student.dashboard')) {
            return redirect()->route('student.dashboard')->with('success', 'Account created — welcome!');
        }

        return redirect()->route('home')->with('success', 'Account created — welcome!');
    }

    public function render()
    {
        return view('livewire.forms.register-form');
    }
}
