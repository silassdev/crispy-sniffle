<?php
namespace App\Policies;

use App\Models\User;
use App\Models\CertificateRequest;

class CertificatePolicy
{
    /**
     * View certificate: allowed for admin, trainer (owner), or the student who owns it.
     */
    public function view(User $user, CertificateRequest $certificate): bool
    {
        // Admins can view all certificates
        if ($user->role === 'admin') {
            return true;
        }

        // Student who owns the certificate can view it
        if ($user->id === $certificate->student_id) {
            return true;
        }

        // Trainer who was assigned can view it
        if ($user->id === $certificate->trainer_id) {
            return true;
        }

        return false;
    }

    /**
     * Download - reuse view logic.
     */
    public function download(User $user, CertificateRequest $certificate): bool
    {
        return $this->view($user, $certificate);
    }

    /**
     * Only admin can approve/reject/revoke.
     */
    public function approve(User $user): bool
    {
        return $user->role === 'admin';
    }
}
