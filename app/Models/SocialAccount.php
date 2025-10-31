<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = [
        'user_id','provider_name','provider_id','provider_email','provider_raw'
    ];

    protected $casts = [
        'provider_raw' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
