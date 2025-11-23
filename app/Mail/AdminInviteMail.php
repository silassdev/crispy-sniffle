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

        return $this->subject('You were invited as Admin')
                    ->view('emails.admin_invite')
                    ->with([
                        'email' => $this->invitation->email,
                        'acceptUrl' => $acceptUrl,
                        'expiresAt' => $this->invitation->expires_at,
                    ]);
    }
}
