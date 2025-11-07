@extends('layouts.app')

@section('title','Student dashboard')

@section('content')
  <div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-semibold">Student dashboard</h1>
    <p class="mt-3">Welcome, {{ auth()->user()->name ?? 'Student' }}.</p>
  </div>
@endsection
