<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class StudentList extends Component
{
    use WithPagination;

    public int $perPage = 12;
    public string $search = '';
    public ?int $viewingId = null;
    public ?User $viewingStudent = null;
    public ?int $confirmDeleteId = null;

    protected $queryString = ['search', 'page'];
    protected $paginationTheme = 'tailwind';
    protected $listeners = ['refreshStudents' => '$refresh'];

    public function updatingSearch() { $this->resetPage(); }

    public function updatedViewingId($val)
    {
        $this->viewingStudent = $val ? User::find($val) : null;
    }

    public function confirmDelete(int $id) { $this->confirmDeleteId = $id; }

    public function destroyConfirmed()
    {
        $id = $this->confirmDeleteId;
        if (! $id) return;
        $s = User::findOrFail($id);
        if ($s->role !== User::ROLE_STUDENT) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'User is not a student','ttl'=>4000]);
            $this->confirmDeleteId = null;
            return;
        }
        $s->delete();
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Deleted','message'=>'Student removed','ttl'=>4000]);
        $this->confirmDeleteId = null;
        $this->emit('refreshDashboardCounters');
        $this->resetPage();
    }

    public function closeModal() { $this->viewingId = null; $this->viewingStudent = null; }

    public function render()
    {
        $query = User::where('role', User::ROLE_STUDENT)
            ->when($this->search, fn($q) => $q->where(fn($s) =>
                $s->where('name','like','%'.$this->search.'%')->orWhere('email','like','%'.$this->search.'%')
            ))
            ->orderByDesc('created_at');

        $students = $query->paginate($this->perPage);

        return view('livewire.admin.student-list', compact('students'));
    }
}
