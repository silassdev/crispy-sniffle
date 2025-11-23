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
    public ?int $selected = null; // for confirm modal

    protected $listeners = ['refreshTrainers' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function approve(int $id)
    {
        $trainer = User::findOrFail($id);
        if (! $trainer->isTrainer()) {
            $this->dispatchBrowserEvent('app-toast', ['title' => 'Error','message' => 'User is not a trainer', 'ttl' => 4000]);
            return;
        }

        $trainer->approve(auth()->id());

        // send email (silently fail-safe)
        try {
            Mail::to($trainer->email)->send(new TrainerApprovedMail($trainer));
        } catch (\Throwable $e) {
            \Log::error('Trainer approval mail failed: '.$e->getMessage());
        }

        $this->dispatchBrowserEvent('app-toast', ['title' => 'Approved','message' => $trainer->name.' approved','ttl' => 4000]);
        $this->emit('refreshDashboardCounters'); // earlier dashboard listens to this
        $this->emitSelf('$refresh');
    }

    public function reject(int $id)
    {
        $trainer = User::findOrFail($id);
        if (! $trainer->isTrainer()) {
            $this->dispatchBrowserEvent('app-toast', ['title' => 'Error','message' => 'User is not a trainer', 'ttl' => 4000]);
            return;
        }

        $trainer->reject(auth()->id());

        try {
            Mail::to($trainer->email)->send(new TrainerRejectedMail($trainer));
        } catch (\Throwable $e) {
            \Log::error('Trainer rejected mail failed: '.$e->getMessage());
        }

        $this->dispatchBrowserEvent('app-toast', ['title' => 'Rejected','message' => $trainer->name.' rejected','ttl' => 4000]);
        $this->emit('refreshDashboardCounters');
        $this->emitSelf('$refresh');
    }

    public function destroy(int $id)
    {
        $trainer = User::findOrFail($id);
        if (! $trainer->isTrainer()) {
            $this->dispatchBrowserEvent('app-toast', ['title' => 'Error','message' => 'User is not a trainer', 'ttl' => 4000]);
            return;
        }

        $trainer->delete();

        $this->dispatchBrowserEvent('app-toast', ['title' => 'Deleted','message' => 'Trainer removed','ttl' => 4000]);
        $this->emit('refreshDashboardCounters');
        $this->emitSelf('$refresh');
    }

    public function render()
    {
        $q = User::trainers()
            ->when($this->search, fn($q) => $q->where(function($s) {
                $s->where('name','like','%'.$this->search.'%')
                  ->orWhere('email','like','%'.$this->search.'%');
            }))
            ->orderByDesc('created_at');

        $trainers = $q->paginate($this->perPage);

        return view('livewire.admin.trainer-list', [
            'trainers' => $trainers
        ]);
    }
}
