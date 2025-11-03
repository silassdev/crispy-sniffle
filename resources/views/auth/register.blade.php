@extends('layouts.guest')

@section('title','Register')

@section('content')
  <div class="py-10">
    <div class="bg-white rounded-lg shadow p-6">
      <div class="text-center mb-4">
        <h1 class="text-2xl font-semibold">Sign in</h1>
        <p class="text-sm text-gray-500">Enter your credentials to continue</p>
      </div>

      <livewire:forms.register-form :role="request()->query('role','student')" />
    </div>
  </div>
@endsection
