<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterCompletion extends Model
{
    protected $fillable = ['chapter_id','user_id','completed_at'];

    protected $casts = ['completed_at' => 'datetime'];

    public function chapter() { return $this->belongsTo(Chapter::class); }
    public function user() { return $this->belongsTo(User::class); }
}