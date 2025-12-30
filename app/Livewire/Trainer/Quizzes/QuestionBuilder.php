<?php
namespace App\Livewire\Trainer\Quizzes;

class QuestionBuilder extends Component
{
    public Quiz $quiz;

    public string $search = '';

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load('questions');
    }

    public function attachQuestion($questionId)
    {
        $this->quiz->questions()->syncWithoutDetaching([
            $questionId => [
                'marks' => 1,
                'order' => $this->quiz->questions()->count() + 1
            ]
        ]);
    }

    public function removeQuestion($questionId)
    {
        $this->quiz->questions()->detach($questionId);
    }

    public function render()
    {
        return view('livewire.trainer.quizzes.question-builder', [
            'bank' => Question::where('question_text', 'like', "%{$this->search}%")
                        ->latest()
                        ->limit(20)
                        ->get()
        ]);
    }
}
