@extends('layouts.app')

@section('title','Trainer Dashboard')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
  <h1 class="text-2xl font-bold mb-4">Trainer dashboard</h1>
  <p class="text-gray-700">Welcome, {{ auth()->user()->name }}. This is the trainer area.</p>

  {{-- quick stats / placeholders --}}
  <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="p-4 bg-white rounded shadow">Courses: 0</div>
    <div class="p-4 bg-white rounded shadow">Students: 0</div>
    <div class="p-4 bg-white rounded shadow">Pending: 0</div>
  </div>
</div>
@endsection
