@extends('layouts.guest')

@section('title', 'Link issue')

@section('content')
  <div class="max-w-2xl mx-auto py-16 px-4">
    <div class="bg-white p-6 rounded shadow text-center">
      @php
        $type = request('type');
        $reason = request('reason');
      @endphp

      @if($reason === 'used')
        <h1 class="text-2xl font-semibold mb-2">This link has already been used</h1>
        <p class="text-gray-600 mb-4">It looks like this link was already used. If you expected otherwise, request a new link below.</p>
      @elseif($reason === 'expired' || $reason === 'invalid_or_expired')
        <h1 class="text-2xl font-semibold mb-2">This link has expired</h1>
        <p class="text-gray-600 mb-4">The link has expired. You can request a new one below.</p>
      @else
        <h1 class="text-2xl font-semibold mb-2">This link is invalid</h1>
        <p class="text-gray-600 mb-4">The link appears invalid. You can request help or try the relevant flow again.</p>
      @endif

      <div class="flex justify-center gap-3 mt-4">
        @if($type === 'invite')
          <a href="{{ route('home') }}" class="px-4 py-2 border rounded">Return home</a>
          <a href="{{ route('contact') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Contact support</a>
        @elseif($type === 'password')
          <a href="{{ route('password.request') }}" class="px-4 py-2 border rounded">Request password reset</a>
          <a href="{{ route('home') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Return home</a>
        @else
          <a href="{{ route('home') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Return home</a>
        @endif
      </div>

      @if(session('expires_at'))
        <p class="text-xs text-gray-400 mt-3">Original expiry: {{ session('expires_at') }}</p>
      @endif
    </div>
  </div>
@endsection
