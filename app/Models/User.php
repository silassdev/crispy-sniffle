<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Roles
    public const ROLE_STUDENT = 'student';
    public const ROLE_TRAINER = 'trainer';
    public const ROLE_ADMIN   = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * Add 'role' and 'approved' so controllers can set them.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'approved',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attribute casts.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'approved' => 'boolean',
    ];

    /* ----------------------
       Role helper methods
       ---------------------- */

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isTrainer(): bool
    {
        return $this->role === self::ROLE_TRAINER;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    /* ----------------------
       course accounts relation
       ---------------------- */
    public function courses() {
    return $this->hasMany(\App\Models\Course::class, 'trainer_id');
     }

    /* ----------------------
       Social accounts relation
       ---------------------- */

    public function socialAccounts()
    {
        return $this->hasMany(\App\Models\SocialAccount::class);
    }

    /* --------------------------------------------------
       Helper: find or create user from Socialite response
       -------------------------------------------------- */
    public static function findOrCreateFromSocialite($provider, $socialUser, $desiredRole = null)
    {
        $providerId = $socialUser->getId();
        $email = $socialUser->getEmail();
        $name = $socialUser->getName() ?? $socialUser->getNickname() ?? ($email ? explode('@', $email)[0] : 'User');

        // 1) existing social account
        $sa = \App\Models\SocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerId)
            ->first();

        if ($sa) {
            return [$sa->user, false];
        }

        // 2) existing user by email -> link
        if ($email) {
            $user = self::where('email', $email)->first();
            if ($user) {
                $user->socialAccounts()->create([
                    'provider_name' => $provider,
                    'provider_id' => $providerId,
                    'provider_email' => $email,
                    'provider_raw' => $socialUser->user ?? null,
                ]);
                return [$user, false];
            }
        }

         // 3) create new user with desired role (default to student)
        $role = in_array($desiredRole, [self::ROLE_STUDENT, self::ROLE_TRAINER]) ? $desiredRole : self::ROLE_STUDENT;
        $approved = $role === self::ROLE_TRAINER ? false : true;

        $user = self::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make(Str::random(24)),
            'role' => $role,
            'approved' => $approved,
        ]);

        $user->socialAccounts()->create([
            'provider_name' => $provider,
            'provider_id' => $providerId,
            'provider_email' => $email,
            'provider_raw' => $socialUser->user ?? null,
        ]);

        return [$user, true];
    }
}
