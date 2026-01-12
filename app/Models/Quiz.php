<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['chapter_id','title','instructions','duration_minutes','pass_mark','published'];

    public function chapter(){ return $this->belongsTo(Chapter::class); }
    public function course(){ return $this->chapter ? $this->chapter->course() : null; } // convenience (use via relation)
    public function questions(){ return $this->belongsToMany(Question::class)->withPivot('position','points')->orderBy('pivot_position'); }
    public function attempts(){ return $this->hasMany(QuizAttempt::class); }
}