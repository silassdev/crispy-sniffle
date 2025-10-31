@extends('layouts.app')

@section('title','Login')

@section('content')
<div class="max-w-md mx-auto">
  <x-toast />

  @include('components.auth-hero', [
    'title' => 'Welcome back',
    'subtitle' => 'Sign in to continue building awesome things'
  ])

  <form method="POST" action="{{ route('login') }}" x-data="{ loading:false }" @submit.prevent="loading=true; $el.submit();">
    @csrf

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

    <div class="flex items-center justify-between mb-4">
      <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" name="remember" class="rounded" />
        Remember me
      </label>
      <a href="{{ route('password.request') }}" class="text-sm text-indigo-600">Forgot password?</a>
    </div>

    <div class="flex items-center gap-3">
      <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md" :disabled="loading">
        <span x-show="!loading">Login</span>
        <span x-show="loading" class="flex items-center gap-2">
          @include('components.donut-loader') <span>Logging in...</span>
        </span>
      </button>
    </div>
  </form>

  {{-- social buttons snippet --}}
  <div class="mt-6 text-center">
    <div class="text-sm text-gray-500 mb-2">Or continue with</div>

    <div class="flex gap-3 justify-center">
      <!-- Google -->
      <a href="{{ route('social.redirect', 'google') }}"
         class="flex items-center gap-2 px-4 py-2 border rounded w-36 justify-center hover:bg-gray-50"
         aria-label="Sign in with Google">
        <span class="flex-shrink-0">@include('components.icons.google')</span>
        <span class="text-sm">Google</span>
      </a>

      <!-- GitHub -->
      <a href="{{ route('social.redirect', 'github') }}"
         class="flex items-center gap-2 px-4 py-2 border rounded w-36 justify-center hover:bg-gray-50"
         aria-label="Sign in with GitHub">
        <span class="flex-shrink-0">@include('components.icons.github')</span>
        <span class="text-sm">GitHub</span>
      </a>
    </div>
  </div>
  {{-- end social buttons --}}

</div>
@endsection
