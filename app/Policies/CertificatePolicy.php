<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Certificate;

class CertificatePolicy
{
    /**
     * View certificate: allowed for admin, trainer (owner), or the student who owns it.
     */
    public function view(User $user, Certificate $certificate): bool
    {
        if ($user->isAdmin && method_exists($user,'isAdmin') ? $user->isAdmin() : ($user->role === 'admin')) {
            return true;
        }

        if ($user->id === $certificate->student_id) return true;
        if ($user->id === $certificate->trainer_id) return true;

        return false;
    }

    /**
     * Download - reuse view logic.
     */
    public function download(User $user, Certificate $certificate): bool
    {
        return $this->view($user, $certificate);
    }

    /**
     * Only admin can approve/reject/revoke.
     */
    public function approve(User $user): bool
    {
        return method_exists($user,'isAdmin') ? $user->isAdmin() : ($user->role === 'admin');
    }
}
