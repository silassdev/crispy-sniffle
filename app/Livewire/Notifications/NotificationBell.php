<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Notifications\DatabaseNotification;

class NotificationBell extends Component
{
    use WithPagination;

    public $unreadCount = 0;
    public $notifications = [];
    public $show = false;
    public $perPage = 25;

    protected $listeners = [
        'notificationReceived' => 'handleIncoming',
        'markAsRead' => 'markAsRead',
    ];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        if (! auth()->check()) {
            $this->notifications = collect();
            $this->unreadCount = 0;
            return;
        }

        $user = auth()->user();
        $this->unreadCount = $user->unreadNotifications()->count();

        // fetch latest notifications (unread first)
        $this->notifications = $user->notifications()
            ->orderByRaw('CASE WHEN read_at IS NULL THEN 0 ELSE 1 END ASC')
            ->orderByDesc('created_at')
            ->limit($this->perPage)
            ->get();
    }

    /**
     * Called from JS when a new notification arrives via Echo
     * $payload is the notification JSON
     */
    public function handleIncoming($payload)
    {
        // payload may be Notification instance array
        if (! $payload) return;

        // prepend to the collection
        $collection = collect($this->notifications);
        $collection->prepend((object) $payload);
        $this->notifications = $collection->take($this->perPage)->values()->all();

        $this->unreadCount = $this->unreadCount + 1;

        // light UI feedback
        $this->dispatch('app-toast', ['title' => $payload['data']['title'] ?? 'Notification', 'message' => $payload['data']['message'] ?? '', 'ttl' => 4000]);

        // play sound via browser; front-end JS also listens to app-toast to play sound
    }

    public function toggle()
    {
        $this->show = ! $this->show;
        if ($this->show) $this->markViewportRead(); // optionally mark visible ones read
    }

    public function markViewportRead()
    {
        if (! auth()->check()) return;
        $user = auth()->user();
        // mark first page as read
        $toMark = $user->unreadNotifications()->limit($this->perPage)->pluck('id')->toArray();
        if ($toMark) {
            \DB::table('notifications')->whereIn('id', $toMark)->update(['read_at' => now()]);
            $this->loadNotifications(); // refresh counts/list
        }
    }

    public function markAsRead($id = null)
    {
        if (! auth()->check()) return;
        $user = auth()->user();
        if ($id) {
            $n = $user->notifications()->where('id', $id)->first();
            if ($n && ! $n->read_at) $n->markAsRead();
        } else {
            // mark all
            $user->unreadNotifications->markAsRead();
        }
        $this->loadNotifications();
        $this->dispatch('app-toast', ['title'=>'Marked','message'=>'Notification marked read','ttl'=>2000]);
    }

    public function render()
    {
        return view('livewire.notifications.notification-bell', [
            'notifications' => $this->notifications,
            'unreadCount' => $this->unreadCount,
            'show' => $this->show,
        ]);
    }
}
