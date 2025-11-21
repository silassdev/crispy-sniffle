@php
    // If controller passed $posts use it, otherwise load latest 10 posts
    $posts = $posts ?? \App\Models\Post::latest()->take(10)->get();
@endphp

<div class="space-y-4">
    @forelse($posts as $post)
        <article class="p-4 border rounded hover:shadow-sm transition">
            <a href="{{ url('/blogs/' . ($post->slug ?? $post->id)) }}" class="block">
                <h3 class="font-semibold text-lg">{{ $post->title ?? 'Untitled post' }}</h3>
                <p class="text-sm text-gray-500 mt-1">
                    {{ Str::limit(strip_tags($post->excerpt ?? $post->body ?? ''), 140) }}
                </p>
            </a>
            <div class="mt-3 text-xs text-gray-400">
                <span>{{ $post->created_at?->diffForHumans() ?? '' }}</span>
                @if($post->author_name ?? $post->author?->name)
                    • <span>{{ $post->author_name ?? $post->author->name }}</span>
                @endif
            </div>
        </article>
    @empty
        <div class="p-4 text-sm text-gray-500">No posts yet.</div>
    @endforelse
</div>
