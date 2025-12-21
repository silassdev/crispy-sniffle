<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use Livewire\WithPagination;

class NotificationsPage extends Component
{
    use WithPagination;

    public $perPage = 20;
    public $q = '';
    public $filter = 'all'; // all | unread | read 

    // bulk select
    public array $selected = [];
    public bool $selectAllOnPage = false;

    protected $listeners = ['notificationReceived' => 'refreshList'];

    public function updatingQ()
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAllOnPage = false;
    }

    public function updatingFilter()
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAllOnPage = false;
    }

    public function updatingPage()
    {
        // clear selection when navigating pages (prevent accidental bulk ops across pages)
        $this->selected = [];
        $this->selectAllOnPage = false;
    }

    public function refreshList()
    {
        $this->resetPage();
        $this->dispatch('$refresh');
    }

    /** Bulk: select all notifications on the current page */
    public function selectAllCurrentPage()
    {
        if (! auth()->check()) return;
        $query = auth()->user()->notifications()->orderByDesc('created_at');

        if ($this->filter === 'unread') $query->whereNull('read_at');
        if ($this->filter === 'read') $query->whereNotNull('read_at');

        if ($this->q) {
            $q = '%'.$this->q.'%';
            $query->whereRaw("JSON_EXTRACT(data, '$.title') LIKE ? OR JSON_EXTRACT(data, '$.message') LIKE ?", [$q, $q]);
        }

        $ids = $query->paginate($this->perPage)->pluck('id')->toArray();
        $this->selected = $ids;
        $this->selectAllOnPage = true;
    }

    public function clearSelection()
    {
        $this->selected = [];
        $this->selectAllOnPage = false;
    }

    public function bulkMarkRead()
    {
        if (! auth()->check() || empty($this->selected)) return;
        $user = auth()->user();
        \DB::table('notifications')->whereIn('id', $this->selected)->update(['read_at' => now()]);
        $this->notify('Marked', 'Selected notifications marked read.');
        $this->refreshList();
        $this->clearSelection();
    }

    public function bulkDelete()
    {
        if (! auth()->check() || empty($this->selected)) return;
        $user = auth()->user();
        $user->notifications()->whereIn('id', $this->selected)->delete();
        $this->notify('Deleted', 'Selected notifications deleted.');
        $this->refreshList();
        $this->clearSelection();
    }

    public function markAsRead($id = null)
    {
        if (! auth()->check()) return;
        $user = auth()->user();
        if ($id) {
            $notif = $user->notifications()->where('id', $id)->first();
            if ($notif) $notif->markAsRead();
        } else {
            $user->unreadNotifications->markAsRead();
        }
        $this->refreshList();
        $this->notify('Marked', 'Marked as read.');
    }

    public function delete($id)
    {
        if (! auth()->check()) return;
        $user = auth()->user();
        $n = $user->notifications()->where('id', $id)->first();
        if ($n) $n->delete();
        $this->refreshList();
        $this->notify('Deleted', 'Notification removed.');
    }

    public function markAndGo($id, $url)
    {
        if (! auth()->check()) return;
        $user = auth()->user();
        if ($id) {
            $notif = $user->notifications()->where('id', $id)->first();
            if ($notif && ! $notif->read_at) $notif->markAsRead();
        }
        $this->refreshList();
        $this->dispatch('navigate-to', ['url' => $url]);
    }

    protected function notify($title, $message)
    {
        $payload = ['title' => $title, 'message' => $message, 'ttl' => 2500];
        $this->dispatch('app-toast', ...$payload);
    }

    public function render()
    {
        if (! auth()->check()) {
            return view('livewire.notifications.notifications-page', ['items' => collect()]);
        }

        $query = auth()->user()->notifications()->orderByDesc('created_at');

        if ($this->filter === 'unread') $query->whereNull('read_at');
        if ($this->filter === 'read') $query->whereNotNull('read_at');

        if ($this->q) {
            $q = '%'.$this->q.'%';
            $query->whereRaw("JSON_EXTRACT(data, '$.title') LIKE ? OR JSON_EXTRACT(data, '$.message') LIKE ?", [$q, $q]);
        }

        $items = $query->paginate($this->perPage);

        return view('livewire.notifications.notifications-page', [
            'items' => $items,
        ]);
    }
}
