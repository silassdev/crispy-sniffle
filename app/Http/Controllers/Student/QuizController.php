<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function result($attemptId)
    {
        $attempt = QuizAttempt::with([
            'quiz.chapter.course.trainer',
            'answers.question.options',
            'user'
        ])->findOrFail($attemptId);

        $user = Auth::user();

        // Authorization:
        // - student who attempted
        // - trainer who owns the course
        // - admin
        $isOwner = $attempt->user_id === $user->id;
        $isTrainer = optional($attempt->quiz->chapter->course)->trainer_id === $user->id;
        $isAdmin   = method_exists($user, 'isAdmin') ? $user->isAdmin() : ($user->role === \App\Models\User::ROLE_ADMIN);

        if (! ($isOwner || $isTrainer || $isAdmin)) {
            abort(403);
        }

        // compute percentage if possible
        $score = $attempt->score ?? 0;
        $max   = $attempt->max_score ?? 0;
        $percentage = $max ? round(($score / $max) * 100, 2) : null;

        return view('student.quiz.result', compact('attempt','score','max','percentage','isOwner','isTrainer','isAdmin'));
    }
}
