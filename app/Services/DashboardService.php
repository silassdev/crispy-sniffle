<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\AdminInvitation;

class DashboardService
{
    /**
     * Compute counters in a tolerant way (handles different role string values).
     *
     * @return array
     */
    public function computeCounters(): array
    {
        $raw = DB::table('users')
            ->select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role')
            ->toArray();

        $normalized = [];
        foreach ($raw as $roleKey => $total) {
            $normalized[(string) $roleKey] = (int) $total;
        }

        $pick = function (array $map, string $needle) {
            $needle = strtolower($needle);
            if (isset($map[$needle])) return (int) $map[$needle];
            foreach ($map as $k => $v) {
                if (stripos($k, $needle) !== false) return (int) $v;
            }
            return 0;
        };

        $studentConst = defined(User::class . '::ROLE_STUDENT') ? User::ROLE_STUDENT : null;
        $trainerConst = defined(User::class . '::ROLE_TRAINER') ? User::ROLE_TRAINER : null;
        $adminConst   = defined(User::class . '::ROLE_ADMIN') ? User::ROLE_ADMIN : null;

        $counters = [
            'students' => $studentConst && array_key_exists($studentConst, $normalized) ? (int)$normalized[$studentConst] : $pick($normalized, 'student'),
            'trainers' => $trainerConst && array_key_exists($trainerConst, $normalized) ? (int)$normalized[$trainerConst] : $pick($normalized, 'trainer'),
            'admins'   => $adminConst   && array_key_exists($adminConst, $normalized)   ? (int)$normalized[$adminConst]   : $pick($normalized, 'admin'),
            'posts'    => 0,
            'invites'  => 0,
        ];

        try { $counters['posts'] = Post::count(); } catch (\Throwable $e) { \Log::warning('DashboardService posts count failed: '.$e->getMessage()); }
        try { $counters['invites'] = AdminInvitation::count(); } catch (\Throwable $e) { \Log::warning('DashboardService invites count failed: '.$e->getMessage()); }

        return $counters;
    }
}
