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

    public $q = '';
    public $perPage = 10;
    public $sort = 'created_at';
    public $dir = 'desc';

    protected $listeners = ['deleteTrainer' => 'delete', 'showSection' => 'noop'];

    public function updatingQ() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }

    public function setSort($column)
    {
        if ($this->sort === $column) {
            $this->dir = $this->dir === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $column;
            $this->dir = 'desc';
        }
        $this->resetPage();
    }

    public function approve($id)
    {
        $u = User::find($id);
        if (! $u || $u->role !== User::ROLE_TRAINER) {
            return $this->->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'User not found','ttl'=>4000]);
        }

        if ($u->approved) {
            return $this->->dispatchBrowserEvent('app-toast', ['title'=>'Info','message'=>'Already approved','ttl'=>3000]);
        }

        $u->update(['approved' => true, 'rejected_at' => null]);

        // queue approval email (queue requires queue worker; fallback will send sync if configured)
        try {
            Mail::to($u->email)->queue(new TrainerApprovedMail($u));
        } catch (\Throwable $e) {
            // if queue fails, fall back to synchronous send but keep user updated
            try { Mail::to($u->email)->send(new TrainerApprovedMail($u)); } catch (\Throwable $_) {}
        }

        $this->->dispatchBrowserEvent('app-toast', ['title'=>'Approved','message'=>"{$u->name} approved.",'ttl'=>4000]);

        // refresh data if necessary
        $this->emitSelf('$refresh');
    }

    public function reject($id)
    {
        $u = User::find($id);
        if (! $u || $u->role !== User::ROLE_TRAINER) {
            return $this->->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'User not found','ttl'=>4000]);
        }

        if ($u->rejected_at) {
            return $this->->dispatchBrowserEvent('app-toast', ['title'=>'Info','message'=>'Already rejected','ttl'=>3000]);
        }

        $u->update(['rejected_at' => now(), 'approved' => false]);

        try {
            Mail::to($u->email)->queue(new TrainerRejectedMail($u));
        } catch (\Throwable $e) {
            try { Mail::to($u->email)->send(new TrainerRejectedMail($u)); } catch (\Throwable $_) {}
        }

        $this->->dispatchBrowserEvent('app-toast', ['title'=>'Rejected','message'=>"{$u->name} rejected.",'ttl'=>5000]);
        $this->emitSelf('$refresh');
    }

    public function delete($id)
    {
        $u = User::find($id);
        if (! $u || $u->role !== User::ROLE_TRAINER) {
            return $this->->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'User not found','ttl'=>4000]);
        }

        $u->delete();
        $this->->dispatchBrowserEvent('app-toast', ['title'=>'Deleted','message'=>'Trainer deleted.','ttl'=>4000]);
        $this->resetPage();
    }

    public function view($id)
    {
        return redirect()->route('admin.trainer.view', $id);
    }

    public function render()
    {
        $query = User::where('role', User::ROLE_TRAINER)
            ->when($this->q, fn($q)=> $q->where(fn($w)=> $w->where('name','like',"%{$this->q}%")->orWhere('email','like',"%{$this->q}%")))
            ->orderBy($this->sort, $this->dir);

        $trainers = $query->paginate($this->perPage);

        return view('livewire.admin.trainer-list', ['trainers' => $trainers]);
    }
}
