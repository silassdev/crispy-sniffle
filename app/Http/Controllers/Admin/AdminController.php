<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // list all admins
        $admins = User::where('role', 'admin')->latest()->paginate(20);

        return view('admin.admins.index', compact('admins'));
    }

    public function show($id)
    {
        $admin = User::findOrFail($id);

        return view('admin.admins.show', compact('admin'));
    }
}
