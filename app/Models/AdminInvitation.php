<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class AdminInvitation extends Model
{
    use HasFactory;

    protected $fillable = ['email','token','expires_at','sent_by'];

    protected $dates = ['expires_at'];

    public static function generateForEmail(string $email, int $sentBy = null, int $hours = 72)
    {
        return self::create([
            'email' => $email,
            'token' => Str::random(64),
            'sent_by' => $sentBy,
            'expires_at' => Carbon::now()->addHours($hours),
        ]);
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
