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
        $requests = CertificateRequest::with(['student', 'trainer', 'course'])->orderByDesc('created_at')->paginate(20);
        return view('admin.certificates.index', compact('requests'));
    }

     public function show($id)
    {
        $req = CertificateRequest::with(['student', 'trainer', 'course'])->findOrFail($id);
        return view('admin.certificates.show', compact('req'));
    }

         //Approve nd Generate
    public function approve(Request $request, $id)
    {
        $req = CertificateRequest::findOrFail($id);
        $note = $request->input('admin_note', null);

        if ($req->status !== 'pending') {
            return back()->with('error','Certificate is not pending');
        }

        $req->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'admin_note' => $note,
            'issued_at' => now(),
            'certificate_path' => '$path',
   
        ]);


        // notify student and trainer
        //$req->student->notify(new \App\Notifications\CertificateApproved($req));
        //$req->trainer->notify(new \App\Notifications\CertificateStatusChanged($req));

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate request approved.');
    }

    public function reject(Request $request, $id)
    {
        $req = CertificateRequest::findOrFail($id);
        $note = $request->input('admin_note', null);

        $req->update([
            'status' => 'rejected',
            'rejected_by' => Auth::id(),
            'admin_note' => $note,
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate request rejected.');
    }

    public function revoke(Request $request, $id)
    {
        $cert = Certificate::findOrFail($id);
        $cert->status = 'revoked';
        $cert->save();
        $cert->student->notify(new \App\Notifications\CertificateRevoked($cert));
        return back()->with('success','Certificate revoked');
    }
}
