<?php
namespace App\Livewire\Trainer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Assessment;

class AssessmentManager extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $courseId;

    protected $listeners = ['refreshAssessments' => '$refresh'];

    public function mount($courseId = null)
    {
        $this->courseId = $courseId;
    }

    public function createForCourse($courseId)
    {
        $this->emit('openAssessmentEditor', ['course_id' => $courseId]);
    }

    public function render()
    {
        $query = Assessment::query()->where('trainer_id', auth()->id())->latest('created_at');
        if ($this->courseId) $query->where('course_id', $this->courseId);
        $assessments = $query->paginate($this->perPage);
        return view('livewire.trainer.assessment-manager', compact('assessments'));
    }
}
