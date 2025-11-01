{{-- resources/views/auth/trainer_pending.blade.php --}}
@extends('layouts.app')

@section('title', 'Trainer application received')

@section('content')

  <x-toast />
<div class="max-w-3xl mx-auto px-4 py-12">

  <div class="bg-white dark:bg-gray-800 border rounded-lg p-8 shadow-sm">
    <div class="flex items-start gap-4">
      <div class="flex-shrink-0">
        <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center font-bold">!</div>
      </div>

      <div class="flex-1">
        <h1 class="text-2xl font-semibold">Thanks — your trainer application is received</h1>

        <p class="mt-3 text-gray-600 dark:text-gray-300">
          We’ve received your application to become a Trainer on {{ config('app.name') }}.
        </p>

        @if(!empty($email))
          <p class="mt-2 text-sm text-gray-500">Application email: <strong>{{ $email }}</strong></p>
        @endif

        <div class="mt-4 text-gray-600 dark:text-gray-300">
          What happens next:
          <ul class="list-disc ml-5 mt-2">
            <li>An admin will review your application and credentials.</li>
            <li>You'll receive an email when your account is approved or if more info is needed.</li>
            <li>Once approved you'll be able to log in and publish courses.</li>
          </ul>
        </div>

        <div class="mt-6 flex gap-3">
          <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Go to Login</a>
          <a href="{{ route('home') ?? url('/') }}" class="px-4 py-2 border rounded-md">Back to Home</a>
        </div>

        <p class="mt-4 text-sm text-gray-500">
          If you don't receive an approval email within 48 hours, contact support at <a href="mailto:support@{{ request()->getHost() }}" class="underline">support@{{ request()->getHost() }}</a>.
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
