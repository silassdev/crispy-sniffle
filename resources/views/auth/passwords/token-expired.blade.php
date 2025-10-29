@extends('layouts.app')

@section('title','Reset link expired')

@section('content')
  <div class="max-w-md mx-auto bg-white p-6 rounded shadow text-center">
    <h1 class="text-2xl font-semibold mb-3">Reset link expired or already used</h1>
    <p class="text-sm text-gray-600 mb-6">The password reset link is no longer valid. For security, links can only be used once or they expire after a short time.</p>

    <div class="flex justify-center gap-3">
      <a href="{{ route('password.request') }}" class="px-4 py-2 bg-slate-900 text-white rounded">Request a new link</a>
      <a href="{{ route('home') }}" class="px-4 py-2 border rounded">Return home</a>
    </div>
  </div>
@endsection
