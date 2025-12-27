<?php
namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\ChapterCompletion;
use Illuminate\Support\Facades\DB;

class ChapterViewer extends Component
{
    public Course $course;
    public int $currentOrder;
    public ?Chapter $chapter = null;
    public bool $completed = false;

    protected $listeners = ['refreshChapter' => '$refresh'];

    public function mount($courseId, $order = 1)
    {
        $this->course = Course::findOrFail($courseId);
        $this->currentOrder = (int)$order;
        $this->loadChapter();
    }

    protected function loadChapter()
    {
        $this->chapter = $this->course->chapters()->where('order', $this->currentOrder)->firstOrFail();

        $this->completed = ChapterCompletion::where('chapter_id', $this->chapter->id)
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function canOpenOrder($order)
    {
        // next unlocked only if previous completed or order == 1
        if ($order <= 1) return true;
        $prev = $this->course->chapters()->where('order', $order - 1)->first();
        if (! $prev) return false;
        return ChapterCompletion::where('chapter_id', $prev->id)->where('user_id', auth()->id())->exists();
    }

    public function goTo($order)
    {
        if (! $this->canOpenOrder($order)) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Locked','message'=>'Complete previous chapter to unlock','ttl'=>4500]);
            return;
        }
        $this->currentOrder = $order;
        $this->loadChapter();
    }

    public function markComplete()
    {
        if (! $this->chapter) return;
        ChapterCompletion::updateOrCreate(
            ['chapter_id' => $this->chapter->id, 'user_id' => auth()->id()],
            ['completed_at' => now()]
        );
        $this->completed = true;
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Completed','message'=>'Chapter marked complete','ttl'=>3000]);
        $this->emit('refreshStudentPending');
    }

    public function render()
    {
        // fetch next/prev orders
        $max = $this->course->chapters()->count();
        $prev = $this->currentOrder > 1 ? $this->currentOrder -1 : null;
        $next = $this->currentOrder < $max ? $this->currentOrder +1 : null;

        return view('livewire.student.chapter-viewer', [
            'chapter' => $this->chapter,
            'prev' => $prev,
            'next' => $next,
            'max' => $max,
        ]);
    }
}
