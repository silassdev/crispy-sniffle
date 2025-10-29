{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home — ' . config('app.name'))

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
  {{-- Left / hero --}}
  <div>
    <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">
      Build skills. Teach others. Grow together.
    </h1>

    <p class="mt-4 text-gray-600 dark:text-gray-300">
      Free LMS built with Laravel, Tailwind and Alpine — create courses, add notes, schedule Zoom sessions and join the community.
    </p>

    <div class="mt-6 flex flex-wrap gap-3">
      @php
        // Prepare register URLs: if named route exists, use it with query param, otherwise use path.
        $studentRegisterUrl = Route::has('register') ? route('register', ['role'=>'student']) : url('/register?role=student');
        $trainerRegisterUrl = Route::has('register') ? route('register', ['role'=>'trainer']) : url('/register?role=trainer');
        $loginUrl = Route::has('login') ? route('login') : url('/login');
      @endphp

      <a href="{{ $studentRegisterUrl }}" class="px-5 py-3 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Get started (Student)</a>
      <a href="{{ $trainerRegisterUrl }}" class="px-5 py-3 rounded-md bg-green-600 text-white hover:bg-green-700">Apply as Trainer</a>
      <a href="{{ $loginUrl }}" class="px-5 py-3 rounded-md border hover:bg-gray-50 dark:hover:bg-white/5">Login</a>
    </div>

    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
      Trainers require admin approval. You will be notified once approved.
    </div>
  </div>

  {{-- Right / quick access card --}}
  <div>
    <div class="rounded-2xl p-6 shadow bg-white dark:bg-gray-800 border">
      <h3 class="font-semibold">Quick access</h3>
      <ul class="mt-3 space-y-3">
        <li>
          <a href="{{ $studentRegisterUrl }}" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-white/5">
            <div>
              <div class="font-medium">Register — Student</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Join and enroll in courses</div>
            </div>
            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </li>

        <li>
          <a href="{{ $trainerRegisterUrl }}" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-white/5">
            <div>
              <div class="font-medium">Apply — Trainer</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Create courses after admin approval</div>
            </div>
            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </li>

        <li>
          <a href="{{ $loginUrl }}" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-white/5">
            <div>
              <div class="font-medium">Login</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Go to your dashboard</div>
            </div>
            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
@endsection
