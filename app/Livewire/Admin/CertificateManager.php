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

        $req = CertificateRequest::with(['student','trainer','course','approver'])
            ->findOrFail($this->selectedCertId);

        if ($req->status !== 'pending') {
            $this->dispatch('app-toast', ['title'=>'Error','message'=>'Certificate is not pending','ttl'=>3000]);
            return;
        }

        \Illuminate\Support\Facades\DB::beginTransaction();

        try {
            if (empty($req->certificate_number)) {
                $req->certificate_number = CertificateRequest::generateNumber();
            }

            $req->status = 'approved';
            $req->approved_by = auth()->id();
            $req->issued_at = now();
            $req->save();

            // Generate PDF
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('certificates.print', ['cert' => $req])
                ->setPaper('a4', 'landscape');

            $safeNumber = \Illuminate\Support\Str::slug($req->certificate_number);
            $filename = "certificate-{$safeNumber}.pdf";
            $relativePath = "certificates/{$filename}";

            \Illuminate\Support\Facades\Storage::disk('public')->put($relativePath, $pdf->output());

            $req->certificate_path = $relativePath;
            $req->save();

            \Illuminate\Support\Facades\DB::commit();

            $this->dispatch('app-toast', ['title'=>'Approved','message'=>'Certificate approved and PDF generated','ttl'=>3000]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            \Log::error('Livewire certificate approval failed: '.$e->getMessage());
            $this->dispatch('app-toast', ['title'=>'Error','message'=>'Approval failed: '.$e->getMessage(),'ttl'=>8000]);
        }

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
