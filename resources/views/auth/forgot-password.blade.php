@extends('layouts.app')

@section('title','Forgot Password')

@section('content')
  <x-toast />
<div class="max-w-md mx-auto">
  <form method="POST" action="{{ route('password.email') }}" x-data="{ loading:false }" @submit.prevent="loading=true; $el.submit();">
    @csrf
    <div class="mb-3">
      <label class="block text-sm font-medium">Email</label>
      <input name="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-md border-gray-200"/>
      @error('email') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md" :disabled="loading">
      <span x-show="!loading">Send reset link</span>
      <span x-show="loading" class="flex items-center gap-2">@include('components.donut-loader') Sending...</span>
    </button>
  </form>
</div>
@endsection
