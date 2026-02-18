@extends('layouts.app')

@section('title', 'Certificate Not Found')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-red-50 flex items-center justify-center px-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8 text-center">

            {{-- Icon --}}
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <h2 class="text-xl font-bold text-slate-800 mb-2">Certificate Not Found</h2>
            <p class="text-slate-500 text-sm mb-4">
                No certificate was found matching:
            </p>
            <p class="font-mono text-sm bg-slate-100 text-slate-700 px-4 py-2 rounded-lg inline-block mb-6">
                {{ $number }}
            </p>

            {{-- Search Form --}}
            <div class="border-t border-slate-200 pt-6">
                <p class="text-sm text-slate-500 mb-3">Try searching with a different certificate number:</p>
                <form action="{{ route('certificate.verify', ':placeholder') }}" method="GET" id="cert-search-form" class="flex gap-2">
                    <input type="text" id="cert-number-input" placeholder="e.g. CERT-20260218-ABC123" 
                           class="flex-1 px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                           required>
                    <button type="submit"
                            class="px-4 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors">
                        Verify
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('cert-search-form').addEventListener('submit', function(e) {
        e.preventDefault();
        var num = document.getElementById('cert-number-input').value.trim();
        if (num) {
            window.location.href = '/verify/' + encodeURIComponent(num);
        }
    });
</script>
@endsection
