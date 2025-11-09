@extends('layouts.guest')

@section('title', 'Application received')

@section('content')
  <div class="max-w-3xl mx-auto py-16 px-4">
    <div class="bg-white rounded shadow p-6 text-center">
      <h1 class="text-2xl font-semibold mb-3">Application received</h1>

      @if(session('trainer_email'))
        <p class="text-gray-700">Thanks — your application for trainer account was received for <strong>{{ session('trainer_email') }}</strong>.</p>
      @else
        <p class="text-gray-700">Thanks — your trainer application was received. We'll notify you when it's reviewed.</p>
      @endif

      <p class="mt-4 text-sm text-gray-500">An administrator will review your profile and approve if everything looks good. This may take a short while.</p>

      <div class="mt-6 flex justify-center gap-3">
        <a href="{{ route('login') }}" class="px-4 py-2 border rounded">Back to Login</a>
        <a href="{{ route('home') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Go to Home</a>
      </div>
    </div>
  </div>
@endsection
