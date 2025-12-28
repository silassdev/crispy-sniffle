<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Chapter extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'course_id','title','slug','description','content','order','locked'
    ];

    public function course() { return $this->belongsTo(Course::class); }
    public function completions() { return $this->hasMany(ChapterCompletion::class); }

    // ordered scope
    public function scopeOrdered($q) { return $q->orderBy('order'); }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('video')
            ->singleFile()
            ->acceptsMimeTypes(['video/mp4', 'video/mpeg', 'video/quicktime', 'video/x-msvideo']);
        
        $this->addMediaCollection('pdf')
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf']);
        
        $this->addMediaCollection('resources')->useDisk('public');
        $this->addMediaCollection('images')->useDisk('public');
    }
}
