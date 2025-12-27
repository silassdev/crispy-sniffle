public function show(Course $course, $order = 1)
{
    $order = max(1, (int) $order);
    $user = auth()->user();

    $isAdmin = method_exists($user, 'isAdmin') ? $user->isAdmin() : ($user->role === 'admin');
    $isTrainer = method_exists($user, 'isTrainer') ? ($user->isTrainer() && $course->trainer_id === $user->id) : ($user->role === 'trainer' && $course->trainer_id === $user->id);

    $enrolled = \DB::table('course_user')
        ->where('course_id', $course->id)
        ->where('user_id', $user->id)
        ->exists();

    if (! ($isAdmin || $isTrainer || $enrolled) ) {
        abort(403, 'You are not enrolled in this course.');
    }

    $chapter = $course->chapters()->where('order', $order)->first();
    if (! $chapter) {
        $first = $course->chapters()->orderBy('order')->first();
        if ($first) {
            return redirect()->route('student.chapters.show', ['course' => $course->id, 'order' => $first->order]);
        }
        return view('student.chapters.empty', compact('course'));
    }

    // pass course, order and chapter for meta/breadcrumbs
    return view('student.chapters.show', [
        'course' => $course,
        'order'  => $order,
        'chapter' => $chapter,
    ]);
}
