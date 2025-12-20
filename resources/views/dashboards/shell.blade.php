@extends('layouts.app')

@php
  $role = $role ?? (auth()->user()->role ?? 'student');
  $section = $section ?? 'dashboard';
@endphp

@section('content')
  <div class="flex min-h-screen">
    {{-- Sidebar - sticky with max height --}}
    <aside class="w-64 flex-shrink-0 sticky top-0 h-screen overflow-y-auto bg-white border-r border-gray-200">
       @include('dashboards.partials.sidebar', ['role' => $role, 'section' => $section])
    </aside>

    {{-- Main content area - scrollable --}}
    <main class="flex-1 overflow-y-auto">
      <div id="admin-content" class="p-6">
        @if(View::exists("livewire.{$role}.{$section}"))
          <livewire:{{ $role }}.{{ $section }} />
        @elseif(View::exists("dashboards.partials.sections.{$role}.{$section}"))
          @include("dashboards.partials.sections.{$role}.{$section}")
        @elseif(View::exists("dashboards.partials.sections.{$section}"))
          @include("dashboards.partials.sections.{$section}")
        @else
          <div class="p-4 border rounded">
            <h2 class="text-xl font-semibold">No section found</h2>
            <p class="text-sm text-gray-500">Section: {{ $section }} (role: {{ $role }})</p>
          </div>
        @endif
      </div>
    </main>
  </div>
@endsection
