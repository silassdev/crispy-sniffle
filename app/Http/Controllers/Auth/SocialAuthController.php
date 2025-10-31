<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SocialAuthController extends Controller
{
    /**
     * Redirect to provider and store desired role in session.
     */
    public function redirectToProvider(Request $request, $provider)
    {
        $role = $request->query('role', 'student');
        if (! in_array($role, ['student','trainer'])) {
            $role = 'student';
        }
        // forbid admin creation via social
        if ($role === User::ROLE_ADMIN) {
            return redirect()->route('login')->with('error','Cannot register as admin via social login.');
        }

        session(['social_signup_role' => $role]);
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle provider callback.
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error','Social login failed: '.$e->getMessage());
        }

        // Determine intended role from session (default student)
        $role = session()->pull('social_signup_role', User::ROLE_STUDENT);
        if (! in_array($role, ['student','trainer'])) {
            $role = User::ROLE_STUDENT;
        }

        // Use the updated helper to create or find the user and supply role
        [$user, $created] = User::findOrCreateFromSocialite($provider, $socialUser, $role);

        // Send welcome/application email if user was created
        if ($created) {
            try {
                if ($user->isTrainer()) {
                    if (config('queue.default') !== 'sync') {
                        Mail::to($user->email)->queue(new \App\Mail\TrainerApplicationReceivedMail($user));
                    } else {
                        Mail::to($user->email)->send(new \App\Mail\TrainerApplicationReceivedMail($user));
                    }
                } else {
                    if (config('queue.default') !== 'sync') {
                        Mail::to($user->email)->queue(new \App\Mail\StudentWelcomeMail($user));
                    } else {
                        Mail::to($user->email)->send(new \App\Mail\StudentWelcomeMail($user));
                    }
                }
            } catch (\Throwable $e) {
                Log::error('Social mail failed: '.$e->getMessage());
            }
        }

        // If trainer and not approved, don't log them in yet
        if ($user->isTrainer() && ! $user->approved) {
            return redirect()->route('trainer.pending')->with('success','Application submitted. You will be notified when approved.');
        }

        // Otherwise, log the user in and redirect based on role
        Auth::login($user, true);

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isTrainer()) {
            return redirect()->route('trainer.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
}