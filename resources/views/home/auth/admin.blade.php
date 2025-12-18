@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-semibold">Admin Home</h1>
    <p class="text-sm text-gray-500">Quick links and metrics — this is not the admin dashboard</p>

    <div class="mt-4">
      <a href="{{ route('admin.dashboard') }}" class="btn">Go to admin dashboard</a>
    </div>
  </div>
@endsection
