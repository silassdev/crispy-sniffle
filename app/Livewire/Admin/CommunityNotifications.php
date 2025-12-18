<?php
namespace App\Livewire\Admin;

use Livewire\Component;

class CommunityNotifications extends Component
{
    public function render()
    {
        $user = auth()->user();
        $unread = $user ? $user->unreadNotifications()->limit(10)->get() : collect();
        return view('livewire.admin.community-notifications', ['unread' => $unread]);
    }
}
