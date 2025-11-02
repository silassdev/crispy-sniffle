<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name'))</title>

  <!-- Styles -->
  @vite(['resources/css/app.css','resources/js/app.js']) <!-- or your asset pipeline -->
  @livewireStyles

  @stack('head')
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">

  <!-- Global toast (visible on all pages) -->
  <x-toast />

  <!-- Navigation -->
  @include('layouts.navigation') {{-- or <x-navigation/> --}}

  <!-- Page content -->
  <main class="pt-6">
    @yield('content')
  </main>

  <!-- Footer -->
  @include('layouts.footer')

  <!-- Scripts -->
  @livewireScripts
  @stack('scripts')
</body>
</html>
