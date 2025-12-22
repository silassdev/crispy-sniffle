<?php
namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Certificate;

class CertificatesList extends Component
{
    public function render()
    {
        $certs = Certificate::where('student_id', auth()->id())->where('status','approved')->latest('issued_at')->get();
        return view('livewire.student.certificates-list', compact('certs'));
    }
}
