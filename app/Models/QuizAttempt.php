<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = ['quiz_id','user_id','score','max_score','passed','started_at','finished_at'];

    public function quiz(){ return $this->belongsTo(Quiz::class); }
    public function user(){ return $this->belongsTo(User::class); }
    public function answers(){ return $this->hasMany(QuizAnswer::class,'attempt_id'); }
}
