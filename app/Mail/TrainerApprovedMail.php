<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TrainerApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $trainer;

    public function __construct(User $trainer)
    {
        $this->trainer = $trainer;
    }

    public function build()
    {
        $subject = 'Your trainer application was approved';
        return $this->subject($subject)
                    ->view('emails.trainer_approved')
                    ->with(['trainer' => $this->trainer]);
    }
}
