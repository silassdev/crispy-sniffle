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

    // basic validation
    try {
        $this->validate();
    } catch (\Illuminate\Validation\ValidationException $e) {
        $msg = implode(' - ', $e->validator->errors()->all());
        Log::info('LoginForm::validation_failed', ['email'=>$this->email, 'role'=>$this->role, 'errors'=>$e->validator->errors()->all()]);
        session()->flash('error', $msg);
        return redirect()->route('login', ['role' => $this->role]);
    }

    $email = $this->email;
    $password = $this->password;

    Log::info('LoginForm::attempt', ['email'=>$email, 'role'=>$this->role, 'ip'=>request()->ip()]);

    // Find user first so we can log exact reason
    $user = User::where('email', $email)->first();

    if (! $user) {
        Log::warning('LoginForm::no_user', ['email'=>$email]);
        session()->flash('error', 'The provided credentials are incorrect.');
        return redirect()->route('login', ['role' => $this->role]);
    }

    // Log user basic info (not password)
    Log::info('LoginForm::user_found', ['id'=>$user->id, 'email'=>$user->email, 'role'=>$user->role, 'approved'=>$user->approved]);

    // check password explicitly
    if (! Hash::check($password, $user->password)) {
        Log::warning('LoginForm::bad_password', ['email'=>$email]);
        session()->flash('error', 'The provided credentials are incorrect.');
        return redirect()->route('login', ['role' => $this->role]);
    }

    // At this point password is correct. Check trainer approval
    if ($user->isTrainer() && ! $user->approved) {
        Log::info('LoginForm::trainer_not_approved', ['email'=>$email]);
        // ensure user is not logged in
        auth()->logout();
        session()->flash('error', 'Your trainer account is pending approval. We will notify you by email when approved.');
        return redirect()->route('login', ['role' => 'trainer']);
    }

    // If role param was supplied ensure user matches requested role — defend against cross-role login
    if (in_array($this->role, ['trainer','student']) && $user->role !== $this->role) {
        Log::warning('LoginForm::role_mismatch', ['email'=>$email, 'requested'=>$this->role, 'actual'=>$user->role]);
        session()->flash('error', 'Account role mismatch. Try the correct login option.');
        return redirect()->route('login');
    }

    // All checks passed. Log in user
    auth()->login($user, (bool)$this->remember);
    session()->regenerate();

    Log::info('LoginForm::login_success', ['id'=>$user->id, 'email'=>$user->email, 'role'=>$user->role]);

    // redirect to the correct dashboard
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard')->with('success', 'Welcome back, admin!');
    } elseif ($user->isTrainer()) {
        return redirect()->route('trainer.dashboard')->with('success', 'Welcome back, trainer!');
    } else {
        return redirect()->route('student.dashboard')->with('success', 'Welcome back!');
    }
  }

    public function render()
    {
        return view('livewire.forms.register-form');
    }
}
