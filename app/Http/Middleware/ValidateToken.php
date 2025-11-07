<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AdminInvitation;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * Usage: ->middleware('validate.token:invite')
     *        ->middleware('validate.token:password')
     *
     * If token is valid the middleware attaches a model to the request attributes:
     * - For invite: 'invitation' => AdminInvitation instance
     * - For password: 'reset_user' => User instance
     *
     * If invalid/expired/used, the middleware redirects to route('token.status', [...])
     */
    public function handle(Request $request, Closure $next, string $type)
    {
        $type = strtolower($type);
        $reason = null;
        $extra = [];

        switch ($type) {
            case 'invite':
                $token = $request->route('token') ?? $request->query('token');
                $invitation = $token ? AdminInvitation::where('token', $token)->first() : null;

                if (! $invitation) {
                    $reason = 'invalid';
                } elseif ($invitation->used_at) {
                    $reason = 'used';
                    $extra['used_at'] = $invitation->used_at;
                } elseif ($invitation->expires_at && $invitation->expires_at->isPast()) {
                    $reason = 'expired';
                    $extra['expires_at'] = $invitation->expires_at;
                } else {
                    // valid: attach to request for downstream use
                    $request->attributes->set('invitation', $invitation);
                }
                break;

            case 'password':
                // password reset token typically arrives as route param and email query param
                $token = $request->route('token') ?? $request->query('token');
                $email = $request->route('email') ?? $request->query('email');

                if (! $token || ! $email) {
                    $reason = 'invalid';
                    break;
                }

                $user = User::where('email', $email)->first();

                if (! $user) {
                    $reason = 'invalid';
                    break;
                }

                // Use Laravel password broker to check token validity
                $broker = Password::broker();
                // tokenExists returns false when token is invalid or expired
                if (! $broker->tokenExists($user, $token)) {
                    $reason = 'invalid_or_expired';
                } else {
                    // valid: attach user to request
                    $request->attributes->set('reset_user', $user);
                }
                break;

            default:
                $reason = 'invalid';
                break;
        }

        if ($reason) {
            // redirect to a friendly token status page with type & reason
            return redirect()->route('token.status', [
                'type' => $type,
                'reason' => $reason,
            ])->with($extra);
        }

        return $next($request);
    }
}
