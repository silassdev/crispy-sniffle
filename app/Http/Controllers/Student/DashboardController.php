<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // any data for the student dashboard can be passed here
        return view('student.dashboard');
    }
}
