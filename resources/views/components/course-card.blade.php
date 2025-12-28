@props(['course', 'showLock' => null])

@php
    // Auto-detect if course should show lock if not explicitly set
    if ($showLock === null) {
        $showLock = !$course->is_public;
    }
@endphp

<div class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
    {{-- Course Image/Thumbnail --}}
    <div class="relative h-48 bg-gradient-to-br from-indigo-500 to-purple-600 overflow-hidden">
        @if($course->getFirstMediaUrl('illustration'))
            <img src="{{ $course->getFirstMediaUrl('illustration') }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
        @else
            <div class="absolute inset-0 flex items-center justify-center">
                <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        @endif
        
        {{-- Badge (Free/Locked) --}}
        <div class="absolute top-3 right-3">
            @if($showLock)
                <span class="px-3 py-1 bg-amber-500 text-white text-xs font-bold rounded-full flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                    LOCKED
                </span>
            @else
                <span class="px-3 py-1 bg-emerald-500 text-white text-xs font-bold rounded-full">FREE</span>
            @endif
        </div>
    </div>

    {{-- Course Content --}}
    <div class="p-6">
        <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition-colors">
            {{ $course->title }}
        </h3>
        
        @if($course->description)
            <p class="text-sm text-slate-600 mb-4 line-clamp-2">{{ $course->description }}</p>
        @endif

        {{-- Trainer Info --}}
        @if($course->trainer)
            <div class="flex items-center gap-2 mb-4 pb-4 border-b border-slate-100">
                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-bold">
                    {{ substr($course->trainer->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-slate-500 truncate">{{ $course->trainer->name }}</p>
                </div>
            </div>
        @endif

        {{-- Tags --}}
        @if($course->tags && count($course->tags) > 0)
            <div class="flex flex-wrap gap-1 mb-4">
                @foreach(array_slice($course->tags, 0, 3) as $tag)
                    <span class="px-2 py-1 bg-slate-100 text-slate-600 text-xs rounded">{{ $tag }}</span>
                @endforeach
            </div>
        @endif

        {{-- CTA Button --}}
        <a href="{{ route('courses.show', $course->slug) }}" class="block w-full text-center px-4 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
            View Course
        </a>
    </div>
</div>
