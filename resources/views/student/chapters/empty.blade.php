@extends('layouts.app')
@section('content')
  <div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded shadow p-6 text-center">
      <h2 class="text-lg font-semibold">No chapters yet</h2>
      <p class="text-sm text-gray-600 mt-2">This course has no chapters yet. Check back later.</p>
      <a href="{{ route('student.courses') }}" class="mt-4 inline-block text-sm text-indigo-600">Back to courses</a>
    </div>
  </div>
@endsection
