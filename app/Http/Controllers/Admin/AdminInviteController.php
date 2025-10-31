<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminInvitation;
use App\Mail\AdminInviteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AdminInviteController extends Controller
{
    public function create()
    {
        return view('admin.invite'); // form to type email to invite
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $invitation = AdminInvitation::generateForEmail($request->email, Auth::id());
        Mail::to($request->email)->send(new AdminInviteMail($invitation));

        return back()->with('success','Invite sent to '.$request->email);
    }

    // invited admin clicks token link -> show form
    public function showAcceptForm($token)
    {
        $inv = AdminInvitation::where('token', $token)->firstOrFail();

        if ($inv->isExpired()) {
            return view('admin.invite-expired');
        }

        return view('auth.admin-invite-accept', ['token' => $token, 'email' => $inv->email]);
    }

    public function accept(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required','confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        $inv = AdminInvitation::where('token', $request->token)
            ->where('email', $request->email)
            ->first();

        if (! $inv || $inv->isExpired()) {
            return back()->with('error','Invalid or expired invitation token.');
        }

        // create admin user (or update if exists)
        $user = \App\Models\User::where('email', $request->email)->first();
        if (! $user) {
            $user = \App\Models\User::create([
                'name' => $request->email, // user should update name after login
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'role' => \App\Models\User::ROLE_ADMIN,
                'approved' => true,
            ]);
        } else {
            // upgrade existing user to admin (careful)
            $user->role = \App\Models\User::ROLE_ADMIN;
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
            $user->approved = true;
            $user->save();
        }

        // delete invite after consumption
        $inv->delete();

        // login the new admin
        auth()->login($user);

        return redirect()->route('admin.dashboard')->with('success','Admin account created. Please complete your profile.');
    }
}
