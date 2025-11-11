<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TrainerRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $trainer;

    public function __construct(User $trainer)
    {
        $this->trainer = $trainer;
    }

    public function build()
    {
        $subject = 'Your trainer application status';
        return $this->subject($subject)
                    ->view('emails.trainer_rejected')
                    ->with(['trainer' => $this->trainer]);
    }
}
