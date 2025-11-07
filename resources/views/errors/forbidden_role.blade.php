@extends('layouts.guest')

@section('title','Not allowed')

@section('content')
<div class="max-w-2xl mx-auto py-16 px-4">
  <div class="bg-white p-6 rounded shadow text-center">
    <h1 class="text-2xl font-semibold mb-2">Access denied</h1>
    <p class="text-gray-600 mb-4">Your account (role: {{ $userRole }}) is not allowed here.</p>
    <p class="text-sm text-gray-500">This page requires: {{ implode(', ', $requiredRoles) }}.</p>
    <div class="mt-6">
      <a href="{{ route('home') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Return home</a>
      <a href="{{ route('login') }}" class="px-4 py-2 border rounded">Sign in</a>
    </div>
  </div>
</div>
@endsection
