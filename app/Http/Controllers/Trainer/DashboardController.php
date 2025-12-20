<?php
namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TrainerDashboardService;

class DashboardController extends Controller
{
    protected TrainerDashboardService $service;

    public function __construct(TrainerDashboardService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $role = 'trainer';
        $section = 'dashboard';

        $data = [
            'analytics' => $this->service->computeAnalytics(),
        ];

        return view('dashboards.shell', array_merge($data, compact('role', 'section')));
    }
}
