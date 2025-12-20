@extends('layouts.guest')

@section('title','Not Found')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
  <div class="text-center max-w-md p-8">
    

    <div class="flex justify-center mb-6">
      <svg class="w-24 h-24 text-gray-400 animate-bounce-slow" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M3 9h18M9 21V9" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>


    <h1 class="text-2xl font-semibold text-gray-800 mb-2">Nothing here...</h1>


    <p class="text-gray-600 mb-4">
      Looks like this collection is empty. The page you’re looking for doesn’t exist or Removed.
    </p>


    <a href="{{ url('/') }}" 
       class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md transition transform hover:scale-105 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300">
      Back to Home
    </a>
  </div>
</div>
@endsection
