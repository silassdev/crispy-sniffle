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
        return view('trainer.certificates.index');
    }

    public function create()
    {
        $students = User::where('role', User::ROLE_STUDENT)->get();
        $courses = auth()->user()->courses ?? collect();

        return view('trainer.certificates.create', compact('students', 'courses'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'nullable|exists:users,id',
            'student_email' => 'required_without:student_id|email',
            'course_id' => 'nullable|exists:courses,id',
            'reason' => 'nullable|string|max:1000',
        ]);

        $studentId = $request->input('student_id');
        if (!$studentId && $request->input('student_email')) {
            $student = User::where('email', $request->input('student_email'))->where('role', 'student')->first();
            if (!$student) {
                return back()->with('error', 'Student with this email not found.');
            }
            $studentId = $student->id;
        }

        $createData = [
            'student_id' => $studentId,
            'course_id' => $request->input('course_id'),
            'trainer_id' => Auth::id(),
            'notes' => $request->input('reason'),
            'type' => $request->input('type', 'course_completion'),
            'status' => 'pending',
        ];

        CertificateRequest::create($createData);

        return redirect()->route('trainer.certificates.index')->with('success', 'Certificate request submitted. Admin will review it');
    }

    public function show($id)
    {
        $cert = CertificateRequest::where('trainer_id', Auth::id())
            ->with(['student', 'course'])
            ->findOrFail($id);

        return view('trainer.certificates.show', compact('cert'));
    }
}
