<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\AdminInvitation;
use App\Mail\AdminInviteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class InviteForm extends Component
{
    public $email = '';
    public $sending = false;

    protected $rules = [
        'email' => 'required|email|unique:users,email',
    ];

    public function send()
    {
        $this->resetValidation();
        $this->validate();

        $this->sending = true;

        // generate invitation
        $invitation = AdminInvitation::generateFor($this->email, Auth::id(), 7);

        try {
            Mail::to($this->email)->queue(new AdminInviteMail($invitation));
        } catch (\Throwable $e) {
            \Log::error('Admin invite mail failed: '.$e->getMessage());
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Unable to send invite','ttl'=>6000]);
            $this->sending = false;
            return;
        }

        $this->emit('appToast', ['title'=>'Invite sent','message'=>'Invitation emailed to '.$this->email,'ttl'=>6000]);
        $this->email = '';
        $this->sending = false;
    }

    public function render()
    {
        return view('livewire.admin.invite-form');
    }
}
