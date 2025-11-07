@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')
<div class="p-6">
  <h1 class="text-2xl font-bold mb-4">Admin dashboard</h1>

  <div class="space-y-4">
    <div>
      <h3 class="font-semibold">Invite new admin</h3>
      {{-- Livewire invite form --}}
      <livewire:admin.invite-form />
    </div>

    <div>
      <h3 class="font-semibold">Site stats</h3>
      <p class="text-sm text-gray-600">(Add charts / links here)</p>
    </div>
  </div>
</div>
@endsection
