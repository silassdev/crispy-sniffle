<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected DashboardService $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $counters = $this->service->computeCounters();

        if ($request->ajax()) {
            return view('admin.overview.partials.index', compact('counters'));
        }

        return view('admin.dashboard', compact('counters'));
    }

    public function counters()
    {
        $counters = $this->service->computeCounters();

        return response()->json($counters)
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }
}
