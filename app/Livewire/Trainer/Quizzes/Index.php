<?php
namespace App\Livewire\Trainer\Quizzes;

use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public Course $course;

    public function mount(Course $course)
    {
        abort_if($course->trainer_id !== Auth::id(), 403);
        $this->course = $course->load(['chapters.quizzes']);
    }

    public function render()
    {
        return view('livewire.trainer.quizzes.index');
    }
}
