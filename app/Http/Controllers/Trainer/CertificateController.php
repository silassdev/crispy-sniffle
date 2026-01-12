<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CertificateRequest;
use App\Models\Course;
use App\Models\User;

class CertificateController extends Controller
{
    public function index()
    {
        $trainerId = Auth::id();
        $requests = CertificateRequest::where('requested_by', $trainerId)
            ->with(['student', 'course'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('trainer.certificates.index', compact('requests'));
    }

    public function create()
    {
        $students = User::where('role', User::ROLE_STUDENT)->get();
        $courses = auth()->user()->courses ?? collect();

        return view('trainer.certificates.create', compact('students', 'courses'));
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'reason' => 'nullable|string|max:1000',
        ]);
        $data['request_by'] = Auth::id();
        $req = CertificateRequest::create($data);

        return redirect()->route('trainer.certificates.index') ->with('success', 'Certificate request submitted. Admin will review it');
    }
}
