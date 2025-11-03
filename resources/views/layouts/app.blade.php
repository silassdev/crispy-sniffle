<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name'))</title>

  @vite(['resources/css/app.css','resources/js/app.js'])
  @livewireStyles
  @stack('head')
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">
  {{-- Global toast --}}
  <x-toast />

  {{-- Fixed navigation (already includes sticky/blur) --}}
  @include('layouts.navigation')

  {{-- Page content wrapper with responsive gutters and max width --}}
  <main class="pt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @yield('content')
  </main>

  
      @include('layouts.footer')
  

  @livewireScripts
  @stack('scripts')
</body>
</html>
