@extends('dashboards.shell', ['section' => 'feedback', 'role' => 'admin'])

@section('content')
    @include('admin.feedback.index-fragment')
@endsection
