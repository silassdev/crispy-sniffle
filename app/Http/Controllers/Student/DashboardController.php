<?php
namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = 'student';
        $section = 'dashboard'; // default section name for student homepage

        // gather any data needed by the dashboard partial
        $data = [
          // e.g. 'courses' => auth()->user()->courses()->latest()->take(6)->get()
        ];

        return view('dashboards.shell', array_merge($data, compact('role','section')));
    }
}
