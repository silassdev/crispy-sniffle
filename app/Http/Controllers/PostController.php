<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with('author','tags')->latest('published_at');

        if ($request->filled('tag')) {
            $query->whereHas('tags', fn($q) => $q->where('slug', $request->input('tag')));
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function($s) use ($q){
                $s->where('title','like',"%{$q}%")
                  ->orWhere('body','like',"%{$q}%")
                  ->orWhere('excerpt','like',"%{$q}%");
            });
        }

        $posts = $query->paginate(12)->withQueryString();

        return view('blogs.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::published()->with('author','tags','comments')->where('slug', $slug)->firstOrFail();

        // increment views atomically
        try {
            \DB::table('posts')->where('id', $post->id)->increment('views');
            $post->views++;
        } catch (\Throwable $e) {
            // ignore increment errors
        }

        return view('blogs.show', compact('post'));
    }
}
