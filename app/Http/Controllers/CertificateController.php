<?php
namespace App\Http\Controllers;

use App\Models\CertificateRequest;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function myCertificates()
    {
        $certs = CertificateRequest::where('student_id', auth()->id())->where('status','approved')->latest('issued_at')->get();
        return view('student.certificates.index', compact('certs'));
    }

    public function publicShow($certificate_number)
    {
        $cert = CertificateRequest::where('certificate_number', $certificate_number)->where('status','approved')->firstOrFail();
        return view('certificates.public', compact('cert'));
    }
}
