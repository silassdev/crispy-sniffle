<?php
namespace App\Livewire\Trainer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Assessment;
use App\Models\Submission;

class SubmissionManager extends Component
{
    use WithPagination;
    public $assessmentId;
    public $filter = 'all';

    public function mount($assessmentId)
    {
        $this->assessmentId = $assessmentId;
    }

    public function markGrade($submissionId, $score)
    {
        $s = Submission::findOrFail($submissionId);
        $s->score = intval($score);
        $s->status = 'graded';
        $s->save();
        $this->dispatch('app-toast', ['title'=>'Saved','message'=>'Score saved','ttl'=>2500]);
    }

    public function render()
    {
        $query = Submission::where('assessment_id', $this->assessmentId)->latest('submitted_at');
        if ($this->filter === 'submitted') $query->where('status','submitted');
        if ($this->filter === 'graded') $query->where('status','graded');

        $subs = $query->paginate(12);
        $assessment = Assessment::findOrFail($this->assessmentId);
        return view('livewire.trainer.submission-manager', compact('subs','assessment'));
    }
}
