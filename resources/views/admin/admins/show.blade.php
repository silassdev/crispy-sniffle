@extends('layouts.app')

@section('content')
  <div class="p-6">
    <h1 class="text-xl font-semibold">Admin: {{ $admin->name ?? '—' }}</h1>
    <p>Email: {{ $admin->email ?? '—' }}</p>
    <p>Role: {{ $admin->role ?? '—' }}</p>
    <a href="{{ route('admin.admins') }}" class="text-sm text-blue-600">Back to admins</a>
  </div>
@endsection
