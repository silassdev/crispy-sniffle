<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password = '';
    public $password_confirmation = '';
    public $valid = false;
    public $resetUser;

    protected function rules()
    {
        return [
            'password' => ['required','confirmed','min:8'],
        ];
    }

    /**
     * We expect ValidateToken middleware to attach 'reset_user' to the request attributes.
     * The middleware also verified that the token is valid for the user.
     */
    public function mount($token = null)
    {
        $this->token = $token;
        $user = request()->attributes->get('reset_user');

        if (! $user instanceof User) {
            // middleware should redirect already; guard anyway
            return redirect()->route('token.status', ['type' => 'password', 'reason' => 'invalid_or_expired']);
        }

        $this->resetUser = $user;
        $this->email = $user->email;
        $this->valid = true;
    }

    public function submit()
    {
        if (! $this->valid || ! $this->resetUser) {
            $this->dispatch('app-toast', ['title'=>'Error','message'=>'Invalid or expired reset link','ttl'=>6000]);
            return;
        }

        $this->resetValidation();
        $this->validate();

        // Use Password broker to safely reset and ensure tokens are handled correctly
        $status = Password::broker()->reset(
            ['email' => $this->email, 'password' => $this->password, 'password_confirmation' => $this->password_confirmation, 'token' => $this->token],
            function (User $user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success','Password reset successful. You may now login.');
            return redirect()->route('login');
        }

        // fallback error
        $this->dispatch('app-toast', ['title'=>'Error','message'=>'Unable to reset password. Try requesting a new reset link.','ttl'=>6000]);
        return;
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
