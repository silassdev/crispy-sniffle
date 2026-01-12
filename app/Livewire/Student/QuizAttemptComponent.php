<?php
namespace App\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use Carbon\Carbon;

class QuizAttemptComponent extends Component
{
    public Quiz $quiz;
    public ?QuizAttempt $attempt = null;

    // answers stored as [questionId => selected] where selected is:
    // - mcq_single: integer option id
    // - mcq_multi: array of option ids
    // - short_answer: string
    public array $answers = [];

    public bool $submitting = false;

    protected $listeners = ['confirmSubmit' => 'submit'];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->loadMissing('questions.options');

        // optionally prevent repeat attempt if business requires — here we allow multiple attempts
    }

    public function start()
    {
        // create attempt record
        $this->attempt = QuizAttempt::create([
            'quiz_id' => $this->quiz->id,
            'user_id' => Auth::id(),
            'started_at' => now(),
        ]);
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Attempt started','message'=>'Good luck','ttl'=>3000]);
    }

    public function setAnswer($questionId, $value)
    {
        // Livewire will send primitives and arrays fine
        $this->answers[$questionId] = $value;
    }

    public function submit()
    {
        if (! $this->attempt) {
            return $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Start the attempt first','ttl'=>4000]);
        }
        $this->submitting = true;

        DB::beginTransaction();
        try {
            $totalScore = 0;
            $maxScore = 0;

            foreach ($this->quiz->questions as $question) {
                $qid = $question->id;
                $qPoints = $question->pivot->points ?? $question->points ?? 1;
                $maxScore += $qPoints;

                $given = $this->answers[$qid] ?? null;
                $answerRecord = [
                    'attempt_id' => $this->attempt->id,
                    'question_id' => $qid,
                    'answer' => null,
                    'score' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // scoring by type
                if ($question->type === 'mcq_single') {
                    // correct option ids
                    $correct = $question->options->where('is_correct', true)->pluck('id')->toArray();
                    $selected = (int) ($given ?: 0);
                    $answerRecord['answer'] = json_encode($selected);

                    if (in_array($selected, $correct)) {
                        $answerRecord['score'] = $qPoints;
                        $totalScore += $qPoints;
                    } else {
                        $answerRecord['score'] = 0;
                    }
                } elseif ($question->type === 'mcq_multi') {
                    $correct = $question->options->where('is_correct', true)->pluck('id')->toArray();
                    $selected = is_array($given) ? array_map('intval', $given) : [];
                    $answerRecord['answer'] = json_encode($selected);

                    // full-credit only if exact match (you can alter to partial credit)
                    sort($correct); sort($selected);
                    if ($correct === $selected) {
                        $answerRecord['score'] = $qPoints;
                        $totalScore += $qPoints;
                    } else {
                        // optional partial credit: compute intersection ratio
                        $inter = count(array_intersect($correct, $selected));
                        $partial = (int) round(($qPoints * $inter) / max(1, count($correct)));
                        $answerRecord['score'] = $partial;
                        $totalScore += $partial;
                    }
                } elseif ($question->type === 'true_false') {
                    $correct = $question->options->where('is_correct', true)->pluck('id')->first();
                    $selected = (int) ($given ?: 0);
                    $answerRecord['answer'] = json_encode($selected);
                    if ($selected && $selected == $correct) {
                        $answerRecord['score'] = $qPoints;
                        $totalScore += $qPoints;
                    } else {
                        $answerRecord['score'] = 0;
                    }
                } else {
                    // short_answer or other -> needs manual grading
                    $answerRecord['answer'] = json_encode($given);
                    $answerRecord['score'] = null; // flagged for manual grading
                }

                QuizAnswer::create($answerRecord);
            }

            $passed = null;
            if (! is_null($this->quiz->pass_mark)) {
                $percentage = $maxScore ? ($totalScore / $maxScore) * 100 : 0;
                $passed = $percentage >= $this->quiz->pass_mark;
            }

            $this->attempt->update([
                'score' => $totalScore,
                'max_score' => $maxScore,
                'passed' => $passed,
                'finished_at' => now(),
            ]);

            DB::commit();
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Submitted','message'=>'Attempt submitted','ttl'=>4000]);
            return redirect()->route('student.quiz.result', $this->attempt->id);
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Unable to submit','ttl'=>6000]);
        } finally {
            $this->submitting = false;
        }
    }

    public function render()
    {
        return view('livewire.student.quiz-attempt');
    }
}
