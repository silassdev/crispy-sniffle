<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // pass any data you need here
        return view('trainer.dashboard');
    }
}
