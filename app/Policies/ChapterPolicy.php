public function view(User $user, Chapter $chapter) {
    if (method_exists($user,'isAdmin') && $user->isAdmin()) return true;

    // trainer course owner
    if ($chapter->course->trainer_id === $user->id) return true;

    // enrolled student
    return \DB::table('course_user')->where('course_id',$chapter->course_id)->where('user_id',$user->id)->exists();
}
public function create(User $user, Course $course) {
    return $course->trainer_id === $user->id || (method_exists($user,'isAdmin') && $user->isAdmin());
}
