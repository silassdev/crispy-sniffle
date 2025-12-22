<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        // filters handled in Livewire; this view mounts Livewire admin manager
        return view('admin.certificates.index');
    }

    public function approve(Request $request, $id)
    {
        $cert = Certificate::findOrFail($id);
        if ($cert->status !== 'pending') {
            return back()->with('error','Certificate is not pending');
        }

        $cert->certificate_number = Certificate::generateNumber();
        $cert->status = 'approved';
        $cert->approved_by = auth()->id();
        $cert->issued_at = now();
        $cert->save();

        // notify student and trainer
        $cert->student->notify(new \App\Notifications\CertificateApproved($cert));
        $cert->trainer->notify(new \App\Notifications\CertificateStatusChanged($cert));

        return back()->with('success','Certificate approved');
    }

    public function reject(Request $request, $id)
    {
        $cert = Certificate::findOrFail($id);
        $note = $request->input('note');
        $cert->status = 'rejected';
        $cert->rejected_at = now();
        $cert->notes = $cert->notes ? ($cert->notes."\n\nAdmin note: ".$note) : $note;
        $cert->save();

        $cert->student->notify(new \App\Notifications\CertificateRejected($cert));
        $cert->trainer->notify(new \App\Notifications\CertificateStatusChanged($cert));

        return back()->with('success','Certificate rejected');
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
