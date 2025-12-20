@extends('dashboards.shell', ['section' => 'students', 'role' => 'admin'])

@section('dashboard-content')
    <h1 class="text-2xl mb-4">Students</h1>
    @include('admin.students.index-fragment')
@endsection
