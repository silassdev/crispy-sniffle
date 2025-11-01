<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SocialLinkController extends Controller
{
    /**
     * Allowed providers (add/remove as you enable).
     *
     * @var array
     */
    protected $providers = ['google', 'github', 'facebook'];

    /**
     * Redirect the logged-in user to the provider to link an account.
     */
    public function redirect(Request $request, string $provider)
    {
        $provider = strtolower($provider);
        if (! in_array($provider, $this->providers)) {
            return redirect()->back()->with('error', 'Provider not supported.');
        }

        // Use stateless only if you need (mobile); for web flows stateful is fine
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle provider callback to link social account to current user.
     */
    public function callback(Request $request, string $provider)
    {
        $provider = strtolower($provider);
        if (! in_array($provider, $this->providers)) {
            return redirect()->route('profile.show')->with('error', 'Provider not supported.');
        }

        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login')->with('error', 'Please login first to link accounts.');
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Throwable $e) {
            Log::warning('Social link callback error: '.$e->getMessage());
            return redirect()->route('profile.show')->with('error', 'Could not authenticate with '.$provider.'.');
        }

        // Check if this social account is already linked to another user
        $existing = SocialAccount::where('provider_name', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if ($existing) {
            if ($existing->user_id === $user->id) {
                return redirect()->route('profile.show')->with('success', ucfirst($provider).' is already linked to your account.');
            }

            return redirect()->route('profile.show')->with('error', 'This '.$provider.' account is already linked to another user.');
        }

        // Link the account
        $user->socialAccounts()->create([
            'provider_name' => $provider,
            'provider_id' => $socialUser->getId(),
            'provider_email' => $socialUser->getEmail(),
            'provider_raw' => $socialUser->user ?? null,
        ]);

        return redirect()->route('profile.show')->with('success', ucfirst($provider).' account linked successfully.');
    }

    /**
     * Unlink a provider from the current user's account.
     * Accepts provider name via POST (safer than GET).
     */
    public function unlink(Request $request)
    {
        $request->validate([
            'provider' => 'required|string',
        ]);

        $provider = strtolower($request->input('provider'));
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login')->with('error', 'Please login to manage linked accounts.');
        }

        $sa = SocialAccount::where('user_id', $user->id)
            ->where('provider_name', $provider)
            ->first();

        if (! $sa) {
            return redirect()->route('profile.show')->with('error', ucfirst($provider).' is not linked to your account.');
        }

        $sa->delete();

        return redirect()->route('profile.show')->with('success', ucfirst($provider).' has been unlinked.');
    }
}
