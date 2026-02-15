<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;

class CertificateRequest extends Model
{
    // Status constants
    public const STATUS_PENDING  = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public const TYPE_COURSE_COMPLETION = 'course_completion';
    public const TYPE_GRADUATION         = 'graduation';

    protected $table = 'certificate_requests';

    protected $fillable = [
        'certificate_number',
        'course_id',
        'student_id',
        'trainer_id', 
        'type',
        'notes',
        'status',
        'approved_by',
        'issued_at',
        'rejected_by',
        'rejected_at',
        'certificate_path',
    ];

    protected $casts = [
        'issued_at'   => 'datetime',
        'rejected_at' => 'datetime',
    ];

  
    protected static function booted()
    {
        static::creating(function (self $cert) {
            if (empty($cert->certificate_number)) {
                $cert->certificate_number = self::generateNumber();
            }

            if (empty($cert->status)) {
                $cert->status = self::STATUS_PENDING;
            }
        });
    }

    /**
     * Unique human-friendly certificate id.
     */
    public static function generateNumber(): string
    {
        return 'CERT-'.now()->format('Ymd').'-'.Str::upper(Str::random(6));
    }

    /* ---------------------------
     | Relationships
     |--------------------------- */
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /* ---------------------------
     | Scopes
     |--------------------------- */

    /**
     * Search across certificate_number, student name/email and course title.
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (empty($term)) {
            return $query;
        }

        $like = '%' . $term . '%';

        return $query->where(function (Builder $q) use ($like) {
            $q->where('certificate_number', 'like', $like)
              ->orWhereHas('student', fn($sq) => $sq->where('name', 'like', $like)->orWhere('email', 'like', $like))
              ->orWhereHas('course', fn($cq) => $cq->where('title', 'like', $like));
        });
    }

    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        if (empty($status) || $status === 'all') {
            return $query;
        }

        return $query->where('status', $status);
    }

    public function scopeType(Builder $query, ?string $type): Builder
    {
        if (empty($type) || $type === 'all') {
            return $query;
        }

        return $query->where('type', $type);
    }

    /* ---------------------------
     | Helpers: approve / reject
     |--------------------------- */

    /**
     * Mark certificate as approved and set approver + issued_at.
     * $approver may be a User instance or user id.
     */
    public function approve($approver = null): self
    {
        $approverId = $approver instanceof User ? $approver->id : $approver;

        $this->status      = self::STATUS_APPROVED;
        $this->approved_by = $approverId ?? $this->approved_by;
        $this->issued_at   = now();
        $this->save();

        return $this;
    }

    /**
     * Mark certificate as rejected and optionally add notes.
     * $approver may be a User instance or user id.
     */
    public function reject($approver = null, ?string $notes = null): self
    {
        $approverId = $approver instanceof User ? $approver->id : $approver;

        $this->status      = self::STATUS_REJECTED;
        $this->approved_by = $approverId ?? $this->approved_by;
        $this->rejected_at = now();
        if ($notes) {
            // append rejection note (preserve existing notes)
            $existing = $this->notes ? $this->notes . "\n\n" : '';
            $this->notes = $existing . 'Rejection note: ' . $notes;
        }
        $this->save();

        return $this;
    }

    /**
     * Convenience: is approved?
     */
    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }
}
