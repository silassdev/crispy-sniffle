<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\Submission;
use Illuminate\Support\Facades\Storage;

class AssessmentSubmissionController extends Controller
{
    public function submit(Request $request, $assessmentId)
    {
        $assessment = Assessment::findOrFail($assessmentId);
        $type = $assessment->type;

        // Basic due check
        if ($assessment->due_at && now()->greaterThan($assessment->due_at)) {
            return back()->with('error', 'This assessment is closed.');
        }

        if ($type === 'quiz') {
            // expect answers in request->input('answers') as qId => 'A'
            $data = $request->validate([
                'answers' => 'required|array',
            ]);
            $answers = $data['answers'];

            // auto grade
            $score = 0;
            foreach ($assessment->questions as $q) {
                if ($q->type !== 'mcq') continue;
                $given = $answers[$q->id] ?? null;
                if ($given && $q->correct_option && strtoupper($given) === strtoupper($q->correct_option)) {
                    $score += intval($q->score);
                }
            }

            $submission = Submission::create([
                'assessment_id' => $assessment->id,
                'course_id' => $assessment->course_id,
                'user_id' => auth()->id(),
                'answers' => $answers,
                'score' => $score,
                'status' => 'graded',
                'submitted_at' => now(),
            ]);

            return back()->with('success','Quiz submitted. Your score: '.$score);
        }

        if ($type === 'assignment') {
            // expect written answers per question and an uploaded compressed pdf (zip or pdf)
            $rules = [
                'answers' => 'required|array',
                'file' => 'nullable|file|mimes:pdf,zip|max:10240', // 10MB
            ];
            $data = $request->validate($rules);

            $submission = Submission::create([
                'assessment_id' => $assessment->id,
                'course_id' => $assessment->course_id,
                'user_id' => auth()->id(),
                'answers' => $data['answers'],
                'status' => 'submitted',
                'submitted_at' => now(),
            ]);

            if ($request->hasFile('file')) {
                $submission->addMediaFromRequest('file')->toMediaCollection('submission_files');
            }

            return back()->with('success','Assignment submitted. Trainer will grade it.');
        }

        if ($type === 'project') {
            // only file upload
            $data = $request->validate([
                'file' => 'required|file|mimes:pdf,zip|max:15360', // 15MB maybe
                'guest_email' => 'nullable|email',
            ]);

            $submission = Submission::create([
                'assessment_id' => $assessment->id,
                'course_id' => $assessment->course_id,
                'user_id' => auth()->id(),
                'guest_email' => $data['guest_email'] ?? null,
                'status' => 'submitted',
                'submitted_at' => now(),
            ]);

            $submission->addMediaFromRequest('file')->toMediaCollection('submission_files');

            return back()->with('success','Project uploaded. Trainer will review.');
        }

        return back()->with('error','Invalid assessment type.');
    }
}
