<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CertificateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CertificateManager extends Component
{
    use WithPagination;

    public $q = '';
    public $perPage = 15;
    public $status = 'pending';
    
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
            ? CertificateRequest::with(['student','trainer','course','approver'])->find($this->selectedCertId) 
            : null;

        return view('livewire.admin.certificate-manager', [
            'certs' => $certs,
            'selectedCert' => $selectedCert,
        ]);
    }

    public function approve()
    {
        Log::info('🔵 APPROVE ACTION STARTED', ['cert_id' => $this->selectedCertId, 'user_id' => auth()->id()]);
        
        if (!$this->selectedCertId) {
            Log::warning('❌ No cert ID selected');
            return;
        }

        try {
            $req = CertificateRequest::with(['student','trainer','course','approver'])
                ->findOrFail($this->selectedCertId);
            
            Log::info('Found certificate', ['status' => $req->status, 'id' => $req->id]);

            if ($req->status !== 'pending') {
                Log::warning('❌ Certificate not pending', ['current_status' => $req->status]);
                $this->dispatch('app-toast', [
                    'title' => 'Error',
                    'message' => "Certificate is not pending. Current status: {$req->status}",
                    'type' => 'error',
                    'ttl' => 5000
                ]);
                return;
            }

            DB::beginTransaction();
            Log::info('Transaction started');

            if (empty($req->certificate_number)) {
                $req->certificate_number = CertificateRequest::generateNumber();
                Log::info('Generated certificate number', ['number' => $req->certificate_number]);
            }

            $req->status = 'approved';
            $req->approved_by = auth()->id();
            $req->issued_at = now();
            
            if (!$req->save()) {
                throw new \Exception('Failed to save certificate');
            }
            Log::info('Certificate marked as approved');

            // Generate PDF
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('certificates.print', ['cert' => $req])
                ->setPaper('a4', 'landscape');
            Log::info('PDF generated');

            $safeNumber = \Illuminate\Support\Str::slug($req->certificate_number);
            $filename = "certificate-{$safeNumber}.pdf";
            $relativePath = "certificates/{$filename}";

            $stored = \Illuminate\Support\Facades\Storage::disk('public')->put($relativePath, $pdf->output());
            Log::info('PDF stored', ['path' => $relativePath, 'stored' => $stored]);

            $req->certificate_path = $relativePath;
            if (!$req->save()) {
                throw new \Exception('Failed to save certificate path');
            }
            Log::info('Certificate path saved');

            DB::commit();
            Log::info('✅ TRANSACTION COMMITTED');

            $this->dispatch('app-toast', [
                'title' => 'Success',
                'message' => 'Certificate approved and PDF generated successfully!',
                'type' => 'success',
                'ttl' => 4000
            ]);

            $this->closeModal();
            
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('❌ APPROVE FAILED: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            $this->dispatch('app-toast', [
                'title' => 'Approval Failed',
                'message' => $e->getMessage(),
                'type' => 'error',
                'ttl' => 8000
            ]);
        }
    }

    public function reject()
    {
        Log::info('🔵 REJECT ACTION STARTED', ['cert_id' => $this->selectedCertId, 'user_id' => auth()->id()]);
        
        if (!$this->selectedCertId) {
            Log::warning('❌ No cert ID selected');
            return;
        }

        try {
            $req = CertificateRequest::findOrFail($this->selectedCertId);
            Log::info('Found certificate', ['status' => $req->status, 'id' => $req->id]);

            if ($req->status !== 'pending') {
                Log::warning('❌ Certificate not pending', ['current_status' => $req->status]);
                $this->dispatch('app-toast', [
                    'title' => 'Error',
                    'message' => "Certificate is not pending. Current status: {$req->status}",
                    'type' => 'error',
                    'ttl' => 5000
                ]);
                return;
            }

            $updated = $req->update([
                'status' => 'rejected',
                'rejected_at' => now(),
                'rejected_by' => auth()->id(),
            ]);
            
            Log::info('Certificate rejected', ['updated' => $updated]);

            $this->dispatch('app-toast', [
                'title' => 'Success',
                'message' => 'Certificate rejected successfully!',
                'type' => 'success',
                'ttl' => 4000
            ]);

            $this->closeModal();
            
        } catch (\Throwable $e) {
            Log::error('❌ REJECT FAILED: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            $this->dispatch('app-toast', [
                'title' => 'Rejection Failed',
                'message' => $e->getMessage(),
                'type' => 'error',
                'ttl' => 8000
            ]);
        }
    }
}