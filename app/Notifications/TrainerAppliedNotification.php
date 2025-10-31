<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TrainerAppliedNotification extends Notification
{
    use Queueable;

    public $user;

    public function __construct($user) { $this->user = $user; }

    public function via($notifiable) { return ['mail']; }

    public function toMail($notifiable)
    {
        $approveUrl = url('/admin/trainers/pending');
        return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject('New trainer application')
                    ->line($this->user->name.' applied as a trainer ('.$this->user->email.').')
                    ->action('Review applications', $approveUrl);
    }
}
