<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TrainerController extends Controller
{
    public function index(Request $request)
    {   
       
        return view('admin.trainers.index');
        }

    public function show(int $id)
    {
        $trainer = User::where('role', \App\Models\User::ROLE_TRAINER)->findOrFail($id);
        return view('admin.trainers.show', compact('trainer'));
    }

    public function approve(Request $request, int $id)
    {
        $trainer = User::where('role', User::ROLE_TRAINER)->findOrFail($id);
        $trainer->approve(auth()->id());

        return redirect()->back()->with('status', 'Trainer Approved');
    }

    public function destroy(Request $request, int $id)
    {
        $trainer = User::where('role', User::ROLE_TRAINER)->findOrFail($id);
        $trainer->delete();

        return redirect()->route('admin.trainers.index')->with('status', 'Trainer Deleted');
    }
}
