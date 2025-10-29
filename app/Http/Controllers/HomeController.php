<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $recent = Blog::where('status','published')->orderBy('published_at','desc')->take(2)->get();
        return view('home', compact('recent'));
    }
}
