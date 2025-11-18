@extends('layouts.app')

@section('content')
  <div class="flex">
    @include('dashboards.partials.sidebar', ['role' => auth()->user()->role ?? 'admin'])
    <main class="flex-1 p-6">
      @include('admin.trainers.partials.index', ['trainers' => $trainers])
    </main>
  </div>
@endsection
