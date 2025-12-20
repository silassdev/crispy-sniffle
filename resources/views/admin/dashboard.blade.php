@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
  {{-- Sidebar - sticky with max height --}}
  <aside class="w-64 flex-shrink-0 sticky top-0 h-screen overflow-y-auto bg-white border-r border-gray-200">
    @include('dashboards.partials.sidebar', ['role' => auth()->user()->role ?? 'admin'])
  </aside>

  {{-- Main content area - scrollable --}}
  <main class="flex-1 overflow-y-auto relative">
    <div id="ajax-loader" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/30">
      <div class="loader-donut"></div>
    </div>

    <div id="admin-content" class="p-6">
      <livewire:admin.overview wire:init="loadCounters" wire:poll.visible.60s="loadCounters" />
    </div>
  </main>
</div>
@endsection

