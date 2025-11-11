<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewAsController extends Controller
{
    public function set(Request $request)
    {
        $request->validate(['view_as' => 'required|in:admin,trainer,student']);
        session(['view_as' => $request->input('view_as')]);
        return back();
    }

    public function clear(Request $request)
    {
        session()->forget('view_as');
        return back();
    }
}
