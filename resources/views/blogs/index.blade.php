@extends('layouts.app')

@section('title', 'Our Blog')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-blue-900 to-indigo-800 text-white py-24 mb-16">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 animate-fade-in-up">
                    Insights & <span class="text-blue-400">Stories</span>
                </h1>
                <p class="text-xl text-blue-100 mb-10 leading-relaxed">
                    Explore our latest articles, tutorials, and community updates. Stay ahead of the curve with expert knowledge.
                </p>

                <!-- Integrated Search -->
                <form method="GET" action="{{ route('blogs.index') }}" class="relative max-w-xl mx-auto group">
                    <input name="q" value="{{ request('q') }}" placeholder="Search our articles..." 
                           class="w-full px-8 py-5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-blue-200 outline-none focus:ring-4 focus:ring-blue-500/20 focus:bg-white/20 transition-all duration-300 shadow-2xl" />
                    <button class="absolute right-3 top-2.5 px-6 py-2.5 bg-blue-500 hover:bg-blue-400 text-white font-bold rounded-xl transition duration-300 shadow-lg flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="hidden sm:inline">Search</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Feed Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        @if(request('q'))
            <div class="mb-12 flex items-center gap-4 animate-fade-in-up">
                <p class="text-gray-500 font-medium">Showing results for:</p>
                <span class="px-4 py-1.5 bg-blue-100 text-blue-700 rounded-full font-bold text-sm border border-blue-200 shadow-sm">
                    "{{ request('q') }}"
                </span>
                <a href="{{ route('blogs.index') }}" class="text-sm text-gray-400 hover:text-blue-600 transition-colors font-bold underline underline-offset-4">Clear search</a>
            </div>
        @endif

        <div class="bg-white/50 rounded-[3rem] p-8 md:p-12 border border-gray-100 shadow-sm backdrop-blur-sm">
            <livewire:community.community-feed post-type="blog" />
        </div>
    </div>
</div>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
</style>
@endsection
