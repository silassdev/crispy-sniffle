@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your trainer application is pending approval</h1>
        @if($email)
            <p>Account: <strong>{{ $email }}</strong></p>
        @endif
        <p>An administrator will review your application soon.</p>
    </div>
@endsection