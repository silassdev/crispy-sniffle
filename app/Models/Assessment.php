<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'course_id','trainer_id','title','description','type','total_score','is_published','due_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'due_at' => 'datetime',
    ];

    public function course() { return $this->belongsTo(Course::class); }
    public function trainer() { return $this->belongsTo(User::class, 'trainer_id'); }
    public function questions() { return $this->hasMany(Question::class); }
    public function submissions() { return $this->hasMany(Submission::class); }
}
