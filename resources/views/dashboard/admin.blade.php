@extends('layouts.app')

@section('title','Admin dashboard')

@section('content')
  <div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-semibold">Admin dashboard</h1>
    <p class="mt-3">Welcome, {{ auth()->user()->name ?? 'Admin' }}.</p>
  </div>
@endsection
