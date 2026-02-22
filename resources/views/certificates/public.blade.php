@extends('layouts.app')
@section('title', 'Certificate Verification — ' . $cert->certificate_number)
@section('content')
<div class="min-h-screen bg-slate-50 py-12 px-4 flex flex-col items-center">
    <div class="mb-10 text-center">
        <span class="inline-flex items-center gap-2 px-6 py-2 bg-white text-green-600 rounded-full text-sm font-bold shadow-lg border border-green-50">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            OFFICIAL DIGITAL VERIFICATION
        </span>
    </div>
    <div class="certificate-web-shadow rounded-sm overflow-hidden bg-white">
        @include('certificates._certificate_content', ['cert' => $cert])
    </div>
</div>
<style>
.certificate-web-shadow { box-shadow: 0 50px 100px -20px rgba(0,0,0,0.2); }
@media (max-width: 800pt) { .certificate-web-shadow { width: 100%; transform: scale(0.9); } }
</style>
@endsection
