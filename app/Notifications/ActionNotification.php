<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;

class ActionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $title;
    public string $message;
    public ?string $link;
    public array $meta;
    public string $level;

    /**
     * $payload: ['title'=>..., 'message'=>..., 'link'=>..., 'meta'=>[], 'level'=>'info']
     */
    public function __construct(array $payload)
    {
        $this->title = $payload['title'] ?? 'Notification';
        $this->message = $payload['message'] ?? '';
        $this->link = $payload['link'] ?? null;
        $this->meta = $payload['meta'] ?? [];
        $this->level = $payload['level'] ?? 'info';
    }

    public function via($notifiable)
    {
        $channels = ['database'];
        if (config('broadcasting.default') !== 'null') $channels[] = 'broadcast';
        // optionally add mail: if($notifiable->receives_emails) $channels[]='mail';
        return $channels;
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'link' => $this->link,
            'meta' => $this->meta,
            'level' => $this->level,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'type' => static::class,
            'data' => $this->toDatabase($notifiable),
            'created_at' => now()->toDateTimeString(),
        ]);
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->title)
            ->line($this->message)
            ->action('View', $this->link ?: url('/'))
            ->line('Thank you.');
    }
}
