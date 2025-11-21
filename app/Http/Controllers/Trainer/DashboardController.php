<?php
namespace App\Http\Controllers\Trainer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = 'trainer';
        $section = 'dashboard';

        $data = [
          // e.g. 'myCourses' => auth()->user()->courses()->latest()->get()
        ];

        return view('dashboards.shell', array_merge($data, compact('role','section')));
    }
}
