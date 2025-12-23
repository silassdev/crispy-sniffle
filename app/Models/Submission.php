<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Submission extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'assessment_id','course_id','user_id','guest_email','answers','score','status','submitted_at'
    ];

    protected $casts = [
        'answers' => 'array',
        'submitted_at' => 'datetime',
    ];

    public function assessment() { return $this->belongsTo(Assessment::class); }
    public function course() { return $this->belongsTo(Course::class); }
    public function user() { return $this->belongsTo(User::class); }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('submission_files')->useDisk('public');
    }
}
