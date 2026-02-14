<?php

namespace App\Livewire\Trainer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CertificateRequest;

class CertificateManager extends Component
{
    use WithPagination;

    public $perPage = 15;

    public function render()
    {
        $certs = CertificateRequest::where('trainer_id', auth()->id())
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.trainer.certificate-manager', [
            'certs' => $certs,
        ]);
    }
}
