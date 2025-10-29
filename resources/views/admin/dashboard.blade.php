@extends('layouts.app')
@section('title','Admin Dashboard')
@section('content')
  <h1 class="text-2xl mb-4">Admin Dashboard</h1>
  <div class="grid grid-cols-2 gap-4">
    <div class="p-4 bg-white shadow rounded">
      <div class="text-sm text-gray-500">Total blogs</div>
      <div class="text-3xl font-bold">{{ $blogsCount }}</div>
    </div>
    <div class="p-4 bg-white shadow rounded">
      <div class="text-sm text-gray-500">Total admins</div>
      <div class="text-3xl font-bold">{{ $adminsCount }}</div>
    </div>
  </div>
@endsection
