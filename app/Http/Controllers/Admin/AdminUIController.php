<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUIController extends Controller
{
    public function community(Request $request)
    {
        if ($request->ajax()) {
            return view('admin.community-fragment');
        }
        return view('admin.community');
    }

    public function newsletter(Request $request)
    {
        if ($request->ajax()) {
            return view('admin.newsletter.index-fragment');
        }
        return view('admin.newsletter.index');
    }

    public function jobs(Request $request)
    {
        if ($request->ajax()) {
            return view('admin.jobs.index-fragment');
        }
        return view('admin.jobs.index');
    }

    public function courses(Request $request)
    {
        if ($request->ajax()) {
            return view('admin.courses-fragment');
        }
        return view('admin.courses');
    }
}
