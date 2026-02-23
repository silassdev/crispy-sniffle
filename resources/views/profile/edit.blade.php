@section('title', 'My Profile - ' . config('app.name'))

<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        {{-- Profile Header --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="h-32 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
            <div class="px-8 pb-8">
                <div class="relative flex flex-col md:flex-row items-end -mt-12 gap-6">
                    <div class="relative">
                        <img 
                            src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff' }}" 
                            alt="{{ $user->name }}" 
                            class="w-32 h-32 rounded-3xl object-cover border-4 border-white shadow-md bg-white"
                        >
                        @if($user->approved)
                            <div class="absolute -bottom-1 -right-1 bg-green-500 border-4 border-white rounded-full p-1.5 shadow-sm" title="Verified Account">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow pb-2">
                        <h1 class="text-3xl font-bold text-gray-900 leading-tight">{{ $user->name }}</h1>
                        <p class="text-gray-500 font-medium">{{ ucfirst($user->role) }} • Member since {{ $user->created_at->format('M Y') }}</p>
                    </div>
                    <div class="flex gap-3 pb-2">
                        @if($user->github_url)
                            <a href="{{ $user->github_url }}" target="_blank" class="p-2.5 bg-gray-50 text-gray-600 rounded-xl hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                            </a>
                        @endif
                        @if($user->linkedin_url)
                            <a href="{{ $user->linkedin_url }}" target="_blank" class="p-2.5 bg-gray-50 text-gray-600 rounded-xl hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Statistics --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12 border-t border-gray-100 pt-8">
                    <div class="px-2">
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['enrolled_courses'] }}</p>
                        <p class="text-sm text-gray-500 font-medium">Courses Enrolled</p>
                    </div>
                    <div class="px-2">
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['certificates'] }}</p>
                        <p class="text-sm text-gray-500 font-medium">Certificates Earned</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start" x-data="{ tab: 'general' }">
            {{-- Navigation Sidebar --}}
            <div class="w-full lg:w-72 flex-shrink-0 space-y-1 bg-white p-4 rounded-3xl shadow-sm border border-gray-100 sticky top-24">
                <button 
                    @click="tab = 'general'" 
                    :class="tab === 'general' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50'"
                    class="w-full text-left px-4 py-3 rounded-xl flex items-center gap-3 transition-all duration-200"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-semibold text-sm">General Information</span>
                </button>

                <button 
                    @click="tab = 'social'" 
                    :class="tab === 'social' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50'"
                    class="w-full text-left px-4 py-3 rounded-xl flex items-center gap-3 transition-all duration-200"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    <span class="font-semibold text-sm">Social Connections</span>
                </button>

                <button 
                    @click="tab = 'security'" 
                    :class="tab === 'security' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50'"
                    class="w-full text-left px-4 py-3 rounded-xl flex items-center gap-3 transition-all duration-200"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <span class="font-semibold text-sm">Security & Password</span>
                </button>

                <button 
                    @click="tab = 'danger'" 
                    :class="tab === 'danger' ? 'bg-red-50 text-red-600' : 'text-gray-600 hover:bg-red-50 hover:text-red-600'"
                    class="w-full text-left px-4 py-3 rounded-xl flex items-center gap-3 transition-all duration-200"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <span class="font-semibold text-sm">Delete Account</span>
                </button>
            </div>

            {{-- Content Area --}}
            <div class="flex-grow w-full space-y-6">
                {{-- General Tab --}}
                <div x-show="tab === 'general'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- Social Tab --}}
                <div x-show="tab === 'social'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        @include('profile.partials.social-links-form')
                    </div>
                </div>

                {{-- Security Tab --}}
                <div x-show="tab === 'security'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- Danger Tab --}}
                <div x-show="tab === 'danger'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
