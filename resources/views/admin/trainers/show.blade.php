@extends('dashboards.shell') {{-- or layouts.app depending on your structure --}}
@section('content')
<div class="p-6">
  <div class="flex gap-6">
    <div class="w-2/3">
      <h2 class="text-2xl font-semibold">{{ $trainer->name }}</h2>
      <p class="text-sm text-gray-500">{{ $trainer->email }}</p>

      <div class="mt-6">
        <h3 class="font-medium">Profile</h3>
        <p class="text-sm text-gray-600 mt-2">Joined: {{ $trainer->created_at->toDayDateTimeString() }}</p>
        <p class="text-sm text-gray-600">Approved: {{ $trainer->approved ? $trainer->approved_at : 'No' }}</p>
        {{-- add other fields as needed --}}
      </div>
    </div>

    <aside class="w-1/3">
      @if(! $trainer->isApproved())
        <form method="POST" action="{{ route('admin.trainers.approve', $trainer->id) }}">
          @csrf
          <button type="submit" class="w-full px-4 py-2 bg-emerald-600 text-white rounded">Approve</button>
        </form>
      @else
        <div class="p-4 bg-emerald-100 text-emerald-800 rounded">Trainer approved</div>
      @endif

      <form method="POST" action="{{ route('admin.trainers.destroy', $trainer->id) }}" class="mt-3">
        @csrf @method('DELETE')
        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded">Delete</button>
      </form>
    </aside>
  </div>
</div>
@endsection
