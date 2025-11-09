@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Account Pending Approval</div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <h4>Hello {{ $name }},</h4>
                        <p>Your trainer account is currently pending administrative approval.</p>
                        
                        <hr>
                        
                        <dl>
                            <dt>Email:</dt>
                            <dd>{{ $email }}</dd>
                            
                            <dt>Application Date:</dt>
                            <dd>{{ $created_at }}</dd>
                        </dl>
                        
                        <p class="mb-0">
                            We will notify you by email once your account has been approved.
                            You can try logging in again after receiving the approval email.
                        </p>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            Return to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection