<?php
namespace App\Livewire\Trainer\Quizzes;

use Livewire\Component;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;

class Builder extends Component
{
    public Course $course;
    public ?Quiz $quiz = null;

    public int $chapter_id;
    public string $title = '';
    public ?int $duration_minutes = null;

    protected $rules = [
        'chapter_id' => 'required|exists:chapters,id',
        'title' => 'required|min:3',
        'duration_minutes' => 'nullable|integer|min:1'
    ];

    public function mount(Course $course)
    {
        abort_if($course->trainer_id !== Auth::id(), 403);

        $this->course = $course;
        $this->chapter_id = $course->chapters()->first()?->id ?? 0;
    }

    public function save()
    {
        $this->validate();

        $this->quiz = Quiz::create([
            'chapter_id' => $this->chapter_id,
            'title' => $this->title,
            'duration_minutes' => $this->duration_minutes,
            'published' => false,
        ]);

        session()->flash('success', 'Quiz created');
    }

    public function render()
    {
        return view('livewire.trainer.quizzes.builder', [
            'chapters' => $this->course->chapters
        ]);
    }
}
