<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;
use App\Mail\NewsletterWelcomeMail;
use App\Notifications\ActionNotification;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:191',
            'email' => 'required|email|max:191',
            'country' => 'nullable|string|max:100',
            'interest' => 'nullable|string|max:255',
        ]);

        $subscriber = NewsletterSubscriber::updateOrCreate(
            ['email' => $data['email']],
            array_merge($data, ['ip' => $request->ip(), 'subscribed_at' => now()])
        );

        // queued confirmation email (Make sure QUEUE_CONNECTION=database and worker runs)
        try {
            \Mail::to($subscriber->email)->queue(new NewsletterWelcomeMail($subscriber));
        } catch (\Throwable $e) {
            \Log::warning('newsletter mail queue failed: '.$e->getMessage());
        }

        // notify admins
        $admins = \App\Models\User::where('role', \App\Models\User::ROLE_ADMIN)->get();
        foreach ($admins as $admin) {
            $admin->notify(new ActionNotification([
                'title' => 'New subscriber',
                'message' => $subscriber->email.' subscribed',
                'link' => route('admin.newsletter'),
                'level' => 'info'
            ]));
        }

        return redirect()->back()->with('success','Subscribed');
    }
}
