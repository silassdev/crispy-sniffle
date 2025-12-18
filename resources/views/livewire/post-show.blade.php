<div class="prose lg:prose-xl mx-auto">
  @php
    // safe media handling: support Spatie medialibrary if available,
    // otherwise fall back to legacy feature_image path.
    $media = null;
    if (method_exists($post, 'getFirstMedia')) {
        try { $media = $post->getFirstMedia('feature_images'); } catch (\Throwable $e) { $media = null; }
    }
    $imageUrl = $media
      ? ($media->getUrl('feature') ?? $media->getUrl())
      : ($post->feature_image ? asset('storage/'.$post->feature_image) : null);

    $webpUrl = $media ? ($media->getUrl('feature_webp') ?? $media->getUrl('feature')) : null;
  @endphp

  {{-- Feature image with WebP fallback --}}
  @if($imageUrl)
    <figure class="m-0">
      <picture>
        @if($webpUrl)
          <source srcset="{{ $webpUrl }}" type="image/webp">
        @endif
        <img src="{{ $imageUrl }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded">
      </picture>
    </figure>
  @endif

  {{-- Title --}}
  <h1 class="mt-4 font-bold">{{ $post->title }}</h1>

  {{-- Byline --}}
  <div class="text-sm text-gray-500 mb-4">
    By {{ optional($post->author)->name ?? 'Unknown' }} •
    @if($post->published_at)
      {{ $post->published_at->toDayDateTimeString() }}
    @else
      {{ $post->created_at?->diffForHumans() ?? 'Just now' }}
    @endif
  </div>

  {{-- Excerpt --}}
  @if(!empty($post->excerpt))
    <p class="text-lg text-gray-700">{{ $post->excerpt }}</p>
  @endif

  {{-- Reactions & meta --}}
  <div class="flex items-center gap-4 mt-4">
    <div class="flex items-center gap-2">
      @foreach($reactions ?? collect() as $r)
        <div class="text-sm text-gray-600">{{ $r->type }} • {{ $r->total }}</div>
      @endforeach
    </div>

    <div class="flex items-center gap-2 ml-auto">
      <button wire:click="toggleReaction('like')" class="px-3 py-1 border rounded text-sm" wire:loading.attr="disabled">
        👍 Like
      </button>
      <button wire:click="toggleReaction('love')" class="px-3 py-1 border rounded text-sm" wire:loading.attr="disabled">
        💚 Love
      </button>
      <div class="text-sm text-gray-500 ml-3">{{ $commentsCount ?? $post->comments()->count() }} comments</div>
    </div>
  </div>

  {{-- Body --}}
  <article class="mt-6 leading-relaxed text-gray-800">
    {!! $post->body !!}
  </article>

  {{-- Tags --}}
  @if($post->tags && $post->tags->count())
    <div class="mt-6 flex flex-wrap gap-2">
      @foreach($post->tags as $tag)
        <a href="{{ route('blogs.index', ['tag' => $tag->slug]) }}" class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $tag->name }}</a>
      @endforeach
    </div>
  @endif

  {{-- Comments thread (allows auth check inside component) --}}
  <div class="mt-10">
    <h3 class="text-lg font-semibold mb-3">Comments</h3>
    <livewire:comments.thread :post="$post" />
  </div>
</div>
