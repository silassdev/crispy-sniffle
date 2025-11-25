<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax() || $request->query('fragment') == 1) {
            return view('admin.students.index-fragment');
        }

        return view('admin.students.index-shell');
    }

    public function show($id)
    {
        $student = User::where('role', User::ROLE_STUDENT)->findOrFail($id);
        $admin = auth()->user();
        return view('admin.students.show', compact('student', 'admin'));
    }
}
