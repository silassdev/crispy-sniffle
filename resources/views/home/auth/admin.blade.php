@extends('layouts.app')

@section('title')
Admin Home — {{ config('app.name') }}
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50">
    {{-- Hero Section for Admin --}}
    <section class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 py-16">
        {{-- Abstract Background Blurs --}}
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/2 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-sm font-bold mb-4">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                    </svg>
                    Admin Access
                </div>
                <h1 class="text-5xl md:text-6xl font-black text-white mb-4 drop-shadow-lg">
                    Admin Home 👑
                </h1>
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl mx-auto mb-8">
                    Quick overview and access — this is not the admin dashboard
                </p>
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-flex items-center gap-3 px-8 py-4 bg-white text-indigo-600 font-bold text-lg rounded-full shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Go to Admin Dashboard</span>
                </a>
            </div>
        </div>
    </section>

    {{-- Quick Stats --}}
    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-12">
            <h2 class="text-3xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6">
                Quick Metrics
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @php
                $quickStats = [
                    [
                        'label' => 'Total Users',
                        'value' => \App\Models\User::count(),
                        'icon' => '👥',
                        'gradient' => 'from-blue-500 to-cyan-500',
                        'bg' => 'bg-blue-50',
                        'link' => route('admin.students.index')
                    ],
                    [
                        'label' => 'Active Posts',
                        'value' => \App\Models\Post::published()->count(),
                        'icon' => '📝',
                        'gradient' => 'from-green-500 to-emerald-500',
                        'bg' => 'bg-green-50',
                        'link' => route('admin.community')
                    ],
                    [
                        'label' => 'Total Comments',
                        'value' => \App\Models\Comment::count(),
                        'icon' => '💬',
                        'gradient' => 'from-purple-500 to-pink-500',
                        'bg' => 'bg-purple-50',
                        'link' => route('admin.posts')
                    ],
                    [
                        'label' => 'Reactions',
                        'value' => \App\Models\Reaction::count(),
                        'icon' => '⚡',
                        'gradient' => 'from-orange-500 to-red-500',
                        'bg' => 'bg-orange-50',
                        'link' => '#'
                    ]
                ];
            @endphp

            @foreach($quickStats as $stat)
                <a href="{{ $stat['link'] }}" class="block relative group">
                    <div class="absolute inset-0 bg-gradient-to-r {{ $stat['gradient'] }} rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative {{ $stat['bg'] }} rounded-2xl p-6 border border-white shadow-lg group-hover:scale-105 transition-transform">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-xs font-semibold uppercase tracking-wide mb-1">{{ $stat['label'] }}</p>
                                <p class="text-3xl font-black bg-gradient-to-r {{ $stat['gradient'] }} bg-clip-text text-transparent">
                                    {{ $stat['value'] }}
                                </p>
                            </div>
                            <div class="text-4xl">{{ $stat['icon'] }}</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Community Preview --}}
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Community Activity</h3>
                <a href="{{ route('admin.community') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                    Manage All Posts →
                </a>
            </div>

            @if($posts->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts->take(6) as $post)
                        <div data-reveal>
                            @include('partials.post-card-interactive', ['post' => $post])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">No posts yet</p>
                </div>
            @endif
        </div>

        {{-- Quick Links --}}
        <div class="mt-12">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    $quickLinks = [
                        [
                            'label' => 'Create New Post',
                            'icon' => '✍️',
                            'gradient' => 'from-blue-600 to-cyan-600',
                            'link' => route('admin.posts.create')
                        ],
                        [
                            'label' => 'Manage Users',
                            'icon' => '👤',
                            'gradient' => 'from-purple-600 to-pink-600',
                            'link' => route('admin.students.index')
                        ],
                        [
                            'label' => 'View Analytics',
                            'icon' => '📊',
                            'gradient' => 'from-orange-600 to-red-600',
                            'link' => route('admin.dashboard')
                        ]
                    ];
                @endphp

                @foreach($quickLinks as $link)
                    <a href="{{ $link['link'] }}" 
                       class="group relative overflow-hidden bg-gradient-to-r {{ $link['gradient'] }} rounded-2xl p-6 text-white shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
                        <div class="relative z-10 flex items-center justify-between">
                            <span class="text-lg font-bold">{{ $link['label'] }}</span>
                            <span class="text-3xl">{{ $link['icon'] }}</span>
                        </div>
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</div>

{{-- Add blob animation --}}
<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endsection
