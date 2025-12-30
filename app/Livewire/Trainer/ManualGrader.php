<?php

namespace App\Livewire\Trainer;

use Livewire\Component;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManualGrader extends Component
{
    public int $attemptId;
    public QuizAttempt $attempt;
    public $ungraded = []; // [answerId => ['score' => int]]

    protected $listeners = ['openManualGrader' => 'open'];

    public function mount($attemptId = null)
    {
        if ($attemptId) {
            $this->open($attemptId);
        }
    }

    public function open($attemptId)
    {
        $this->attemptId = (int)$attemptId;
        $this->attempt = QuizAttempt::with('quiz.chapter.course','answers.question')->findOrFail($this->attemptId);

        // permission check: trainer of course or admin
        $user = Auth::user();
        $isTrainer = optional($this->attempt->quiz->chapter->course)->trainer_id === $user->id;
        $isAdmin   = method_exists($user, 'isAdmin') ? $user->isAdmin() : ($user->role === \App\Models\User::ROLE_ADMIN);
        if (! ($isTrainer || $isAdmin)) abort(403);

        // prepare ungraded answers
        $this->ungraded = [];
        foreach ($this->attempt->answers as $ans) {
            if (is_null($ans->score)) {
                $this->ungraded[$ans->id] = ['score' => 0];
            }
        }

        $this->dispatchBrowserEvent('open-manual-grader'); // frontend can show modal
    }

    public function setScore($answerId, $score)
    {
        if (! isset($this->ungraded[$answerId])) return;
        $this->ungraded[$answerId]['score'] = (int) $score;
    }

    public function save()
    {
        if (empty($this->ungraded)) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Info','message'=>'No ungraded answers','ttl'=>3000]);
            return;
        }

        DB::beginTransaction();
        try {
            $totalAdded = 0;
            $maxAdded = 0;
            foreach ($this->ungraded as $answerId => $payload) {
                $score = (int)($payload['score'] ?? 0);
                $ans = QuizAnswer::find($answerId);
                if (! $ans) continue;

                // update answer score
                $ans->score = $score;
                $ans->save();

                $totalAdded += $score;
                // determine maxFromQuestion: pivot or question points
                $maxForQuestion = $ans->question->pivot->points ?? $ans->question->points ?? 1;
                $maxAdded += $maxForQuestion;
            }

            // recalc attempt totals from DB
            $answers = $this->attempt->answers()->get();
            $scoreSum = $answers->whereNotNull('score')->sum('score');
            $maxSum = $answers->sum(function($a){
                return $a->question->pivot->points ?? $a->question->points ?? 1;
            });

            $passed = null;
            if (! is_null($this->attempt->quiz->pass_mark)) {
                $percentage = $maxSum ? ($scoreSum / $maxSum) * 100 : 0;
                $passed = $percentage >= $this->attempt->quiz->pass_mark;
            }

            $this->attempt->update([
                'score' => $scoreSum,
                'max_score' => $maxSum,
                'passed' => $passed
            ]);

            DB::commit();
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Saved','message'=>'Manual grading saved','ttl'=>4000]);
            // refresh view
            $this->emit('refreshResultView', $this->attemptId);
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Unable to save grading','ttl'=>6000]);
        }
    }

    public function render()
    {
        return view('livewire.trainer.manual-grader', [
            'attempt' => $this->attempt ?? null
        ]);
    }
}
