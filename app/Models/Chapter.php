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

    /**
     * Check if this chapter is unlocked for a specific user
     * First chapter is always unlocked, others require previous chapter completion
     */
    public function isUnlockedFor($user)
    {
        if (!$user) return false;
        
        // First chapter is always unlocked
        if ($this->order == 1) return true;

        // Check if previous chapter is completed
        $previousChapter = Chapter::where('course_id', $this->course_id)
            ->where('order', $this->order - 1)
            ->first();

        if (!$previousChapter) return true;

        return ChapterCompletion::where('chapter_id', $previousChapter->id)
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * Check if user has completed this chapter
     */
    public function isCompletedBy($user)
    {
        if (!$user) return false;
        
        return ChapterCompletion::where('chapter_id', $this->id)
            ->where('user_id', $user->id)
            ->exists();
    }

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
