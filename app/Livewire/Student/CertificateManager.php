<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CertificateRequest;

class CertificateManager extends Component
{
    use WithPagination;

    public $perPage = 15;

    public function render()
    {
        $certs = CertificateRequest::where('student_id', auth()->id())
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.student.certificate-manager', [
            'certs' => $certs,
        ]);
    }
}
