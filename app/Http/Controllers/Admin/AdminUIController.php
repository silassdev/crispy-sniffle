<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUIController extends Controller
{
    public function community(Request $request)
    {
        return $this->smartView('admin.community');
    }

    public function newsletter(Request $request)
    {
        return $this->smartView('admin.newsletter.index');
    }

    public function jobs(Request $request)
    {
        return $this->smartView('admin.jobs.index');
    }

    public function courses(Request $request)
    {
        return $this->smartView('admin.courses');
    }
}
