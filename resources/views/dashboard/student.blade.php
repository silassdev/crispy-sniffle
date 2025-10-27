@extends('layouts.app')

@section('content')
<h1>Student Dashboard</h1>
<p>Welcome, {{ auth()->user()->name }} (Student)</p>
@endsection
