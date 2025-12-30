@extends('dashboards.shell', ['section' => 'overview', 'role' => 'admin'])

@section('dashboard-content')
  @include('admin.overview-fragment')
@endsection