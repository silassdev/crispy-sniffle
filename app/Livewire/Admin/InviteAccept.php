<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\AdminInvitation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class InviteAccept extends Component
{
    public $token;
    public $email;
    public $password = '';
    public $password_confirmation = '';
    public $valid = false;
    public $invitation;

    protected function rules()
    {
        return [
            'password' => ['required','confirmed','min:8'],
        ];
    }

    /**
     * NOTE: We expect the ValidateToken middleware to verify the token
     * and attach the AdminInvitation model to the request attributes:
     * $request->attributes->set('invitation', $invitation);
     *
     * So here we read that attribute rather than re-check the DB.
     */
    public function mount($token = null)
    {
        $this->token = $token;

        // Grab the invitation object that the middleware attached.
        $inv = request()->attributes->get('invitation');

        if (! $inv instanceof AdminInvitation) {
            // middleware should already redirect, but guard anyway
            return redirect()->route('token.status', ['type' => 'invite', 'reason' => 'invalid']);
        }

        // attach and set email
        $this->invitation = $inv;
        $this->email = $inv->email;
        $this->valid = true;
    }

    public function submit()
    {
        if (! $this->valid || ! $this->invitation) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Invalid or expired invitation','ttl'=>6000]);
            return;
        }

        $this->resetValidation();
        $this->validate();

        // Create or upgrade user
        $user = User::where('email', $this->email)->first();

        if ($user) {
            // If user already exit || admin, stop
            if ($user->isAdmin()) {
                $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Account already exists as admin','ttl'=>6000]);
                return;
            }
            $user->update([
                'password' => Hash::make($this->password),
                'role' => User::ROLE_ADMIN,
            ]);
        } else {
            $user = User::create([
                'name' => explode('@', $this->email)[0],
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => User::ROLE_ADMIN,
                'approved' => true,
            ]);
        }

        // mark invitation used
        $this->invitation->markUsed();

        // auto login
        Auth::login($user);

        session()->flash('success', 'Welcome — your admin account is ready.');
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.admin.invite-accept');
    }
}
