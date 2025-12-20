<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Job extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'company_name',
        'location',
        'employment_type',
        'salary',
        'slug',
        'is_active',
        'created_by',
        'tech_stack',
        'excerpt',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tech_stack' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function (Job $job) {
            if (empty($job->slug)) {
                $job->slug = Str::slug($job->title ?: 'job') . '-' . Str::random(6);
            }
        });
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // small logo conversion (square) - performed on collection 'company_logos'
        $this->addMediaConversion('logo_small')
            ->fit(Manipulations::FIT_CROP, 120, 120) // 120x120 pixels
            ->format(Manipulations::FORMAT_PNG)
            ->nonQueued(); // keep small conversions synchronous for immediate UI; remove for queued
    }

    public function poster()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
