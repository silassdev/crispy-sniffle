@extends('dashboards.shell', ['section' => 'feedback', 'role' => 'admin'])

@section('dashboard-content')
    @include('admin.feedback.index-fragment')
@endsection
