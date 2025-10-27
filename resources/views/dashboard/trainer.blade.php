@extends('layouts.app')

@section('content')
<h1>Trainer Dashboard</h1>
<p>Welcome, {{ auth()->user()->name }} (Trainer)</p>
@if(!auth()->user()->approved)
  <div class="alert alert-warning">Your account is pending approval by admin.</div>
@endif
@endsection
