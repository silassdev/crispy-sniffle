@extends('layouts.app')

@section('title', 'Certificate Verification')

@section('content')
<div class="max-w-5xl mx-auto py-10">

    <div class="bg-white shadow-lg rounded-lg p-8 border">
        @include('certificates.partials.certificate-layout')
    </div>

    <div class="text-center mt-6">
        <a href="{{ route('certificate.download', $cert->certificate_number) }}"
           class="px-6 py-3 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Download PDF
        </a>
    </div>

</div>
@endsection
