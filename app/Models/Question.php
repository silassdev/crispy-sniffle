<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'assessment_id','type','question_text','options','correct_option','score'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function assessment() { return $this->belongsTo(Assessment::class); }
}
