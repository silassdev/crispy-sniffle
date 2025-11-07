<?php
// app/Models/AdminInvitation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminInvitation extends Model
{
    protected $fillable = ['email','token','inviter_id','expires_at','used_at'];

    protected $dates = ['expires_at','used_at'];

    public static function generateFor(string $email, ?int $inviterId = null, int $daysValid = 7): self
    {
        return static::create([
            'email' => $email,
            'token' => hash('sha256', Str::random(48).microtime(true)),
            'inviter_id' => $inviterId,
            'expires_at' => Carbon::now()->addDays($daysValid),
        ]);
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function markUsed(): void
    {
        $this->used_at = now();
        $this->save();
    }
}
