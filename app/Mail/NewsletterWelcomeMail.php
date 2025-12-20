<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\NewsletterSubscriber;

class NewsletterWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subscriber;
    public function __construct(NewsletterSubscriber $subscriber) { $this->subscriber = $subscriber; }
    public function build() {
        return $this->subject('Thanks for subscribing')
                    ->view('emails.newsletter-welcome')
                    ->with(['subscriber' => $this->subscriber]);
    }
}
