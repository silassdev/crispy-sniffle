@extends('layouts.app')

@section('title','Reset password')

@section('content')
  <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Reset your password</h2>

    @if($errors->any())
      <div class="mb-4 text-red-600">{{ $errors->first() }}</div>
    @endif

    <form id ="paassword-request-form"method="POST" action="{{ route('password.email') }}">
      @csrf
      <label class="block text-sm mb-1">Email</label>
      <input name="email" value="{{ old('email') }}" required type="email" placeholder="you@examplle.com" class="w-full border p-2 rounded mb-4" />
      <button class="px-4 py-2 bg-slate-900 text-white rounded">Send reset link</button>
    </form>
  </div>

  
@endsection
