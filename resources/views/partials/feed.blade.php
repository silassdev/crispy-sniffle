@php
    $posts = $posts ?? \App\Models\Post::latest()->take(8)->get();
@endphp

<div class="space-y-4">
  @forelse($posts as $post)
    <article class="p-4 border rounded hover:shadow-sm transition" data-reveal>
      <a href="{{ url('/blogs/' . ($post->slug ?? $post->id)) }}" class="block">
        <h3 class="font-semibold text-lg">{{ $post->title ?? 'Untitled post' }}</h3>
        <p class="text-sm text-gray-500 mt-1">{{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->body ?? ''), 140) }}</p>
      </a>
      <div class="mt-3 text-xs text-gray-400">
        <span>{{ $post->created_at?->diffForHumans() ?? '' }}</span>
      </div>
    </article>
  @empty
    <div class="p-6 border rounded text-center">
      <p class="text-gray-600 mb-3">No posts yet.</p>
      <a href="{{ route('blogs') ?? '#' }}" class="text-sm text-indigo-600">Browse posts</a>
    </div>
  @endforelse
</div>
