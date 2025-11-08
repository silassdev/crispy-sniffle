@extends('layouts.guest')

@section('title','Not allowed')

@section('content')
@php
  // Default for guests
  $dashboardRoute = 'home';
  $dashboardLabel = 'Return home';

  if (auth()->check()) {
      $u = auth()->user();

      // Resolve route name by role (safe-guard with method_exists)
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

<div class="max-w-2xl mx-auto py-16 px-4">
  <div class="bg-white p-6 rounded shadow text-center">
    <h1 class="text-2xl font-semibold mb-2">Access denied</h1>

    {{-- show provided role if available, otherwise fallback to actual user role --}}
    <p class="text-gray-600 mb-4">
      Your account (role: {{ $userRole ?? (auth()->check() ? (auth()->user()->role ?? 'unknown') : 'guest') }}) is not allowed here.
    </p>

    <p class="text-sm text-gray-500">
      This page requires: {{ implode(', ', $requiredRoles ?? []) }}.
    </p>

    <div class="mt-6">
      <a href="{{ route($dashboardRoute) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
        {{ $dashboardLabel }}
      </a>
    </div>
  </div>
</div>
@endsection
