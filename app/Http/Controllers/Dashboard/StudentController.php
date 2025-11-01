<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard.student');
    }
}
