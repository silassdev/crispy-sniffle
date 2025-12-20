<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseList extends Component
{
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Course::findOrFail($id)->delete();
        session()->flash('status', 'Course Deleted Successfully');
    }

    public function render()
    {
        $courses = Course::where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.course-list', [
            'courses' => $courses
        ]);
    }
}
