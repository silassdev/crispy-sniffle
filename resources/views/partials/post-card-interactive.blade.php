@php
    $gradients = [
        'from-blue-500 via-purple-500 to-pink-500',
        'from-green-400 via-cyan-500 to-blue-500',
        'from-pink-500 via-red-500 to-yellow-500',
        'from-purple-600 via-pink-500 to-red-500',
        'from-indigo-500 via-purple-500 to-pink-500',
        'from-yellow-400 via-orange-500 to-red-500',
    ];
    $randomGradient = $gradients[array_rand($gradients)];
    $commentCount = $post->comments()->count();
@endphp

<article class="group relative bg-white rounded-3xl border border-gray-100 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 overflow-hidden flex flex-col">
    {{-- Gradient accent bar --}}
    <div class="h-2 bg-gradient-to-r {{ $randomGradient }}"></div>

    {{-- Image Container --}}
    @if($post->feature_image)
        <div class="relative aspect-[16/9] overflow-hidden">
            <img src="{{ asset('storage/'.$post->feature_image) }}" 
                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110" 
                 alt="{{ $post->title }}">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent"></div>
            
            {{-- Tags on Image --}}
            <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                @foreach($post->tags->take(3) as $tag)
                    <span class="px-3 py-1 bg-white/90 backdrop-blur-md text-gray-800 text-xs font-bold rounded-full shadow-lg">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Content --}}
    <div class="p-6 flex flex-col flex-1">
        {{-- Author info --}}
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br {{ $randomGradient }} flex items-center justify-center text-white font-bold text-lg shadow-lg">
                {{ substr($post->author->name, 0, 1) }}
            </div>
            <div>
                <div class="text-sm font-bold text-gray-900">
                    {{ $post->author->name }}
                </div>
                <div class="text-xs text-gray-500 font-medium">
                    {{ $post->published_at?->diffForHumans() ?? 'Recently' }}
                </div>
            </div>
        </div>

        {{-- Title --}}
        <h3 class="text-xl font-extrabold text-gray-900 mb-3 group-hover:bg-gradient-to-r group-hover:{{ $randomGradient }} group-hover:bg-clip-text group-hover:text-transparent transition-all duration-300 leading-tight line-clamp-2">
            <a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>

        {{-- Excerpt --}}
        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
            {{ $post->excerpt }}
        </p>

        {{-- Reactions Component --}}
        <div class="mt-auto pt-4 border-t border-gray-100">
            <livewire:community.post-interaction :post="$post" :key="'post-reaction-'.$post->id" />
        </div>

        {{-- Comments Section --}}
        <div class="mt-4 pt-4 border-t border-gray-100" x-data="{ showComments: false }">
            {{-- Comment toggle --}}
            <button 
                @click="showComments = !showComments"
                class="flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors w-full"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
                <span>{{ $commentCount }} {{ Str::plural('Comment', $commentCount) }}</span>
                <svg class="w-4 h-4 ml-auto transform transition-transform" :class="{ 'rotate-180': showComments }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            {{-- Comment thread (collapsed by default) --}}
            <div x-show="showComments" x-collapse class="mt-4">
                <livewire:comments.thread :post="$post" :key="'post-comments-'.$post->id" />
            </div>
        </div>

        {{-- View Full Post Link --}}
        <div class="mt-4 pt-4 border-t border-gray-100">
            <a href="{{ route('blogs.show', $post->slug) }}" 
               class="inline-flex items-center gap-2 text-sm font-bold bg-gradient-to-r {{ $randomGradient }} bg-clip-text text-transparent group/btn">
                Read Full Post
                <svg class="w-5 h-5 text-gray-400 transform group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>
</article>
