@php
    $posts = $posts ?? \App\Models\Post::latest()->take(6)->get();
@endphp

<div class="grid md:grid-cols-2 gap-8">
  @forelse($posts as $post)
    <div data-reveal class="h-full">
        @include('partials.post-card', ['post' => $post])
    </div>
  @empty
    <div class="col-span-full py-16 bg-white rounded-[2rem] border border-gray-100 text-center shadow-sm">
        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
        </div>
        <p class="text-gray-500 font-medium mb-4">No insights shared yet.</p>
        <a href="{{ route('blogs.index') ?? '#' }}" class="text-sm font-bold text-blue-600 hover:underline underline-offset-4">Explore our archive</a>
    </div>
  @endforelse
</div>
