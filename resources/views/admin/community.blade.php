{{-- resources/views/admin/community.blade.php --}}
@extends('dashboards.shell') {{-- or layouts.admin if you use that --}}

@section('content')
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Community & Posts</h1>

      {{-- Notification bell --}}
      <div>
        <livewire:admin.community-notifications />
      </div>
    </div>

    {{-- Livewire manager --}}
    <livewire:admin.community-manager />
  </div>
@endsection
