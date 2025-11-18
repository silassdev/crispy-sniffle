<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\AdminInvitation;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // returns counters as JSON for AJAX updates
    public function counters(): JsonResponse
    {
        // Safe grouped counts
        $counts = DB::table('users')
            ->select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role')
            ->toArray();

        $counters = [
            'students' => (int) ($counts['student'] ?? 0),
            'trainers' => (int) ($counts['trainer'] ?? 0),
            'admins'   => (int) ($counts['admin'] ?? 0),
            'posts'    => (int) (Post::count() ?? 0),
            'invites'  => (int) (AdminInvitation::count() ?? 0),
        ];

        return response()->json($counters);
    }
}
