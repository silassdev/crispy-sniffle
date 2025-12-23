<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Assessment;
use Illuminate\Support\Facades\DB;

class PendingAssessments extends Component
{
    use WithPagination;

    // when used as compact widget: showAll = false, limit controls items
    public bool $showAll = false;
    public int $limit = 5;
    public int $perPage = 10;

    protected $queryString = ['page'];

    protected $listeners = [
        'assessmentSubmitted' => '$refresh',
        'refreshStudentPending' => '$refresh',
    ];

    // computed pending assessments query
    protected function pendingQuery()
    {
        if (! auth()->check()) {
            return Assessment::query()->whereRaw('0 = 1');
        }

        $userId = auth()->id();
        $courseIds = DB::table('course_user')
            ->where('user_id', $userId)
            ->pluck('course_id')
            ->toArray();

        if (empty($courseIds)) {
            return Assessment::query()->whereRaw('0 = 1');
        }

        $now = now();

        return Assessment::with('course')
            ->whereIn('course_id', $courseIds)
            ->where('is_published', true)
            ->where(function($q) use ($now) {
                $q->whereNull('due_at')->orWhere('due_at', '>=', $now);
            })
            ->whereDoesntHave('submissions', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->orderByRaw('CASE WHEN due_at IS NULL THEN 1 ELSE 0 END, due_at ASC');
    }

    // total pending count (for badge)
    public function getPendingCountProperty(): int
    {
        return $this->pendingQuery()->count();
    }

    // convenience redirect used by compact widget
    public function viewAll()
    {
        return redirect()->route('student.assessments');
    }

    public function render()
    {
        if (! auth()->check()) {
            return view('livewire.student.pending-assessments', [
                'assessments' => collect(),
            ]);
        }

        if ($this->showAll) {
            $assessments = $this->pendingQuery()->paginate($this->perPage);
        } else {
            // limited collection (no pagination)
            $assessments = $this->pendingQuery()->limit($this->limit)->get();
        }

        return view('livewire.student.pending-assessments', [
            'assessments' => $assessments,
            'count' => $this->pendingCount,
        ]);
    }
}
