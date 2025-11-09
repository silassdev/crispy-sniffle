@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Trainer Account Pending</div>

                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="alert alert-warning">
                        <h5>Account Status: Pending Approval</h5>
                        <p>Your trainer account is awaiting administrator approval.</p>
                        
                        <hr>
                        
                        <dl class="row">
                            <dt class="col-sm-4">Email:</dt>
                            <dd class="col-sm-8">{{ $email }}</dd>
                            
                            <dt class="col-sm-4">Name:</dt>
                            <dd class="col-sm-8">{{ $name }}</dd>
                            
                            <dt class="col-sm-4">Submitted:</dt>
                            <dd class="col-sm-8">{{ $created_at }}</dd>
                        </dl>
                    </div>

                    <div class="text-center mt-4">
                        <p class="mb-3">We will notify you by email once your account has been approved.</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection