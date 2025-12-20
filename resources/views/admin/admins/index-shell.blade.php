@extends('dashboards.shell', ['section' => 'admins', 'role' => 'admin'])

@section('dashboard-content')
    <h1 class="text-2xl mb-4">Admins</h1>
    @include('admin.admins.index-fragment')
@endsection
