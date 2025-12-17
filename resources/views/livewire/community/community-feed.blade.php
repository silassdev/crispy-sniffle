<div class="space-y-6">
  <div class="flex items-center justify-between">
    <div class="flex items-center gap-3">
      <input type="search" wire:model.debounce.300ms="q" placeholder="Search posts..." class="border rounded px-3 py-2" />
      @if($q)
        <button wire:click="$set('q', null)" class="text-sm text-gray-500">Clear</button>
      @endif
    </div>

    <div>
      {{-- tags quick list (optional: load top tags) --}}
    </div>
  </div>

  <div class="grid md:grid-cols-2 gap-6">
    @forelse($posts as $post)
      <article class="bg-white rounded shadow p-4 flex flex-col">
        @if($post->feature_image)
          <img src="{{ asset('storage/'.$post->feature_image) }}" alt="" class="w-full h-44 object-cover rounded mb-3">
        @endif

        <h3 class="text-lg font-semibold"><a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a></h3>
        <p class="text-xs text-gray-500">By {{ $post->author->name }} • {{ $post->published_at?->diffForHumans() }}</p>
        <p class="mt-2 text-gray-700 flex-1">{{ $post->excerpt }}</p>

        <div class="mt-3 flex items-center justify-between">
          <div class="flex gap-2">
            @foreach($post->tags as $tag)
              <button wire:click="$set('tag','{{ $tag->slug }}')" class="px-2 py-1 bg-gray-100 rounded text-xs">{{ $tag->name }}</button>
            @endforeach
          </div>
          <a href="{{ route('blogs.show', $post->slug) }}" class="text-indigo-600 text-sm">Read →</a>
        </div>
      </article>
    @empty
      <div class="col-span-2 text-center text-gray-500">No posts found.</div>
    @endforelse
  </div>

  <div>
    {{ $posts->links() }}
  </div>
</div>
