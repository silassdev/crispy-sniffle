<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class AssessmentSubmission extends Component
{
    use WithFileUploads;

    public int $assessmentId;
    public ?Assessment $assessment = null;
    public $questions; // collection
    public ?Submission $existingSubmission = null;

    // quiz answers: [questionId => 'A']
    public array $answers = [];

    // for assignment: written answers keyed by question id
    public array $writtenAnswers = [];

    // file for assignment or project
    public $file;

    public bool $submitting = false;

    protected function rules(): array
    {
        $rules = [];
        if ($this->assessment) {
            if ($this->assessment->type === 'quiz') {
                $rules['answers'] = 'required|array';
            } elseif ($this->assessment->type === 'assignment') {
                // written answers required (for each written question)
                $rules['writtenAnswers'] = 'required|array';
                $rules['file'] = 'nullable|file|mimes:pdf,zip|max:10240'; // 10MB
            } elseif ($this->assessment->type === 'project') {
                $rules['file'] = 'required|file|mimes:pdf,zip|max:15360'; // 15MB
            }
        }
        return $rules;
    }

    public function mount(int $assessmentId)
    {
        $this->assessmentId = $assessmentId;
        $this->loadAssessment();
    }

    protected function loadAssessment()
    {
        $this->assessment = Assessment::with('questions')->find($this->assessmentId);

        if (! $this->assessment) {
            abort(404);
        }

        $this->questions = $this->assessment->questions()->orderBy('id')->get();

        if (! auth()->check()) {
            $this->existingSubmission = null;
            return;
        }

        $this->existingSubmission = Submission::where('assessment_id', $this->assessment->id)
            ->where('user_id', auth()->id())
            ->latest('submitted_at')
            ->first();

        if ($this->existingSubmission && $this->existingSubmission->answers) {
            $this->answers = (array) $this->existingSubmission->answers;
            // for written answers populate writtenAnswers (if any)
            $this->writtenAnswers = (array) $this->existingSubmission->answers;
        }
    }

    public function updatedFile()
    {
        $this->validateOnly('file', $this->rules());
    }

    public function submitQuiz()
    {
        if (! auth()->check()) {
            $this->dispatch('app-toast', ['title' => 'Unauthorized','message' => 'Please login to submit','ttl'=>4000]);
            return;
        }

        $this->submitting = true;
        $this->validateOnly('answers', $this->rules());

        $score = 0;
        foreach ($this->questions as $q) {
            if ($q->type !== 'mcq') continue;
            $given = Arr::get($this->answers, $q->id);
            if ($given && $q->correct_option && strtoupper($given) === strtoupper($q->correct_option)) {
                $score += (int) $q->score;
            }
        }

        $submission = Submission::create([
            'assessment_id' => $this->assessment->id,
            'course_id' => $this->assessment->course_id,
            'user_id' => auth()->id(),
            'answers' => $this->answers,
            'score' => $score,
            'status' => 'graded',
            'submitted_at' => now(),
        ]);

        $this->existingSubmission = $submission;
        $this->submitting = false;
        $this->dispatch('app-toast', ['title' => 'Submitted', 'message' => "Quiz submitted. Score: {$score}", 'ttl'=>5000]);
        $this->emitSelf('$refresh');
    }

    public function submitAssignment()
    {
        if (! auth()->check()) {
            $this->dispatch('app-toast', ['title' => 'Unauthorized','message' => 'Please login to submit','ttl'=>4000]);
            return;
        }

        $this->submitting = true;
        $this->validate($this->rules());

        $payloadAnswers = $this->writtenAnswers;

        $submission = Submission::create([
            'assessment_id' => $this->assessment->id,
            'course_id' => $this->assessment->course_id,
            'user_id' => auth()->id(),
            'answers' => $payloadAnswers,
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        if ($this->file) {
            $tmp = $this->file->store('temp', 'public');
            $submission->addMedia(storage_path('app/public/'.$tmp))->toMediaCollection('submission_files');
            \Storage::disk('public')->delete($tmp);
        }

        $this->existingSubmission = $submission;
        $this->submitting = false;
        $this->dispatch('app-toast', ['title' => 'Submitted','message' => 'Assignment submitted. Trainer will grade.', 'ttl'=>5000]);
        $this->resetFormInputs();
        $this->emitSelf('$refresh');
    }

    public function submitProject()
    {
        if (! auth()->check()) {
            $this->dispatch('app-toast', ['title' => 'Unauthorized','message' => 'Please login to submit','ttl'=>4000]);
            return;
        }

        $this->submitting = true;
        $this->validate($this->rules());

        $submission = Submission::create([
            'assessment_id' => $this->assessment->id,
            'course_id' => $this->assessment->course_id,
            'user_id' => auth()->id(),
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        $tmp = $this->file->store('temp', 'public');
        $submission->addMedia(storage_path('app/public/'.$tmp))->toMediaCollection('submission_files');
        \Storage::disk('public')->delete($tmp);

        $this->existingSubmission = $submission;
        $this->submitting = false;
        $this->dispatch('app-toast', ['title' => 'Submitted','message' => 'Project uploaded. Trainer will review.', 'ttl'=>5000]);
        $this->resetFormInputs();
        $this->emitSelf('$refresh');
    }

    protected function resetFormInputs()
    {
        $this->file = null;
        $this->answers = [];
        $this->writtenAnswers = [];
        $this->resetValidation();
    }

    public function render()
    {
        // Basic access guard for unpublished assessment
        if ($this->assessment && ! $this->assessment->is_published) {
            // show only to trainer/admin
            if (! (auth()->check() && (auth()->id() === $this->assessment->trainer_id || auth()->user()->isAdmin()))) {
                return view('livewire.student.assessment-submission', ['blocked' => true]);
            }
        }

        // prepare question view data
        return view('livewire.student.assessment-submission', [
            'blocked' => false,
        ]);
    }
}
