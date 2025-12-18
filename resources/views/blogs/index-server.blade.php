@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Blog</h1>

    <div class="grid md:grid-cols-2 gap-6">
      @forelse($posts as $post)
        <article class="bg-white rounded shadow p-4">
          @php $media = $post->getFirstMedia('feature_images'); @endphp
          @if($media)
            <picture>
              <source srcset="{{ $media->getUrl('thumb_webp') }}" type="image/webp">
              <img src="{{ $media->getUrl('thumb') }}" class="w-full h-40 object-cover rounded mb-3" alt="{{ $post->title }}">
            </picture>
          @elseif($post->feature_image)
            <img src="{{ asset('storage/'.$post->feature_image) }}" class="w-full h-40 object-cover rounded mb-3" alt="{{ $post->title }}">
          @endif

          <h2 class="text-lg font-semibold">
            <a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a>
          </h2>

          <div class="text-xs text-gray-500 mb-2">
            By {{ optional($post->author)->name ?: 'Unknown' }} • {{ $post->published_at?->diffForHumans() }}
          </div>

          <p class="text-gray-700 mb-3">{{ $post->excerpt }}</p>

          <div class="flex items-center justify-between">
            <div class="text-xs text-gray-500">{{ $post->comments()->count() }} comments</div>
            <a href="{{ route('blogs.show', $post->slug) }}" class="text-indigo-600 text-sm">Read →</a>
          </div>
        </article>
      @empty
        <div class="text-center text-gray-500">No posts yet.</div>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $posts->links() }}
    </div>
  </div>
@endsection
