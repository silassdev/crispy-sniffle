@extends('layouts.app')

@section('title','Register')

@section('content')

<x-toast />

<div class="max-w-md mx-auto">
 

  @include('components.auth-hero', [
    'title' => 'Join the crew',
    'subtitle' => "Create an account — it's quick, fun, and free"
  ])

   {{-- Determine role: from controller variable $role or query param or fallback to student --}}
  @php
    $role = $role ?? request()->query('role', 'student');
    if (! in_array($role, ['student','trainer'])) {
        $role = 'student';
    }
    @endphp

  <form method="POST" action="{{ route('register') }}" x-data="{ loading:false }" @submit.prevent="loading=true; $el.submit();">
    @csrf

    {{-- Role hidden (prefill from controller) --}}
    <input type="hidden" name="role" value="{{ $role ?? 'student' }}">

    <div class="mb-3">
      <label class="block text-sm font-medium">Name</label>
      <input name="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-200"/>
      @error('name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">Email</label>
      <input name="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-md border-gray-200"/>
      @error('email') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">Password</label>
      <input name="password" type="password" required class="mt-1 block w-full rounded-md border-gray-200"/>
      @error('password') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium">Confirm Password</label>
      <input name="password_confirmation" type="password" required class="mt-1 block w-full rounded-md border-gray-200"/>
    </div>

    <!-- changed: justify-between so button is left and link is right -->
    <div class="flex items-center justify-between">
      <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md flex items-center" :disabled="loading">
        <span x-show="!loading">Register</span>
        <span x-show="loading" class="flex items-center gap-2">
          @include('components.donut-loader') <span>Submitting...</span>
        </span>
      </button>

      <a href="{{ route('login') }}" class="text-sm text-gray-600">Already registered?</a>
    </div>
  </form>

  {{-- social buttons snippet - centered --}}
  <div class="mt-6 text-center">
    <div class="text-sm text-gray-500 mb-2">Or continue with</div>

    <div class="flex gap-3 justify-center">
      <!-- Google (inline SVG) -->
      <a href="{{ route('social.redirect', 'google') }}" aria-label="Sign up with Google"
         class="flex items-center gap-2 px-4 py-2 border rounded w-36 justify-center hover:bg-gray-50">
        <span class="flex-shrink-0" aria-hidden="true">
          <svg class="w-5 h-5" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" role="img">
            <path fill="#EA4335" d="M24 9.5c1.9 0 3.6.65 4.9 1.9l3.7-3.7C31.1 5 27.8 3.5 24 3.5 14.9 3.5 6.9 9.6 3.2 17.7l4.3 3.3C9.7 15 16.2 9.5 24 9.5z"/>
            <path fill="#34A853" d="M46.5 24c0-1.6-.14-3.1-.4-4.6H24v8.7h12.7c-.55 2.9-2.25 5.4-4.8 7.1l4.3 3.4C43.7 36.7 46.5 30.7 46.5 24z"/>
            <path fill="#4A90E2" d="M9.5 28.7a13.3 13.3 0 01-.8-4.7c0-1.6.3-3.1.8-4.5l-4.3-3.3C2.1 16.8 0 20.2 0 24c0 3.8 2.1 7.2 4.9 9.6l4.6-4.9z"/>
            <path fill="#FBBC05" d="M24 44.5c3.8 0 7-1.25 9.4-3.41l-4.6-3.7C27.7 37.9 25.9 38.5 24 38.5c-7.8 0-14.3-5.5-16.5-12.8l-4.3 3.3C6.9 42.4 14.9 44.5 24 44.5z"/>
          </svg>
        </span>
        <span class="text-sm">Google</span>
      </a>

      <!-- GitHub (inline SVG, monochrome via currentColor) -->
      <a href="{{ route('social.redirect', 'github') }}" aria-label="Sign up with GitHub"
         class="flex items-center gap-2 px-4 py-2 border rounded w-36 justify-center hover:bg-gray-50">
        <span class="flex-shrink-0" aria-hidden="true">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" role="img" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 .5C5.65.5.5 5.65.5 12c0 5.1 3.3 9.4 7.9 10.9.6.1.8-.3.8-.6v-2c-3.2.7-3.9-1.5-3.9-1.5-.5-1.2-1.2-1.5-1.2-1.5-1-.7.1-.7.1-.7 1.1.1 1.7 1.1 1.7 1.1 1 .1.7 1.7 2.7 2.3.2-.7.4-1.2.7-1.5-2.6-.3-5.3-1.3-5.3-5.9 0-1.3.5-2.4 1.2-3.2-.1-.3-.5-1.6.1-3.3 0 0 1-.3 3.3 1.2a11.4 11.4 0 016 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.7.2 3 .1 3.3.8.8 1.2 1.9 1.2 3.2 0 4.6-2.7 5.6-5.3 5.9.4.3.8 1 .8 2v3c0 .3.2.7.8.6A11.5 11.5 0 0023.5 12C23.5 5.65 18.35.5 12 .5z"/>
          </svg>
        </span>
        <span class="text-sm">GitHub</span>
      </a>
    </div>
  </div>
  {{-- end social buttons --}}

</div>
@endsection
