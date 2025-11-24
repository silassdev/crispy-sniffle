@extends('dashboards.shell')

@section('content')
  <div class="p-6">
    <h1 class="text-2xl mb-4">Trainers</h1>
    @include('admin.trainers.index-fragment')
  </div>
@endsection
