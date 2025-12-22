<?php
namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function myCertificates()
    {
        $certs = Certificate::where('student_id', auth()->id())->where('status','approved')->latest('issued_at')->get();
        return view('student.certificates.index', compact('certs'));
    }

    public function publicShow($certificate_number)
    {
        $cert = Certificate::where('certificate_number', $certificate_number)->where('status','approved')->firstOrFail();
        return view('certificates.public', compact('cert'));
    }
}
