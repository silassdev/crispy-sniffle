@extends('layouts.app')

@section('content')
<div class="flex">
  @include('dashboards.partials.sidebar', ['role' => auth()->user()->role ?? 'admin'])

  <main class="flex-1 p-6 relative">

    <div id="ajax-loader" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/30">
      <div class="loader-donut"></div>
    </div>

    <div id="admin-content">
      <livewire:admin.overview wire:init="loadCounters" wire:poll.visible.60s="loadCounters" />
    </div>
  </main>
</div>
@endsection

