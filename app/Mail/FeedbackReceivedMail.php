<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Feedback;

class FeedbackReceivedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $feedback;
    public function __construct(Feedback $feedback) { $this->feedback = $feedback; }
    public function build() {
        return $this->subject('New feedback received')->view('emails.feedback-received')->with(['feedback'=>$this->feedback]);
    }
}
