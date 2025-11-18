<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TrainerController extends Controller
{
    public function index(Request $request)
    {   
        $perPage = 10;
        $trainers = \App\Models\User::where('role', \App\Models\User::ROLE_TRAINER)
        ->orderByDesc('created_at')
        ->paginate($perPage)
        ->withQueryString();

        if ($request->ajax()) {
            return view('admin.trainers.partials.index',
            compact('trainers'));
        }
        return view('admin.trainers.index',
        compact('trainers')); 
        }

    public function show($id)
    {
        $trainer = User::where('role', \App\Models\User::ROLE_TRAINER)->findOrFail($id);
        return view('admin.trainers.show', compact('trainer'));
    }
}
