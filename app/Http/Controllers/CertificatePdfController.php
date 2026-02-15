<?php

namespace App\Http\Controllers;

use App\Models\CertificateRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificatePdfController extends Controller
{
    
    public function preview($id)
    {
        $cert = CertificateRequest::with(['student','trainer','course','approver'])->findOrFail($id);
        $this->authorize('view', $cert);

        $pdf = PDF::loadView('certificates.print', compact('cert'))
                  ->setPaper('a4', 'landscape');

        return $pdf->stream("certificate-{$cert->certificate_number}.pdf");
    }

    public function download($id)
    {
        $cert = CertificateRequest::with(['student','trainer','course','approver'])->findOrFail($id);
        $this->authorize('view', $cert);

        $pdf = PDF::loadView('certificates.print', compact('cert'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download("certificate-{$cert->certificate_number}.pdf");
    }

    public function saveToStorage(Request $request, $id)
    {
        $cert = CertificateRequest::with(['student','trainer','course','approver'])->findOrFail($id);

        // policy: authorized users only
        $this->authorize('view', $cert);

        // generate filename
        $number = $cert->certificate_number ?? CertificateRequest::generateNumber();
        $safeNumber = Str::slug($number ?: 'cert-'.$cert->id);
        $filename = "certificate-{$safeNumber}.pdf";
        $folder = 'certificates';
        $relativePath = "{$folder}/{$filename}";

        try {
            // render view to HTML and generate PDF
            $pdf = PDF::loadView('certificates.print', compact('cert'))
                      ->setPaper('a4', 'landscape');

            // ensure folder exists on public disk
            if (! Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            // store PDF binary to public disk
            Storage::disk('public')->put($relativePath, $pdf->output());

            // get publicly accessible url (requires `php artisan storage:link`)
            $url = Storage::disk('public')->url($relativePath);

            // optional: if the certificate had no certificate_number before, persist it
            if (empty($cert->certificate_number)) {
                $cert->certificate_number = $number;
                $cert->saveQuietly();
            }

            return response()->json([
                'success' => true,
                'url' => $url,
                'path' => $relativePath,
            ], 200);
        } catch (\Throwable $e) {
            \Log::error('saveToStorage error: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to save PDF. See server logs.',
            ], 500);
        }
    }
}
