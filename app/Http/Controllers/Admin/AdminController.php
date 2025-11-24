<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
     public function index(Request $request)
    {

        if ($request->ajax() || $request->query('fragment') == 1) {
            return view('admin.admins.index-fragment');
        }

        return view('admin.admins.index-shell');
    }
}
