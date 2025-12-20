@extends('dashboards.shell', ['section' => 'trainers', 'role' => 'admin'])

@section('dashboard-content')
    <h1 class="text-2xl mb-4">Trainers</h1>
    @include('admin.trainers.index-fragment')
@endsection
