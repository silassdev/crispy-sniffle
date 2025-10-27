@extends('layouts.app')

@section('content')
<h1>Admin Dashboard</h1>
<p>Welcome, {{ auth()->user()->name }} (Admin)</p>
<a href="{{ route('admin.trainers.pending') }}">Pending trainers</a>
@endsection
