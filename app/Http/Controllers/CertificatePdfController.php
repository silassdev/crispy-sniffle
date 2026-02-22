<?php

namespace App\Http\Controllers;

use App\Models\CertificateRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CertificatePdfController extends Controller
{
    use AuthorizesRequests;

    protected function getApprovedCertificate($id)
    {
        $cert = CertificateRequest::with(['student','trainer','course','approver'])
            ->where('status', 'approved')
            ->findOrFail($id);

        return $cert;
    }

    public function preview($id)
    {
        $cert = $this->getApprovedCertificate($id);
        
        return Pdf::loadView('certificates.print', compact('cert'))
            ->setPaper('a4', 'landscape')
            ->stream("certificate-{$cert->certificate_number}.pdf");
    }

    public function download($id)
    {
        $cert = $this->getApprovedCertificate($id);

        return Pdf::loadView('certificates.print', compact('cert'))
            ->setPaper('a4', 'landscape')
            ->download("certificate-{$cert->certificate_number}.pdf");
    }

    public function saveToStorage($id)
    {
        $cert = $this->getApprovedCertificate($id);
        $this->authorize('view', $cert);

        $safeNumber = Str::slug($cert->certificate_number);
        $filename = "certificate-{$safeNumber}.pdf";
        $relativePath = "certificates/{$filename}";

        $pdf = Pdf::loadView('certificates.print', compact('cert'))
            ->setPaper('a4', 'landscape');

        Storage::disk('public')->put($relativePath, $pdf->output());

        return response()->json([
            'success' => true,
            'url' => Storage::disk('public')->url($relativePath),
            'path' => $relativePath,
        ]);
    }
}
