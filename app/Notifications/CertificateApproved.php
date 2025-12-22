<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CertificateApproved extends Notification
{
    public function __construct(public $cert) {}
    public function via($notifiable) { return ['mail','database']; }
    public function toMail($notifiable)
    {
        $url = route('certificates.public', $this->cert->certificate_number);
        return (new MailMessage)
            ->subject('Your certificate is ready')
            ->greeting("Hello {$notifiable->name}")
            ->line("Your certificate ({$this->cert->type}) has been approved.")
            ->action('View certificate', $url)
            ->line('Thank you.');
    }
    public function toArray($notifiable)
    {
        return ['message'=>"Certificate {$this->cert->certificate_number} approved",'certificate_id'=>$this->cert->id];
    }
}
