<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class CertificateController extends Controller
{
    public function index()
    {
        $certs = CertificateRequest::with(['student', 'trainer', 'course'])->orderByDesc('created_at')->paginate(20);
        
        if (request()->ajax()) {
            return view('admin.certificate.index-fragment');
        }

        return view('admin.certificate.index', compact('certs'));
    }

     public function show($id)
    {
        $cert = CertificateRequest::with(['student', 'trainer', 'course'])->findOrFail($id);
        return view('admin.certificate.show', compact('cert'));
    }

    //Approve and Generate
    public function approve(Request $request, $id)
{
    $cert = CertificateRequest::with(['student','trainer','course','approver'])
        ->findOrFail($id);

    if ($cert->status !== 'pending') {
        return back()->with('error', 'Certificate is not pending');
    }

    DB::beginTransaction();

    try {

        if (empty($cert->certificate_number)) {
            $cert->certificate_number = CertificateRequest::generateNumber();
        }

        $cert->status = 'approved';
        $cert->approved_by = Auth::id();
        $cert->admin_note = $request->input('admin_note');
        $cert->issued_at = now();

        $cert->save();

        // Generate PDF
        $pdf = Pdf::loadView('certificates.print', compact('cert'))
            ->setPaper('a4', 'landscape');

        // Store PDF in public disk
        $safeNumber = Str::slug($cert->certificate_number);
        $filename = "certificate-{$safeNumber}.pdf";
        $relativePath = "certificates/{$filename}";

        Storage::disk('public')->put($relativePath, $pdf->output());

        // Save path
        $cert->certificate_path = $relativePath;
        $cert->save();

        DB::commit();

        return back()->with('success', 'Certificate approved and generated successfully.');

    } catch (\Throwable $e) {

        DB::rollBack();
        \Log::error('Certificate approval failed: '.$e->getMessage());

        return back()->with('error', 'Approval failed. Check logs.');
    }
}


        // notify student and trainer
        //$cert->student->notify(new \App\Notifications\CertificateApproved($cert));
        //$cert->trainer->notify(new \App\Notifications\CertificateStatusChanged($cert));

    public function reject(Request $request, $id)
    {
        $cert = CertificateRequest::findOrFail($id);
        $note = $request->input('admin_note', null);

        $cert->update([
            'status' => 'rejected',
            'rejected_by' => Auth::id(),
            'admin_note' => $note,
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate request rejected.');
    }

    public function revoke(Request $request, $id)
    {
        $cert = CertificateRequest::findOrFail($id);
        $cert->status = 'revoked';
        $cert->save();
        //$cert->student->notify(new \App\Notifications\CertificateRevoked($cert));
        return back()->with('success','Certificate revoked');
    }
}
