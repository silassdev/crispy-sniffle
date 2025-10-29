<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status','published')->orderBy('published_at','desc')->paginate(6);
        return view('blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $post = Blog::where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('post'));
    }
}
