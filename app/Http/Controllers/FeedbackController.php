<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Mail\FeedbackReceivedMail;
use App\Notifications\ActionNotification;

class FeedbackController extends Controller
{
    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:191',
            'email' => 'nullable|email|max:191',
            'country' => 'nullable|string|max:100',
            'message' => 'required|string|max:5000',
            'type' => 'nullable|string|max:80',
        ]);

        $fb = Feedback::create(array_merge($data, ['ip' => $request->ip()]));

        // queue mail to admins
        try {
            $admins = \App\Models\User::where('role', \App\Models\User::ROLE_ADMIN)->pluck('email')->toArray();
            if (! empty($admins)) {
                \Mail::to($admins)->queue(new FeedbackReceivedMail($fb));
            }
        } catch (\Throwable $e) {
            \Log::warning('feedback mail failed: '.$e->getMessage());
        }

        // admin-notify via notifications
        $adminsUsers = \App\Models\User::where('role', \App\Models\User::ROLE_ADMIN)->get();
        foreach ($adminsUsers as $admin) {
            $admin->notify(new ActionNotification([
                'title' => 'New feedback',
                'message' => ($fb->name ? $fb->name.' — ' : '').\Str::limit($fb->message, 80),
                'link' => route('admin.feedback'),
                'level' => 'info'
            ]));
        }

        return redirect()->back()->with('success','Feedback sent. Thank you.');
    }
}
