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
    
    // Modal State
    public $selectedCertId = null;
    public $isModalOpen = false;
    public $confirmingAction = null;

    protected $queryString = ['q', 'status'];

    public function updatingQ() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
    public function updatingStatus() { $this->resetPage(); }

    public function openModal($id)
    {
        $this->selectedCertId = $id;
        $this->isModalOpen = true;
        $this->confirmingAction = null;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedCertId = null;
        $this->confirmingAction = null;
    }
    
    public function verifyAction($action)
    {
        $this->confirmingAction = $action;
    }

    public function cancelAction()
    {
        $this->confirmingAction = null;
    }

    public function render()
    {
        $query = CertificateRequest::with(['student','trainer','course'])
            ->when($this->q, fn($q) => $q->where(function($w){
                $w->where('certificate_number','like',"%{$this->q}%")
                  ->orWhere('notes','like',"%{$this->q}%");
            }))
            ->when($this->status, fn($q)=> $q->where('status', $this->status));

        $certs = $query->orderByDesc('created_at')->paginate($this->perPage);

        $selectedCert = $this->selectedCertId 
            ? CertificateRequest::with(['student','trainer','course'])->find($this->selectedCertId) 
            : null;

        return view('livewire.admin.certificate-manager', [
            'certs' => $certs,
            'selectedCert' => $selectedCert,
        ]);
    }

    public function approve()
    {
        if (!$this->selectedCertId) return;

        $req = CertificateRequest::findOrFail($this->selectedCertId);
        $req->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'issued_at' => now(),
        ]);
        
        $this->dispatch('app-toast', ['title'=>'Approved','message'=>'Certificate approved','ttl'=>3000]); 
        $this->closeModal();
    }

    public function reject()
    {
        if (!$this->selectedCertId) return;

        $req = CertificateRequest::findOrFail($this->selectedCertId);
        $req->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => auth()->id(),
        ]);
        
        $this->dispatch('app-toast', ['title'=>'Rejected','message'=>'Certificate rejected','ttl'=>3000]);
        $this->closeModal();
    }
}
