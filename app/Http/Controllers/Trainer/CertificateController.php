<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;

class CertificateController extends Controller
{
    /**
     * List certificates created/requested by this trainer.
     * View: resources/views/trainer/certificates/index.blade.php
     */
    public function index(Request $request)
    {
        $trainerId = Auth::id();

        // Trainer may see certificates they issued (or requested)
        $certs = Certificate::where('trainer_id', $trainerId)
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('trainer.certificates.index', compact('certs'));
    }

    /**
     * Show certificate record (read-only for trainer).
     * View: resources/views/trainer/certificates/show.blade.php
     */
    public function show(Certificate $certificate)
    {
        if ($certificate->trainer_id !== Auth::id() && ! (Auth::user()->isAdmin() ?? false)) abort(403);
        return view('trainer.certificates.show', compact('certificate'));
    }

    /**
     * Trainer requests a certificate for a student (creates a 'pending' certificate request).
     * This does not approve it — admin review needed.
     */
    public function requestForStudent(Request $request, Course $course)
    {
        $this->authorizeCourseOwnership($course);

        $request->validate([
            'student_id' => 'required|exists:users,id',
            'type' => 'required|string|max:80',
            'notes' => 'nullable|string'
        ]);

        $student = User::findOrFail($request->student_id);

        // create certificate request record
        $cert = Certificate::create([
            'course_id' => $course->id,
            'trainer_id' => Auth::id(),
            'student_id' => $student->id,
            'type' => $request->type,
            'notes' => $request->notes,
            'status' => 'pending', // pending for admin review
        ]);

        // dispatch notification/email to admins — you can dispatch a job here
        session()->flash('success', 'Certificate request submitted for review.');

        return redirect()->route('trainer.certificates.index');
    }

    /**
     * Simple helper to ensure trainer owns a course.
     */
    protected function authorizeCourseOwnership(Course $course)
    {
        $user = Auth::user();
        if ($course->trainer_id !== $user->id && ! (method_exists($user,'isAdmin') && $user->isAdmin())) {
            abort(403);
        }
    }
}
