<div class="prose lg:prose-xl mx-auto">
  <h1>{{ $post->title }}</h1>
  <div class="text-sm text-gray-500 mb-4">By {{ $post->author->name }} • {{ $post->published_at?->toDayDateTimeString() }}</div>

  @if($post->feature_image)
    <img src="{{ asset('storage/'.$post->feature_image) }}" alt="" class="w-full rounded mb-6">
  @endif

  <div class="leading-relaxed">{!! $post->body !!}</div>

  <div class="mt-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
      @foreach($reactions as $r)
        <div class="text-sm text-gray-600">{{ $r->type }} • {{ $r->total }}</div>
      @endforeach
    </div>

    <div class="flex items-center gap-2">
      <button wire:click="toggleReaction('like')" class="px-3 py-1 border rounded {{ $userReaction === 'like' ? 'bg-indigo-600 text-white' : '' }}">Like</button>
      <button wire:click="toggleReaction('love')" class="px-3 py-1 border rounded {{ $userReaction === 'love' ? 'bg-rose-600 text-white' : '' }}">Love</button>
      <button x-data @click.prevent="$wire.report()" class="px-3 py-1 border rounded text-sm">Report</button>
    </div>
  </div>

  <div class="mt-8">
    <h3 class="text-lg font-semibold">Comments ({{ $commentsCount }})</h3>
    <livewire:comments.thread :post="$post" />
  </div>
</div>
