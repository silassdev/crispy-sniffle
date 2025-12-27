<?php
namespace App\Livewire\Trainer;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ChapterEditor extends Component
{
    use WithFileUploads;

    public Course $course;

    // repeatable rows for creating chapters
    // each row: ['title'=>'','description'=>'','content'=>'','file'=> UploadedFile|null]
    public array $rows = [];

    // existing chapters for display / reorder
    public $existingChapters = [];

    public int $maxChapters = 20;

    protected $listeners = [
        'refreshChapterList' => 'loadExistingChapters',
    ];

    public function mount($courseId)
    {
        $this->course = Course::findOrFail($courseId);
        $this->rows = [
            ['title'=>'','description'=>'','content'=>'','file'=>null]
        ];
        $this->loadExistingChapters();
    }

    public function loadExistingChapters()
    {
        $this->existingChapters = $this->course->chapters()->orderBy('order')->get()->map(function($c){
            return [
                'id' => $c->id,
                'order' => $c->order,
                'title' => $c->title,
                'description' => $c->description,
            ];
        })->toArray();
    }

    public function addRow()
    {
        if ($this->course->chapters()->count() + count($this->rows) >= $this->maxChapters) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Limit reached','message'=>"Course can have maximum {$this->maxChapters} chapters.", 'ttl'=>5000]);
            return;
        }

        $this->rows[] = ['title'=>'','description'=>'','content'=>'','file'=>null];
    }

    public function removeRow($index)
    {
        if (! isset($this->rows[$index])) return;
        // if file exists, remove temp file (Livewire handles temp files on its own)
        unset($this->rows[$index]);
        // reindex array
        $this->rows = array_values($this->rows);
    }

    protected function rules()
    {
        $rules = [];
        foreach ($this->rows as $i => $row) {
            $rules["rows.{$i}.title"] = 'required|string|max:255';
            $rules["rows.{$i}.description"] = 'nullable|string';
            $rules["rows.{$i}.content"] = 'nullable|string';
            $rules["rows.{$i}.file"] = 'nullable|file|mimes:pdf,zip,mp4,jpeg,png,jpg|max:20480'; // 20MB
        }
        return $rules;
    }

    public function createChapters()
    {
        $existingCount = $this->course->chapters()->count();
        $incoming = count($this->rows);
        if ($existingCount + $incoming > $this->maxChapters) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>"Cannot add {$incoming} chapters. Max {$this->maxChapters} allowed.", 'ttl'=>6000]);
            return;
        }

        $this->validate();

        DB::beginTransaction();
        try {
            $order = $existingCount;
            foreach ($this->rows as $i => $r) {
                $order++;
                $chapter = Chapter::create([
                    'course_id' => $this->course->id,
                    'title' => $r['title'],
                    'slug' => Str::slug($r['title']).'-'.$order,
                    'description' => $r['description'] ?? null,
                    'content' => $r['content'] ?? null,
                    'order' => $order,
                ]);

                // handle file: store temp on public disk then attach to media collection 'resources'
                if (! empty($r['file'])) {
                    $tmp = $r['file']->store('temp', 'public');
                    $chapter->addMedia(storage_path('app/public/'.$tmp))->toMediaCollection('resources');
                    \Storage::disk('public')->delete($tmp);
                }
            }
            DB::commit();

            // reset form
            $this->rows = [['title'=>'','description'=>'','content'=>'','file'=>null]];
            $this->loadExistingChapters();
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Created','message'=>"{$incoming} chapters created.", 'ttl'=>4000]);

            // emit an event (other components can refresh)
            $this->emit('refreshChapterList');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('ChapterEditor createChapters error: '.$e->getMessage());
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Failed to create chapters', 'ttl'=>6000]);
        }
    }

    /**
     * This method is optionally called from JS when reorder completes.
     * Expects an array of ids (ordered).
     */
    public function reorderSave(array $orderedIds)
    {
        // basic guard
        if (! is_array($orderedIds) || empty($orderedIds)) return;

        DB::transaction(function() use ($orderedIds) {
            $i = 0;
            foreach ($orderedIds as $id) {
                $i++;
                Chapter::where('id', $id)->where('course_id', $this->course->id)->update(['order' => $i]);
            }
        });

        $this->loadExistingChapters();
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Saved','message'=>'Chapter order updated', 'ttl'=>3000]);
    }

    public function render()
    {
        return view('livewire.trainer.chapter-editor', [
            'existingCount' => $this->course->chapters()->count(),
        ]);
    }
}
