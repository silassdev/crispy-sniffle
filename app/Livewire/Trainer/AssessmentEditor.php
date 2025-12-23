<?php
namespace App\Livewire\Trainer;

use Livewire\Component;
use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Validation\Rule;

class AssessmentEditor extends Component
{
    public $editingId = null;
    public $course_id;
    public $title;
    public $description;
    public $type = 'quiz';
    public $total_score = 100;
    public $due_at;
    public $is_published = false;

    // question builder fields
    public $q_type = 'mcq';
    public $q_text;
    public $q_options = ['A'=>'','B'=>'','C'=>'','D'=>''];
    public $q_correct = 'A';
    public $q_score = 1;

    protected $listeners = [
        'openAssessmentEditor' => 'open',
        'openAssessmentEditor' => 'open', // handles both course create and edit id
    ];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => ['required', Rule::in(['quiz','assignment','project'])],
            'total_score' => 'required|integer|min:1',
            'due_at' => 'nullable|date',
            'is_published' => 'boolean',
            'q_text' => 'required_with:q_type|string',
            'q_type' => 'required_with:q_text|in:mcq,written',
            'q_options.*' => 'nullable|string|max:1000',
            'q_correct' => 'nullable|string|max:2',
            'q_score' => 'nullable|integer|min:1',
        ];
    }

    public function open($payload)
    {
        // payload may be ['course_id'=>X] or an id (assessment id)
        if (is_array($payload) && isset($payload['course_id'])) {
            $this->resetForm();
            $this->course_id = $payload['course_id'];
            $this->editingId = null;
            $this->dispatchBrowserEvent('focus-editor');
            return;
        }

        $id = is_array($payload) ? ($payload['id'] ?? null) : $payload;
        if (! $id) return;

        $a = Assessment::findOrFail($id);
        $this->editingId = $a->id;
        $this->course_id = $a->course_id;
        $this->title = $a->title;
        $this->description = $a->description;
        $this->type = $a->type;
        $this->total_score = $a->total_score;
        $this->due_at = optional($a->due_at)->format('Y-m-d\TH:i') ?: null;
        $this->is_published = $a->is_published;
        $this->dispatchBrowserEvent('focus-editor');
    }

    public function saveAssessment()
    {
        $this->validate();

        if ($this->editingId) {
            $a = Assessment::findOrFail($this->editingId);
        } else {
            $a = new Assessment();
            $a->trainer_id = auth()->id();
        }
        $a->course_id = $this->course_id;
        $a->title = $this->title;
        $a->description = $this->description;
        $a->type = $this->type;
        $a->total_score = $this->total_score;
        $a->due_at = $this->due_at;
        $a->is_published = (bool)$this->is_published;
        $a->save();

        $this->editingId = $a->id;
        $this->dispatch('app-toast', ['title'=>'Saved','message'=>'Assessment saved','ttl'=>3000]);
        $this->emit('refreshAssessments');
    }

    public function addQuestion()
    {
        $this->validate([
            'q_text' => 'required|string',
            'q_type' => 'required|in:mcq,written',
            'q_score' => 'required|integer|min:1',
        ]);

        if (! $this->editingId) {
            $this->dispatch('app-toast', ['title'=>'Error','message'=>'Save assessment first','ttl'=>3000]);
            return;
        }

        $q = new Question();
        $q->assessment_id = $this->editingId;
        $q->type = $this->q_type;
        $q->question_text = $this->q_text;
        $q->score = $this->q_score;
        if ($this->q_type === 'mcq') {
            $q->options = $this->q_options;
            $q->correct_option = $this->q_correct;
        }
        $q->save();

        $this->dispatch('app-toast', ['title'=>'Saved','message'=>'Question added','ttl'=>2500]);
        $this->resetQuestionForm();
        $this->emit('refreshAssessments');
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->course_id = null;
        $this->title = $this->description = null;
        $this->type = 'quiz';
        $this->total_score = 100;
        $this->due_at = null;
        $this->is_published = false;
        $this->resetQuestionForm();
    }

    public function resetQuestionForm()
    {
        $this->q_type = 'mcq';
        $this->q_text = null;
        $this->q_options = ['A'=>'','B'=>'','C'=>'','D'=>''];
        $this->q_correct = 'A';
        $this->q_score = 1;
    }

    public function render()
    {
        $questions = $this->editingId ? \App\Models\Question::where('assessment_id', $this->editingId)->get() : collect();
        return view('livewire.trainer.assessment-editor', compact('questions'));
    }
}
