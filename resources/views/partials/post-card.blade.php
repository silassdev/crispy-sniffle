<article class="bg-white rounded shadow p-4">
  @if($post->feature_image)
    <img src="{{ asset('storage/'.$post->feature_image) }}" class="w-full h-48 object-cover rounded mb-3" alt="{{ $post->title }}">
  @endif
  <h3 class="text-lg font-semibold"><a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a></h3>
  <p class="text-xs text-gray-500">By {{ $post->author->name }} • {{ $post->published_at?->diffForHumans() }}</p>
  <p class="mt-2 text-sm text-gray-700">{{ $post->excerpt }}</p>
  <div class="mt-3 flex items-center justify-between">
    <div class="flex gap-2 text-xs text-gray-500">
      @foreach($post->tags as $tag)
        <a href="{{ route('blogs.index', ['tag' => $tag->slug]) }}" class="px-2 py-1 bg-gray-100 rounded">{{ $tag->name }}</a>
      @endforeach
    </div>
    <a href="{{ route('blogs.show', $post->slug) }}" class="text-sm text-indigo-600">Read →</a>
  </div>
</article>
