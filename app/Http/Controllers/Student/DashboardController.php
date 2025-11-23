<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = 'student';
        $section = $request->query('section', 'dashboard'); // default fragment

        // load any data needed by student's sections
        $data = [
            // 'courses' => auth()->user()->courses()->latest()->take(10)->get(),
            // 'recent'  => ...
        ];

        return view('dashboards.shell', array_merge($data, compact('role','section')));
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
            // 'courses' => auth()->user()->courses()->latest()->take(10)->get(),
        ];

        return view($view, $data);
    }
}
