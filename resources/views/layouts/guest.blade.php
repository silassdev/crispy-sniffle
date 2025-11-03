<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title','Welcome') - {{ config('app.name') }}</title>

  @vite(['resources/css/app.css','resources/js/app.js'])
  @livewireStyles
  @stack('head')
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">

  @include('layouts.navigation')

  <main id="main" class="pt-20 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4">
      @yield('content')
    </div>
  </main>

  @include('layouts.footer')

  @livewireScripts
  @stack('scripts')
</body>
</html>