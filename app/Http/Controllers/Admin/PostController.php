<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ResizePostImage;
use App\Jobs\GenerateWebP;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('author','tags')->latest('created_at');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function($s) use ($q){
                $s->where('title','like',"%{$q}%")
                  ->orWhere('body','like',"%{$q}%")
                  ->orWhere('excerpt','like',"%{$q}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $posts = $query->paginate(15)->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'excerpt' => ['nullable','string','max:600'],
            'body' => ['nullable','string'],
            'status' => ['required','in:draft,published'],
            'feature_image' => ['nullable','image','max:8192'],
            'tags' => ['nullable','string','max:500'],
        ]);

        $post = new Post();
        $post->title = $data['title'];
        $post->excerpt = $data['excerpt'] ?? Str::limit(strip_tags($data['body'] ?? ''), 160);
        $post->body = $data['body'] ?? null;
        $post->author_id = auth()->id();
        $post->status = $data['status'];
        if ($post->status === 'published') $post->published_at = now();

        // slug
        $base = Str::slug($post->title);
        $slug = $base;
        $i = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $post->slug = $slug;

        // persist first so we have an ID for jobs
        $post->save();

        // feature image: store raw and dispatch resize -> webp chain
        if ($request->hasFile('feature_image')) {
            $rawPath = $request->file('feature_image')->store('uploads/posts_raw', 'public');
            // temporarily store raw path
            $post->feature_image = $rawPath;
            $post->save();
            Bus::chain([
                new ResizePostImage($rawPath, $post->id),
                new GenerateWebP($post->id),
            ])->dispatch();
        }

        // tags
        if (! empty($data['tags'])) {
            $tags = array_filter(array_map('trim', explode(',', $data['tags'])));
            $tagIds = [];
            foreach ($tags as $t) {
                $tag = Tag::firstOrCreate(['slug' => Str::slug($t)], ['name' => $t]);
                $tagIds[] = $tag->id;
            }
            $post->tags()->sync($tagIds);
        }

        return redirect()->route('admin.posts')->with('success','Post created');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'excerpt' => ['nullable','string','max:600'],
            'body' => ['nullable','string'],
            'status' => ['required','in:draft,published'],
            'feature_image' => ['nullable','image','max:8192'],
            'tags' => ['nullable','string','max:500'],
        ]);

        $post->title = $data['title'];
        $post->excerpt = $data['excerpt'] ?? Str::limit(strip_tags($data['body'] ?? ''), 160);
        $post->body = $data['body'] ?? null;
        $post->status = $data['status'];
        if ($post->status === 'published' && ! $post->published_at) $post->published_at = now();

        // slug update if title changed
        $base = Str::slug($post->title);
        $slug = $base;
        $i = 1;
        while (Post::where('slug', $slug)->where('id','<>',$post->id)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $post->slug = $slug;

        $post->save();

        if ($request->hasFile('feature_image')) {
            $rawPath = $request->file('feature_image')->store('uploads/posts_raw', 'public');
            // delete old feature image and meta thumbs if present
            if ($post->feature_image) {
                Storage::disk('public')->delete($post->feature_image);
                $meta = is_array($post->meta) ? $post->meta : ($post->meta ? (array)$post->meta : []);
                foreach (['feature_thumbnail','feature_small','feature_webp','feature_webp_thumb'] as $k) {
                    if (! empty($meta[$k])) Storage::disk('public')->delete($meta[$k]);
                }
            }
            $post->feature_image = $rawPath;
            $post->save();

            Bus::chain([
                new ResizePostImage($rawPath, $post->id),
                new GenerateWebP($post->id),
            ])->dispatch();
        }

        // tags
        if (array_key_exists('tags', $data)) {
            $tags = array_filter(array_map('trim', explode(',', $data['tags'] ?? '')));
            $tagIds = [];
            foreach ($tags as $t) {
                $tag = Tag::firstOrCreate(['slug' => Str::slug($t)], ['name' => $t]);
                $tagIds[] = $tag->id;
            }
            $post->tags()->sync($tagIds);
        }

        return redirect()->route('admin.posts')->with('success','Post updated');
    }

    public function destroy(Post $post)
    {
        // cleanup stored files (best-effort)
        try {
            if ($post->feature_image) Storage::disk('public')->delete($post->feature_image);
            $meta = is_array($post->meta) ? $post->meta : ($post->meta ? (array)$post->meta : []);
            foreach (['feature_thumbnail','feature_small','feature_webp','feature_webp_thumb'] as $k) {
                if (! empty($meta[$k])) Storage::disk('public')->delete($meta[$k]);
            }
        } catch (\Throwable $e) {
            // continue; log if desired
        }

        $post->delete();

        return redirect()->route('admin.posts')->with('success','Post removed');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }
}
