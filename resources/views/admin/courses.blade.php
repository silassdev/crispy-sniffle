@extends('dashboards.shell', ['section' => 'courses', 'role' => 'admin'])

@section('dashboard-content')
  @include('admin.courses-fragment')
@endsection
