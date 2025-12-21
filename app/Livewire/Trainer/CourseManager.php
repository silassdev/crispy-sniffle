<?php
namespace App\Livewire\Trainer;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CourseManager extends Component
{
    use WithPagination, WithFileUploads;

    public $perPage = 10;
    public $search = '';


    public $courseId = null;
    public $title;
    public $excerpt;
    public $body;
    public $tags;
    public $youtube_url;
    public $zoom_url;
    public $is_public = true;

    public $illustration;
    public $attachments = [];

    public $showForm = false;

    protected $listeners = ['refreshCourseList' => '$refresh'];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'tags' => 'nullable|string|max:500',
            'youtube_url' => 'nullable|url|max:255',
            'zoom_url' => 'nullable|url|max:255',
            'is_public' => 'boolean',
            'illustration' => 'nullable|image|mimes:jpeg,png,webp|max:2048', // 2MB
            'attachments.*' => 'nullable|file|mimes:pdf|max:5120', // 5MB
        ];
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit($id)
    {
        $c = Course::findOrFail($id);
        $this->courseId = $c->id;
        $this->title = $c->title;
        $this->excerpt = $c->excerpt;
        $this->body = $c->body;
        $this->tags = $c->tags ? implode(', ', $c->tags) : '';
        $this->youtube_url = $c->youtube_url;
        $this->zoom_url = $c->zoom_url;
        $this->is_public = $c->is_public;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->courseId) {
            $course = Course::findOrFail($this->courseId);
        } else {
            $course = new Course();
            $course->trainer_id = auth()->id();
        }

        $course->title = $this->title;
        $course->excerpt = $this->excerpt;
        $course->body = $this->body;
        $course->tags = array_values(array_filter(array_map('trim', explode(',', (string)$this->tags))));
        $course->youtube_url = $this->youtube_url;
        $course->zoom_url = $this->zoom_url;
        $course->is_public = (bool)$this->is_public;
        $course->save();

        // illustration
        if ($this->illustration) {
            $tmp = $this->illustration->store('temp', 'public');
            $course->clearMediaCollection('illustration');
            $course->addMedia(storage_path('app/public/'.$tmp))->toMediaCollection('illustration');
            \Storage::disk('public')->delete($tmp);
        }

        // attachments
        if (!empty($this->attachments)) {
            foreach ($this->attachments as $file) {
                $tmp = $file->store('temp', 'public');
                $course->addMedia(storage_path('app/public/'.$tmp))->toMediaCollection('attachments');
                \Storage::disk('public')->delete($tmp);
            }
        }

        $this->dispatch('app-toast', ['title'=>'Saved','message'=>'Course saved','ttl'=>3000]);
        $this->resetForm();
        $this->dispatch('refreshCourseList');
    }

    public function delete($id)
    {
        $c = Course::findOrFail($id);
        if ($c->trainer_id !== auth()->id()) {
            $this->dispatch('app-toast', ['title'=>'Error','message'=>'Permission denied','ttl'=>3000]);
            return;
        }
        $c->clearMediaCollection('illustration');
        $c->clearMediaCollection('attachments');
        $c->delete();
        $this->dispatch('app-toast', ['title'=>'Deleted','message'=>'Course removed','ttl'=>3000]);
        $this->dispatch('refreshCourseList');
    }

    protected function resetForm()
    {
        $this->courseId = null;
        $this->title = $this->excerpt = $this->body = $this->tags = $this->youtube_url = $this->zoom_url = null;
        $this->is_public = true;
        $this->illustration = null;
        $this->attachments = [];
        $this->showForm = false;
        $this->resetValidation();
    }

    public function render()
    {
        $query = Course::query()->where('trainer_id', auth()->id())->latest('created_at');

        if ($this->search) {
            $term = '%'.$this->search.'%';
            $query->where(function($q) use ($term) {
                $q->where('title', 'like', $term)->orWhere('excerpt', 'like', $term);
            });
        }

        $courses = $query->paginate($this->perPage);

        return view('livewire.trainer.course-manager', ['courses' => $courses]);
    }
}
