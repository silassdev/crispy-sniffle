<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    protected $table = 'course_user';
    protected $fillable = ['course_id','user_id','guest_email','enrolled_at'];
    protected $casts = ['enrolled_at' => 'datetime'];

    public function user() { return $this->belongsTo(User::class); }
    public function course() { return $this->belongsTo(Course::class); }
}
