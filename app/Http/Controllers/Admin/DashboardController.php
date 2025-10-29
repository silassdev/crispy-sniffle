<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $blogsCount = Blog::count();
        $adminsCount = User::where('is_admin', true)->count();
        return view('admin.dashboard', compact('blogsCount','adminsCount'));
    }
}
