{{-- dashboards/shell.blade.php --}}
@extends('layouts.app')

@php
  $role = $role ?? (auth()->user()->role ?? 'student');
  $section = $section ?? 'overview';
@endphp

@section('content')
  <div class="flex min-h-[80vh]">
    {{-- Sidebar partial (same partial used for admin/trainer/student) --}}
    @include('dashboards.partials.sidebar', ['role' => $role, 'activeSection' => $section])

    {{-- Main content area --}}
    <main id="role-content" class="flex-1 p-6">
      {{-- If the section is implemented as a Livewire component, prefer the Livewire tag.
          Otherwise include the server-rendered fragment partial. --}}
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
    </main>
  </div>
@endsection
