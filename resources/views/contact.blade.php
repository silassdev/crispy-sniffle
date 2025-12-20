@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-slate-900 py-24 mb-16 group">
        <!-- Abstract Decoration -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-indigo-600 rounded-full blur-[100px] opacity-40 group-hover:opacity-60 transition-opacity"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-blue-600 rounded-full blur-[100px] opacity-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 animate-fade-in-up text-white font-['Playfair_Display']">
                Let's <span class="text-indigo-400">Connect</span>
            </h1>
            <p class="text-xl md:text-2xl text-indigo-100/60 max-w-3xl mx-auto mb-10 leading-relaxed">
                Have a question or feedback? We're here to help. Send us a message and we'll get back to you as soon as possible.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row border border-gray-100">
            <!-- Contact Info -->
            <div class="lg:w-2/5 bg-blue-600 p-12 text-white flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 -m-20 w-80 h-80 bg-blue-500 rounded-full opacity-20 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold mb-8">Get in Touch</h2>
                    <div class="space-y-10">
                        <div class="flex items-start gap-5">
                            <div class="bg-white/10 p-3 rounded-2xl backdrop-blur-sm">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-blue-100 text-sm font-medium uppercase tracking-wider mb-1">Email Us</p>
                                <p class="text-xl font-semibold">support@lms-platform.com</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5">
                            <div class="bg-white/10 p-3 rounded-2xl backdrop-blur-sm">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-blue-100 text-sm font-medium uppercase tracking-wider mb-1">Visit Us</p>
                                <p class="text-xl font-semibold">123 Tech Avenue, Silicon Valley, CA</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 relative z-10">
                    <p class="text-blue-100 text-sm font-medium mb-4 uppercase tracking-wider">Follow our community</p>
                    <div class="flex gap-4">
                        <a href="#" class="bg-white/10 p-3 rounded-xl hover:bg-white/20 transition duration-300 backdrop-blur-sm">
                            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="bg-white/10 p-3 rounded-xl hover:bg-white/20 transition duration-300 backdrop-blur-sm">
                            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.45h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.284zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.017H3.555V9h3.564v11.45zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:w-3/5 p-12">
                @if(session('success'))
                    <div class="bg-emerald-50 border-l-4 border-emerald-400 p-6 mb-8 rounded-r-2xl flex items-center gap-4 animate-fade-in-up">
                        <div class="bg-emerald-100 p-2 rounded-full">
                            <svg class="h-6 w-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-emerald-800 font-bold">Message Sent!</p>
                            <p class="text-emerald-700 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-sm font-bold text-gray-700 uppercase tracking-wider">Your Name</label>
                            <input name="name" value="{{ old('name') }}" placeholder="Enter your full name" 
                                class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition duration-300 outline-none bg-gray-50/50" />
                            @error('name')<p class="text-rose-500 text-xs font-semibold mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="space-y-3">
                            <label class="text-sm font-bold text-gray-700 uppercase tracking-wider">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="name@company.com" 
                                class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition duration-300 outline-none bg-gray-50/50" />
                            @error('email')<p class="text-rose-500 text-xs font-semibold mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-sm font-bold text-gray-700 uppercase tracking-wider">Your Message</label>
                        <textarea name="message" rows="6" placeholder="How can we help you achieve your goals?" 
                            class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition duration-300 outline-none bg-gray-50/50 resize-none">{{ old('message') }}</textarea>
                        @error('message')<p class="text-rose-500 text-xs font-semibold mt-1">{{ $message }}</p>@enderror
                    </div>

                    <button class="w-full md:w-auto px-12 py-5 bg-blue-600 text-white font-extrabold rounded-2xl hover:bg-blue-700 transition duration-300 shadow-xl shadow-blue-200 flex items-center justify-center gap-3 group transform hover:-translate-y-1">
                        Send Message
                        <svg class="h-6 w-6 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>
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
