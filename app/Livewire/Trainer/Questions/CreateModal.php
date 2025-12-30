<?php
namespace App\Livewire\Trainer\Questions;

use Livewire\Component;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use DB;

class CreateModal extends Component
{
    public $show = false;

    public $type = 'mcq_single';
    public $question_text = '';
    public $points = 1;
    public $options = []; // array of ['text'=>'','is_correct'=>false]

    protected $rules = [
        'question_text' => 'required|string|min:3',
        'type' => 'required|in:mcq_single,mcq_multi,true_false,short_answer',
        'points' => 'nullable|integer|min:1',
        'options' => 'array',
        'options.*.text' => 'required_if:type,mcq_single,mcq_multi,true_false|string',
        'options.*.is_correct' => 'boolean',
    ];

    protected $listeners = ['openQuestionModal' => 'open'];

    public function open()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->show = true;
    }

    public function resetFields()
    {
        $this->type = 'mcq_single';
        $this->question_text = '';
        $this->points = 1;
        $this->options = [
            ['text' => '', 'is_correct' => false],
            ['text' => '', 'is_correct' => false],
        ];
    }

    public function addOption()
    {
        $this->options[] = ['text'=>'', 'is_correct'=>false];
    }

    public function removeOption($index)
    {
        if (isset($this->options[$index])) {
            array_splice($this->options, $index,1);
        }
    }

    public function save()
    {
        $this->validate();

        // For true_false ensure exactly two options and one marked correct
        if ($this->type === 'true_false') {
            // normalize
            if (count($this->options) < 2) {
                $this->options = [
                    ['text' => 'True','is_correct' => false],
                    ['text' => 'False','is_correct' => false],
                ];
            }
        }

        DB::beginTransaction();
        try {
            $q = Question::create([
                'type' => $this->type,
                'question_text' => $this->question_text,
                'points' => $this->points ?? 1,
                'created_by' => Auth::id(),
            ]);

            if (in_array($this->type, ['mcq_single','mcq_multi','true_false'])) {
                foreach ($this->options as $opt) {
                    QuestionOption::create([
                        'question_id' => $q->id,
                        'text' => $opt['text'],
                        'is_correct' => !empty($opt['is_correct']),
                    ]);
                }
            }

            DB::commit();

            $this->dispatchBrowserEvent('app-toast', ['title'=>'Saved','message'=>'Question saved','ttl'=>4000]);
            $this->show = false;

            // notify parent components to refresh bank list
            $this->emitUp('questionCreated', $q->id); // or emit to window with Livewire.emit
            $this->emit('questionCreated', $q->id);
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Unable to save','ttl'=>6000]);
        }
    }

    public function render()
    {
        return view('livewire.trainer.questions.create-modal');
    }
}
