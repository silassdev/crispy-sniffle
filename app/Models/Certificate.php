<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Certificate extends Model
{
    protected $fillable = [
        'certificate_number',
        'course_id',
        'trainer_id',
        'student_id',
        'type',
        'notes',
        'status',
        'approved_by',
        'issued_at',
        'rejected_at'
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public static function generateNumber(): string
    {
        //Unique Human id
        return 'CERT-'.now()->format('Ymd').'-'.Str::upper(Str::random(6));
    }

    public function trainer() { return $this->belongsTo(User::class,'trainer_id'); }
    public function student() { return $this->belongsTo(User::class,'student_id'); }
    public function course()  { return $this->belongsTo(Course::class,'course_id'); }
    public function approver(){ return $this->belongsTo(User::class,'approved_by'); }
}
