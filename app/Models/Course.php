<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Course extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'course_id','trainer_id','title','slug','excerpt','description','body','tags','youtube_url','zoom_url','is_public'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_public' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function (Course $course) {
            if (empty($course->course_id)) {
                $course->course_id = 'CRS-'.Str::upper(Str::random(6));
            }
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title ?: 'course') . '-' . Str::random(4);
            }
        });
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')->withTimestamps()->withPivot(['guest_email','enrolled_at']);
    }

    public function enrollments()
    {
        return $this->hasMany(\App\Models\CourseUser::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('order');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('illustration')->singleFile();
        $this->addMediaCollection('attachments');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(800)
            ->height(450)
            ->sharpen(10)
            ->nonQueued();
    }
}
