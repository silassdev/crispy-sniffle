@extends('dashboards.shell', ['section' => 'newsletter', 'role' => 'admin'])

@section('content')
  @include('admin.newsletter.index-fragment')
@endsection

