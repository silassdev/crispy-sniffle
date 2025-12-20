@extends('dashboards.shell', ['section' => 'newsletter', 'role' => 'admin'])

@section('dashboard-content')
  @include('admin.newsletter.index-fragment')
@endsection

