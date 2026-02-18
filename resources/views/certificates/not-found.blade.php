@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-10 shadow rounded text-center">
        <h2 class="text-2xl font-bold text-red-600 mb-4">
            Certificate Not Found
        </h2>

        <p class="text-gray-600 mb-4">
            Certificate number: {{ $number }}
        </p>

        <p class="text-gray-500">
            Please verify the certificate number and try again.
        </p>
    </div>
</div>
@endsection
