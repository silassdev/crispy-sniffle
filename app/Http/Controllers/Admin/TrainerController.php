<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;

class TrainerController extends Controller
{
    public function index()
    {
        return view('admin.trainers.index'); 
    }

    public function show($id)
    {
        $trainer = User::where('role', \App\Models\User::ROLE_TRAINER)->findOrFail($id);
        return view('admin.trainers.show', compact('trainer'));
    }
}
