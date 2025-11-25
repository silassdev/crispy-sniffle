<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TrainerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() || $request->query('fragment') == 1) {
            return view('admin.trainers.index-fragment');
        }

        return view('admin.trainers.index-shell');
    }

    public function show($id)
    {
        $trainer = User::where('role', User::ROLE_TRAINER)->findOrFail($id);

        return view('admin.trainers.show', [ 
            'user'=> $trainer,
            'role'=> 'trainer'
        ]);
    }

    public function approve(Request $request, int $id)
    {
        $trainer = User::where('role', User::ROLE_TRAINER)->findOrFail($id);
        $trainer->approve(auth()->id());

        return redirect()->back()->with('status', 'Trainer Approved');
    }

    public function destroy(Request $req, int $id)
    {
        $t = User::where('role',
        User::ROLE_TRAINER)->findOrFail($id);
        $t->delete();

        if ($req->ajax() || $req->query('fragment') == 1) {
            return view('admin.trainers.index-fragment');
        }
        return redirect()->route('admin.trainers.index')->with('status', 'Trainer Deleted');
    }
}