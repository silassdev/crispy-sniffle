@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Account Pending Approval</div>
                <div class="card-body">
                    <p>Your trainer account <strong>{{ $email }}</strong> is pending approval.</p>
                    <p>Please wait for an administrator to approve your account. You will receive an email notification when your account has been activated.</p>
                    <hr>
                    <p class="text-muted">Contact support if you have any questions.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection