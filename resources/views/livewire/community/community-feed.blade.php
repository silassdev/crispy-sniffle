<div class="space-y-12">
  <div class="flex items-center justify-between">
    <div class="flex items-center gap-3">
      @if($q)
        <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-100 rounded-full">
            <span class="text-sm text-blue-600 font-bold">Search: "{{ $q }}"</span>
            <button wire:click="$set('q', null)" class="text-blue-400 hover:text-blue-600 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
      @endif
    </div>

    <div class="flex gap-2 text-xs font-bold text-gray-400 uppercase tracking-widest">
      @if($tag)
        <span class="text-blue-600">Filtered by Tag</span>
        <button wire:click="$set('tag', null)" class="hover:text-rose-500">Clear</button>
      @endif
    </div>
  </div>

  <div class="grid md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-8 lg:gap-12">
    @forelse($posts as $post)
      <article class="group relative bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden flex flex-col h-full bg-gradient-to-b from-white to-gray-50/30">
        <!-- Image Container -->
        @if($post->feature_image)
          <div class="relative aspect-[16/10] overflow-hidden m-4 rounded-[2rem]">
              <img src="{{ asset('storage/'.$post->feature_image) }}" 
                   class="w-full h-full object-cover transition duration-700 group-hover:scale-110" 
                   alt="{{ $post->title }}">
              <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
              
              <!-- Tags on Image -->
              <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                  @foreach($post->tags->take(2) as $t)
                      <button wire:click="$set('tag', '{{ $t->slug }}')" 
                              class="px-3 py-1 bg-white/20 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-wider rounded-full border border-white/30 hover:bg-white hover:text-blue-600 transition-all duration-300">
                          {{ $t->name }}
                      </button>
                  @endforeach
              </div>
          </div>
        @endif

        <!-- Content -->
        <div class="px-8 pb-8 pt-4 flex flex-col flex-1">
          <div class="flex items-center gap-3 mb-6">
              <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-blue-200 uppercase">
                  {{ substr($post->author->name, 0, 1) }}
              </div>
              <div>
                  <div class="text-[11px] font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-0.5">
                      {{ $post->author->name }}
                  </div>
                  <div class="text-[10px] text-gray-400 font-semibold italic">
                      {{ $post->published_at?->diffForHumans() ?? 'Recently' }}
                  </div>
              </div>
          </div>

          <h3 class="text-2xl font-extrabold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors duration-300 leading-tight">
              <a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a>
          </h3>

          <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-8 flex-1">
              {{ $post->excerpt }}
          </p>

          <div class="pt-6 border-t border-gray-100 flex items-center justify-between mt-auto">
              <div class="flex gap-3">
                   @foreach($post->tags->slice(2, 2) as $t)
                      <button wire:click="$set('tag','{{ $t->slug }}')" 
                         class="text-[10px] font-bold text-gray-400 hover:text-blue-600 transition-colors uppercase tracking-widest">
                          #{{ $t->name }}
                      </button>
                  @endforeach
              </div>
              
              <a href="{{ route('blogs.show', $post->slug) }}" 
                 class="inline-flex items-center gap-2 text-sm font-extrabold text-blue-600 group/btn">
                  Explore
                  <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                  </svg>
              </a>
          </div>
        </div>
      </article>
    @empty
      <div class="col-span-full py-20 text-center animate-fade-in-up">
        <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">No posts found</h3>
        <p class="text-gray-500">Try adjusting your search or filters to find what you're looking for.</p>
        @if($q || $tag)
            <button wire:click="$set('q', null); $set('tag', null)" class="mt-6 font-bold text-blue-600 hover:text-blue-700 underline underline-offset-4">Reset all filters</button>
        @endif
      </div>
    @endforelse
  </div>

  <div class="mt-16">
    {{ $posts->links() }}
  </div>
</div>
