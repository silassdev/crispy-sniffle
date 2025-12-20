{{-- resources/views/admin/jobs/index.blade.php --}}
@extends('dashboards.shell')

@section('content')
  <div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-3">
      <img src="/assets/logo.svg" alt="App" class="w-8 h-8"/>
      <h1 class="text-xl font-semibold">Jobs</h1>
    </div>

    {{-- Notifications bell (Livewire) --}}
    <div>
      <livewire:notifications.notification-bell />
    </div>
  </div>

  {{-- mount your JobManager livewire component --}}
  <livewire:admin.job-manager />
@endsection

@push('scripts')
  {{-- Toasts & Echo helper JS (paste later in global layout to be available app-wide) --}}
  <script src="{{ asset('js/notifications.js') }}"></script>
@endpush
