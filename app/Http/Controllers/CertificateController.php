<?php

namespace App\Http\Controllers;

use App\Models\CertificateRequest;

class CertificateController extends Controller
{
    public function myCertificates()
    {
        $certs = CertificateRequest::where('student_id', auth()->id())
            ->where('status','approved')
            ->latest('issued_at')
            ->get();

        return view('student.certificates.index', compact('certs'));
    }

    public function publicShow($certificate_number)
    {
        $cert = CertificateRequest::with(['student','trainer','course','approver'])
            ->where('certificate_number', $certificate_number)
            ->where('status','approved')
            ->first();

        if (!$cert) {
            return view('certificates.not-found', [
                'number' => $certificate_number
            ]);
        }

        return view('certificates.public', compact('cert'));
    }
}
