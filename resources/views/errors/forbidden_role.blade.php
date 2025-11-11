@extends('layouts.guest')

@section('title','Not allowed')

@section('content')
@php
  // Default for guests
  $dashboardRoute = 'home';
  $dashboardLabel = 'Return home';

  if (auth()->check()) {
      $u = auth()->user();

      if (method_exists($u, 'isAdmin') && $u->isAdmin()) {
          $dashboardRoute = 'admin.dashboard';
      } elseif (method_exists($u, 'isTrainer') && $u->isTrainer()) {
          $dashboardRoute = 'trainer.dashboard';
      } else {
          $dashboardRoute = 'student.dashboard';
      }

      $dashboardLabel = 'Return to dashboard';
  }
@endphp

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 via-indigo-50 to-purple-100">
  <div class="bg-white p-8 rounded-xl shadow-xl text-center transform transition hover:scale-[1.02] animate-fadeIn">
    
    <!-- Icon / visual cue -->
    <div class="flex justify-center mb-6">
      <svg class="w-16 h-16 text-red-500 animate-pulse" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 5a7 7 0 100 14a7 7 0 000-14z" />
      </svg>
    </div>

    <!-- Title -->
    <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Access Denied</h1>

    <!-- Role info -->
    <p class="text-gray-600 mb-4">
      Your account 
      <span class="font-semibold text-indigo-600">
        {{ $userRole ?? (auth()->check() ? (auth()->user()->role ?? 'unknown') : 'guest') }}
      </span>
       is not allowed here.
    </p>

    <!-- Required roles -->
    <p class="text-sm text-gray-500 italic">
      This page requires: {{ implode(', ', $requiredRoles ?? []) }}.
    </p>

    <!-- Action button -->
    <div class="mt-8">
      <a href="{{ route($dashboardRoute) }}" 
         class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md text-lg font-medium transition transform hover:scale-105 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300">
        {{ $dashboardLabel }}
      </a>
    </div>
  </div>
</div>
@endsection
