@extends('dashboards.shell', ['section' => 'feedback', 'role' => 'admin'])

@section('dashboard-content')
    @include('admin.certificate.index-fragment')
@endsection
