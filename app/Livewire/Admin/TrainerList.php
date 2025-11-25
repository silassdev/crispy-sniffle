<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrainerApprovedMail;
use App\Mail\TrainerRejectedMail;

class TrainerList extends Component
{
    use WithPagination;

    public int $perPage = 10;
    public string $search = '';

    // modal / confirm state managed by Livewire properties
    public ?int $viewingId = null; // when set -> viewingTrainer loaded
    public ?User $viewingTrainer = null;
    public ?int $confirmDeleteId = null;

    protected $listeners = ['refreshTrainers' => '$refresh'];
    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function getPendingQuery()
    {
        return User::query()
            ->where('role', User::ROLE_TRAINER)
            ->where('approved', false)
            ->where('rejected', false)
            ->when($this->search, fn($q) => $q->where(fn($s) =>
                $s->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%')
            ))
            ->orderByDesc('created_at');
    }

    protected function getApprovedQuery()
    {
        return User::query()
            ->where('role', User::ROLE_TRAINER)
            ->where('approved', true)
            ->when($this->search, fn($q) => $q->where(fn($s) =>
                $s->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%')
            ))
            ->orderByDesc('created_at');
    }

    // Livewire will call this automatically when viewingId changes
    public function updatedViewingId($value)
    {
        if ($value) {
            $this->viewingTrainer = User::find($value);
        } else {
            $this->viewingTrainer = null;
        }
    }

    public function approve(int $id)
    {
        $trainer = User::findOrFail($id);
        if (! $trainer->isTrainer()) {
            $this->dispatch('app-toast', type: 'error', message: 'User is not a trainer');
            return;
        }

        $trainer->approved = true;
        $trainer->rejected = false;
        $trainer->approved_at = now();
        $trainer->approved_by = auth()->id();
        $trainer->save();

        try {
            Mail::to($trainer->email)->send(new TrainerApprovedMail($trainer));
        } catch (\Throwable $e) {
            \Log::error('Trainer approval mail failed: '.$e->getMessage());
        }

        // notify the browser
        $this->dispatch('app-toast', type: 'success', message: 'Trainer Approved');

        // notify other components (server side event)
        $this->dispatch('refreshDashboardCounters');

        // trigger a refresh on this component instance (v3 style)
        $this->dispatch('$refresh')->self();
    }

    public function reject(int $id)
    {
        $trainer = User::findOrFail($id);
        if (! $trainer->isTrainer()) {
            $this->dispatch('app-toast', type: 'error', message: 'User not a trainer');
            return;
        }

        $trainer->reject(auth()->id());

        try {
            Mail::to($trainer->email)->send(new TrainerRejectedMail($trainer));
        } catch (\Throwable $e) {
            \Log::error('Trainer rejected mail failed: '.$e->getMessage());
        }

        $this->dispatch('app-toast', type: 'rejected', message: 'Trainer Rejected');
        $this->dispatch('refreshDashboardCounters');
        $this->resetPage();
    }

    public function confirmDelete(int $id)
    {
        $this->confirmDeleteId = $id;
    }

    public function destroyConfirmed()
    {
        $id = $this->confirmDeleteId;
        if (! $id) return;

        $trainer = User::findOrFail($id);
        if (! $trainer->isTrainer()) {
            $this->dispatch('app-toast', type: 'error', message: 'User is not a trainer');
            $this->confirmDeleteId = null;
            return;
        }

        $trainer->delete();

        // client toast
        $this->dispatch('app-toast', type: 'success', message: 'Trainer removed');

        $this->confirmDeleteId = null;

        // notify dashboard counters
        $this->dispatch('refreshDashboardCounters');

        $this->resetPage();
    }

    public function closeModal()
    {
        $this->viewingId = null;
        $this->viewingTrainer = null;
    }

    public function render()
    {
        $pending = $this->getPendingQuery()->limit(10)->get();
        $approved = $this->getApprovedQuery()->paginate($this->perPage);

        return view('livewire.admin.trainer-list', [
            'pending' => $pending,
            'approved' => $approved,
        ]);
    }
}
