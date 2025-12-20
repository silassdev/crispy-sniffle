<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Job;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class JobManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $perPage = 10;

    // form fields
    public $jobId = null;
    public $title;
    public $company_name;
    public $location;
    public $employment_type;
    public $salary;
    public $excerpt;
    public $description;
    public $tech_stack; // comma-separated string used in form
    public $is_active = true;

    public $logo = null; // Livewire file

    public $showForm = false;
    public $confirmDeleteId = null;

    protected $queryString = ['search', 'page'];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:100',
            'salary' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'tech_stack' => 'nullable|string|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,svg,webp|max:1024', // 1 MB recommended for logos
        ];
    }

    protected $listeners = ['confirmDelete' => 'deleteConfirmed'];

    // flexible notify helper (Livewire v3 dispatch or fallback)
    protected function notify($title, $message, $ttl = 3000)
    {
        $payload = ['title' => $title, 'message' => $message, 'ttl' => $ttl];
        if (method_exists($this, 'dispatch')) {
            $this->dispatch('app-toast', $payload);
        } else {
            $this->dispatchBrowserEvent('app-toast', $payload);
        }
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $this->jobId = $job->id;
        $this->title = $job->title;
        $this->company_name = $job->company_name;
        $this->location = $job->location;
        $this->employment_type = $job->employment_type;
        $this->salary = $job->salary;
        $this->excerpt = $job->excerpt;
        $this->description = $job->description;
        $this->is_active = $job->is_active;
        $this->tech_stack = $job->tech_stack ? implode(', ', $job->tech_stack) : '';
        $this->logo = null; // replace only if admin uploads new
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->jobId) {
            $job = Job::findOrFail($this->jobId);
        } else {
            $job = new Job();
            $job->created_by = auth()->id();
        }

        $job->title = $this->title;
        $job->company_name = $this->company_name;
        $job->location = $this->location;
        $job->employment_type = $this->employment_type;
        $job->salary = $this->salary;
        $job->excerpt = $this->excerpt;
        $job->description = $this->description;
        $job->is_active = (bool) $this->is_active;
        // tech stack: store as array
        $stacks = array_values(array_filter(array_map('trim', explode(',', (string)$this->tech_stack))));
        $job->tech_stack = $stacks;

        // ensure slug uniqueness
        if (empty($job->slug)) {
            $base = Str::slug($this->title ?: 'job');
            $slug = $base;
            $i = 1;
            while (Job::where('slug', $slug)->where('id', '<>', $job->id ?? 0)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $job->slug = $slug;
        }

        $job->save();

        // handle logo upload with Spatie medialibrary
        if ($this->logo) {
            // remove old media if exists
            $job->clearMediaCollection('company_logos');

            // move Livewire temporary file to storage then attach via medialibrary
            $tmp = $this->logo->store('uploads/job_logos', 'public');
            $absolute = storage_path('app/public/' . $tmp);

            $job->addMedia($absolute)
                ->usingFileName(Str::slug(pathinfo($tmp, PATHINFO_FILENAME)) . '-' . Str::random(6) . '.' . pathinfo($tmp, PATHINFO_EXTENSION))
                ->toMediaCollection('company_logos');

            // delete temporary raw
            Storage::disk('public')->delete($tmp);
        }

        $this->notify('Saved', 'Job saved successfully');
        $this->resetForm();
        $this->emit('refreshJobList');
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->dispatchBrowserEvent('open-delete-job-modal');
    }

    public function deleteConfirmed()
    {
        if (! $this->confirmDeleteId) return;
        $j = Job::find($this->confirmDeleteId);
        if ($j) {
            $j->clearMediaCollection('company_logos');
            $j->delete();
        }
        $this->confirmDeleteId = null;
        $this->notify('Deleted', 'Job removed');
        $this->emit('refreshJobList');
    }

    public function toggleActive($id)
    {
        $j = Job::findOrFail($id);
        $j->is_active = ! $j->is_active;
        $j->save();
        $this->notify($j->is_active ? 'Opened' : 'Closed', 'Job status updated');
        $this->emit('refreshJobList');
    }

    protected function resetForm()
    {
        $this->jobId = null;
        $this->title = $this->company_name = $this->location = $this->employment_type = $this->salary = $this->excerpt = $this->description = $this->tech_stack = null;
        $this->is_active = true;
        $this->logo = null;
        $this->showForm = false;
        $this->resetValidation();
    }

    public function render()
    {
        $query = Job::query()->latest('created_at');

        if ($this->search) {
            $term = '%' . $this->search . '%';
            $query->where(function($q) use ($term) {
                $q->where('title', 'like', $term)
                  ->orWhere('company_name', 'like', $term)
                  ->orWhere('location', 'like', $term);
            });
        }

        $jobs = $query->paginate($this->perPage);

        return view('livewire.admin.job-manager', [
            'jobs' => $jobs
        ]);
    }
}
