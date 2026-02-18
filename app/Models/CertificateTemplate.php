<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CertificateTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'background_image_path', 'layout_config', 'is_active'];

    protected $casts = [
        'layout_config' => 'array',
        'is_active' => 'boolean',
    ];
}
