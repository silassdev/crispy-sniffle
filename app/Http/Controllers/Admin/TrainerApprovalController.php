<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TrainerApprovalController extends Controller
{
    public function index()
    {
        $pending = User::where('role','trainer')->where('approved', false)->paginate(20);
        return view('admin.trainers.pending', compact('pending'));
    }

    public function approve(User $user)
    {
        if ($user->role !== 'trainer') {
            return back()->with('error','User is not a trainer');
        }

        $user->approved = true;
        $user->save();

        // Notify trainer (email/notification) — dispatch a notification here
        // $user->notify(new TrainerApprovedNotification());

        return back()->with('success','Trainer approved.');
    }
}
