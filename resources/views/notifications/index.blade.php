@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
  <div class="fixed inset-0 bg-gray-50 flex flex-col">
    {{-- header --}}
    <header class="bg-white border-b px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <a href="{{ url()->previous() }}" class="text-gray-500 hover:text-gray-700">← Back</a>
        <h1 class="text-xl font-semibold">Notifications</h1>
        <div class="text-sm text-gray-500 ml-3">Manage all your notifications here</div>
      </div>

      <div class="flex items-center gap-3">
        <a href="{{ route('admin.dashboard') }}" class="text-sm text-indigo-600">Dashboard</a>
      </div>
    </header>

    {{-- body --}}
    <main class="flex-1 overflow-auto p-6">
      <livewire:notifications.notifications-page />
    </main>
  </div>
@endsection
