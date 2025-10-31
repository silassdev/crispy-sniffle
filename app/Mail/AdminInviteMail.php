<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\AdminInvitation;

class AdminInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public AdminInvitation $invitation;

    public function __construct(AdminInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        $acceptUrl = route('admin.invite.accept', ['token' => $this->invitation->token]);

        return $this->subject('You have been invited to be an Admin')
                    ->view('emails.admin-invite')
                    ->with([
                        'acceptUrl' => $acceptUrl,
                        'email' => $this->invitation->email,
                        'expires_at' => $this->invitation->expires_at,
                    ]);
    }
}
