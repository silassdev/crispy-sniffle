@extends('layouts.app')

@section('title', 'Certificate Verification — ' . $cert->certificate_number)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-50 py-10 px-4">
    <div class="max-w-4xl mx-auto">

        {{-- Verification Badge --}}
        <div class="flex items-center justify-center gap-2 mb-6">
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold border border-green-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Verified Certificate
            </span>
        </div>

        {{-- Certificate Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            {{-- Header Bar --}}
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 sm:px-10 py-6 text-center">
                <h1 class="text-xl sm:text-2xl font-bold tracking-wide">Certificate of Achievement</h1>
                <p class="text-indigo-200 text-sm mt-1">Official Verification</p>
            </div>

            {{-- Certificate Body --}}
            <div class="px-6 sm:px-10 py-8 sm:py-12 text-center">
                <p class="text-slate-500 text-sm uppercase tracking-widest mb-2">This is to certify that</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-indigo-700 mb-6">{{ $cert->student?->name ?? 'Student' }}</h2>

                <p class="text-slate-500 text-sm uppercase tracking-widest mb-2">has successfully completed</p>
                <h3 class="text-xl sm:text-2xl font-semibold text-slate-800 mb-8">{{ $cert->course?->title ?? 'Course Program' }}</h3>

                {{-- Details Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-2xl mx-auto text-left">
                    <div class="bg-slate-50 rounded-lg p-4 text-center">
                        <span class="block text-xs text-slate-500 uppercase font-semibold mb-1">Certificate No.</span>
                        <span class="block text-sm font-mono font-bold text-slate-800">{{ $cert->certificate_number }}</span>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-4 text-center">
                        <span class="block text-xs text-slate-500 uppercase font-semibold mb-1">Date Issued</span>
                        <span class="block text-sm font-bold text-slate-800">{{ $cert->issued_at?->format('F d, Y') ?? 'N/A' }}</span>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-4 text-center">
                        <span class="block text-xs text-slate-500 uppercase font-semibold mb-1">Instructor</span>
                        <span class="block text-sm font-bold text-slate-800">{{ $cert->trainer?->name ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="bg-slate-50 border-t border-slate-200 px-6 sm:px-10 py-5 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('certificates.pdf.download', $cert->id) }}"
                   class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17v3a2 2 0 002 2h14a2 2 0 002-2v-3"/></svg>
                    Download PDF
                </a>
                <a href="{{ route('certificates.pdf.preview', $cert->id) }}" target="_blank"
                   class="inline-flex items-center gap-2 px-6 py-2.5 bg-white text-slate-700 font-medium rounded-lg hover:bg-slate-100 transition-colors shadow-sm border border-slate-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Preview PDF
                </a>
            </div>
        </div>

        {{-- Verification Info --}}
        <div class="mt-6 text-center text-sm text-slate-500">
            <p>This certificate can be verified at: <span class="font-mono text-indigo-600">{{ url('/verify/' . $cert->certificate_number) }}</span></p>
        </div>

    </div>
</div>
@endsection
