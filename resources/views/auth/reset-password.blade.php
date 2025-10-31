@extends('layouts.app')

@section('title','Reset password')

@section('content')
<div class="max-w-md mx-auto">
  <x-toast />
  <form method="POST" action="{{ route('password.update') }}" x-data="{ loading:false }" @submit.prevent="loading=true; $el.submit();">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
      <label class="block text-sm font-medium">Email</label>
      <input name="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-md border-gray-200"/>
      @error('email') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">New password</label>
      <input name="password" type="password" required class="mt-1 block w-full rounded-md border-gray-200"/>
      @error('password') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium">Confirm password</label>
      <input name="password_confirmation" type="password" required class="mt-1 block w-full rounded-md border-gray-200"/>
    </div>

    <button class="px-4 py-2 bg-indigo-600 text-white rounded-md" :disabled="loading">
      <span x-show="!loading">Reset password</span>
      <span x-show="loading">@include('components.donut-loader') Resetting...</span>
    </button>
  </form>
</div>
@endsection
