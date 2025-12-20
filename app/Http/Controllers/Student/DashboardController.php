<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StudentDashboardService;

class DashboardController extends Controller
{
    protected StudentDashboardService $service;

    public function __construct(StudentDashboardService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $role = 'student';
        $section = $request->query('section', 'dashboard'); // default fragment

        // load any data needed by student's sections
        $data = [
            'analytics' => $this->service->computeAnalytics(),
        ];

        return view('dashboards.shell', array_merge($data, compact('role', 'section')));
    }

    /**
     * Optional endpoint used when the UI loads sections via AJAX.
     * Returns only the section partial (no shell).
     */
    public function section(Request $request, $section)
    {
        $view = "dashboards.partials.sections.student.{$section}";
        if (! view()->exists($view)) {
            abort(404, "Section not found: {$section}");
        }

        // pass data required by the section partial if needed
        $data = [
            'analytics' => $this->service->computeAnalytics(),
        ];

        return view($view, $data);
    }
}
