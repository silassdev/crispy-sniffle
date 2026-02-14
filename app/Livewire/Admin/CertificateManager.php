<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CertificateRequest;

class CertificateManager extends Component
{
    use WithPagination;

    public $q = '';
    public $perPage = 15;
    public $status = 'pending';

    protected $queryString = ['q', 'status'];

    public function updatingQ() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
    public function updatingStatus() { $this->resetPage(); }

    public function render()
    {
        $query = CertificateRequest::with(['student','trainer','course'])
            ->when($this->q, fn($q) => $q->where(function($w){
                $w->where('certificate_number','like',"%{$this->q}%")
                  ->orWhere('notes','like',"%{$this->q}%");
            }))
            ->when($this->status, fn($q)=> $q->where('status', $this->status));

        $certs = $query->orderByDesc('created_at')->paginate($this->perPage);

        return view('livewire.admin.certificate-manager', [
            'certs' => $certs,
        ]);
    }

    public function approve($id)
    {
        $req = CertificateRequest::findOrFail($id);
        $req->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'issued_at' => now(),
        ]);
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Approved','message'=>'Certificate approved','ttl'=>3000]);
        $this->emitSelf('$refresh');
    }

    public function reject($id)
    {
        $req = CertificateRequest::findOrFail($id);
        $req->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'approved_by' => auth()->id(),
        ]);
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Rejected','message'=>'Certificate rejected','ttl'=>3000]);
        $this->emitSelf('$refresh');
    }
}
