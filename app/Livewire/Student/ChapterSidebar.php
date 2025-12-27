<?php
namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Course;
use App\Models\Chapter;

class ChapterSidebar extends Component
{
    public int $courseId;
    public int $currentOrder = 1;

    public array $chapters = [];
    public array $completedIds = [];

    protected $listeners = ['refreshChapterSidebar' => 'load'];

    public function mount($courseId, $currentOrder = 1)
    {
        $this->courseId = (int)$courseId;
        $this->currentOrder = (int)$currentOrder;
        $this->load();
    }

    public function load()
    {
        $course = Course::with(['chapters' => function($q){ $q->orderBy('order'); }])->findOrFail($this->courseId);
        $this->chapters = $course->chapters->map(function($c){
            return [
                'id' => $c->id,
                'order' => $c->order,
                'title' => $c->title,
                'description' => $c->description,
            ];
        })->toArray();

        $this->completedIds = \DB::table('chapter_completions')
            ->where('user_id', auth()->id())
            ->whereIn('chapter_id', collect($this->chapters)->pluck('id'))
            ->pluck('chapter_id')
            ->toArray();
    }

    /**
     * Find the next unlocked chapter:
     * the first chapter whose completed=false AND whose previous is either null or completed.
     */
    public function findNextUnlocked()
    {
        $chapters = collect($this->chapters);

        foreach ($chapters as $ch) {
            $order = $ch['order'];
            $completed = in_array($ch['id'], $this->completedIds);
            if ($completed) continue;

            // check previous chapter (if any)
            if ($order === 1) {
                return $ch; // first chapter is unlocked if not completed
            }

            $prev = $chapters->firstWhere('order', $order - 1);
            $prevCompleted = $prev ? in_array($prev['id'], $this->completedIds) : true;
            if ($prevCompleted) return $ch;
        }

        return null;
    }

    public function jumpToNextUnlocked()
    {
        $next = $this->findNextUnlocked();
        if (! $next) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'No chapter','message'=>'No unlocked next chapter found', 'ttl'=>4500]);
            return;
        }

        $url = route('student.chapters.show', ['course' => $this->courseId, 'order' => $next['order']]);

        // use browser navigation event (client will perform redirect)
        $this->dispatchBrowserEvent('navigate', ['url' => $url]);
    }

    public function render()
    {
        return view('livewire.student.chapter-sidebar', [
            'chapters' => $this->chapters,
            'completedIds' => $this->completedIds,
            'currentOrder' => $this->currentOrder,
        ]);
    }
}
