<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function unread(Request $request)
    {
        if (! auth()->check()) return response()->json(['data'=>[]], 401);

        $user = auth()->user();
        $items = $user->unreadNotifications()->orderByDesc('created_at')->limit(20)->get()->map(function($n){
            return [
                'id' => $n->id,
                'data' => $n->data,
                'created_at' => $n->created_at,
                'read_at' => $n->read_at,
            ];
        });
        return response()->json(['data' => $items]);
    }

    public function markRead(Request $request)
    {
        if (! auth()->check()) return response()->json([], 401);
        $user = auth()->user();
        $id = $request->input('id');
        if ($id) {
            $notif = $user->notifications()->where('id', $id)->first();
            if ($notif) $notif->markAsRead();
        } else {
            $user->unreadNotifications->markAsRead();
        }
        return response()->json(['ok' => true]);
    }
}
