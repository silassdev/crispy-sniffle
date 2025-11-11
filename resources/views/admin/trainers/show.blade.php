@extends('layouts.dashboard')
@section('title','Trainer details')
@section('page-title','Trainer details')
@section('content')
  <div class="bg-white p-6 rounded shadow">
    <a href="{{ route('admin.trainer.edit', $trainer->id) }}" class="px-3 py-2 bg-indigo-600 text-white rounded">Edit</a>
    <div class="mt-4">
      <h2 class="text-lg font-semibold">{{ $trainer->name }}</h2>
      <p class="text-sm text-gray-500">{{ $trainer->email }}</p>
      <p class="mt-4">{{ $trainer->bio }}</p>
      {{-- rest of read-only details; provide print button --}}
      <div class="mt-6">
        <button onclick="window.print()" class="px-3 py-2 border rounded">Print</button>
      </div>
    </div>
  </div>
@endsection
