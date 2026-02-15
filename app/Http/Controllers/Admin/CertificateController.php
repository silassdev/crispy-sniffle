<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $cert = CertificateRequest::findOrFail($id);
        $note = $request->input('admin_note', null);

        if ($cert->status !== 'pending') {
            return back()->with('error','Certificate is not pending');
        }

        $cert->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'admin_note' => $note,
            'issued_at' => now(),
            'certificate_path' => '$path',
   
        ]);


        // notify student and trainer
        //$cert->student->notify(new \App\Notifications\CertificateApproved($cert));
        //$cert->trainer->notify(new \App\Notifications\CertificateStatusChanged($cert));

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate request approved.');
    }

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
