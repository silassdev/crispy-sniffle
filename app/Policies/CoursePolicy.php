<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Course;

class CoursePolicy
{
    public function viewStudents(User $user, Course $course)
    {
        return $user->id === $course->trainer_id || $user->isAdmin();
    }
}
