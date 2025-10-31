<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialAuthController extends Controller
{
    /**
     * Redirect to provider.
     */
    public function redirectToProvider($provider)
    {
        // Optionally allow stateless for API/mobile: Socialite::driver($provider)->stateless()->redirect();
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
            // On error, redirect to login with toast error
            return redirect()->route('login')->with('error','Unable to login using '.$provider.': '.$e->getMessage());
        }

        // Use User::findOrCreateFromSocialite helper
        [$user, $created] = User::findOrCreateFromSocialite($provider, $socialUser);

        // If the user is a trainer and not approved, block login (unless you want to allow preview)
        if ($user->isTrainer() && ! $user->approved) {
            return redirect()->route('login')->with('error','Your trainer account is pending admin approval.');
        }

        // login the user
        Auth::login($user, true);

        // redirect to role dashboard
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isTrainer()) {
            return redirect()->route('trainer.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
}
