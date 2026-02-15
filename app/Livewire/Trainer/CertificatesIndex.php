<?php

namespace App\Livewire\Trainer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CertificateRequest;

class CertificatesIndex extends Component
{
    use WithPagination;

    public $q = '';
    public $status = 'all';
    public $type = 'all';
    public $perPage = 15;

    // Modal State
    public $selectedCertId = null;
    public $isModalOpen = false;

    protected $queryString = [
        'q' => ['except' => ''],
        'status' => ['except' => 'all'],
        'type' => ['except' => 'all'],
        'perPage' => ['except' => 15],
    ];

    protected $listeners = ['certificateUpdated' => '$refresh'];

    // keep page when filters change
    public function updatingQ() { $this->resetPage(); }
    public function updatingStatus() { $this->resetPage(); }
    public function updatingType() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }

    public function openModal($id)
    {
        $this->selectedCertId = $id;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedCertId = null;
    }

    public function render()
    {
        $query = CertificateRequest::with(['student', 'course'])
            ->when($this->q, function ($q) {
                $search = '%' . $this->q . '%';
                $q->where(function ($qr) use ($search) {
                    $qr->where('certificate_number', 'like', $search)
                       ->orWhereHas('student', fn($s) => $s->where('name', 'like', $search)->orWhere('email', 'like', $search))
                       ->orWhereHas('course', fn($c) => $c->where('title', 'like', $search));
                });
            })
            ->when($this->status !== 'all', fn($q) => $q->where('status', $this->status))
            ->when($this->type !== 'all', fn($q) => $q->where('type', $this->type))
            ->latest();

        $certs = $query->paginate($this->perPage)->withQueryString();

        $selectedCert = $this->selectedCertId 
            ? CertificateRequest::with(['student','trainer','course'])->find($this->selectedCertId) 
            : null;

        return view('livewire.trainer.certificates-index', [
            'certs' => $certs,
            'selectedCert' => $selectedCert,
        ]);
    }
}
