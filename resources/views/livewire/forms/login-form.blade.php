@extends('layouts.app')

@section('title', 'Login — ' . config('app.name'))

@section('content')
<main class="pt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
    {{-- Form column --}}
    <div class="max-w-md mx-auto w-full">
      <div class="p-6 bg-white rounded-xl shadow">
        <h2 class="text-2xl font-semibold mb-4">Login</h2>

        <form wire:submit.prevent="submit" autocomplete="off" novalidate>
          @csrf

          <div class="mb-3">
            <label class="block text-sm font-medium">Email</label>
            <input wire:model.defer="email" type="email" class="mt-1 block w-full rounded border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300" required>
            @error('email') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="block text-sm font-medium">Password</label>
            <input wire:model.defer="password" type="password" class="mt-1 block w-full rounded border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300" required>
            @error('password') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
          </div>

          @if($errors->has('credentials'))
            <div class="text-sm text-red-600 mb-3">{{ $errors->first('credentials') }}</div>
          @endif
          @if($errors->has('too_many_attempts'))
            <div class="text-sm text-red-600 mb-3">{{ $errors->first('too_many_attempts') }}</div>
          @endif

          <div class="flex items-center justify-between gap-3">
            <button type="submit" wire:loading.attr="disabled" class="px-4 py-2 bg-indigo-600 text-white rounded-md">
              <span wire:loading.remove>Login</span>
              <span wire:loading>Logging in…</span>
            </button>

            <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:underline">Forgot password?</a>
          </div>

          <div class="mt-4 text-sm text-gray-500">
            Or login with:
            <div class="flex gap-2 mt-2">
              <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="px-3 py-2 border rounded">Google</a>
              <a href="{{ route('social.redirect', ['provider' => 'github']) }}" class="px-3 py-2 border rounded">GitHub</a>
            </div>
          </div>
        </form>
      </div>
    </div>

    {{-- Image column (hidden on small screens) --}}
    <div class="hidden lg:block">
      {{-- Use <picture> for responsive images or a single img with object-cover --}}
      <picture class="block rounded-2xl overflow-hidden shadow-lg">
        <source srcset="{{ asset('img/login-lg.jpg') }}" media="(min-width:1024px)">
        <source srcset="{{ asset('img/login-md.jpg') }}" media="(min-width:640px)">
        <img src="{{ asset('img/login-sm.jpg') }}" alt="Login illustration" class="w-full h-96 object-cover">
      </picture>
    </div>
  </div>
</main>
@endsection
