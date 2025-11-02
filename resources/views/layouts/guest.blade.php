<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title','Welcome') - {{ config('app.name') }}</title>

  @vite(['resources/css/app.css','resources/js/app.js'])
  {{-- optionally include Livewire styles only if needed on guest pages --}}
  @livewireStyles
</head>
<body class="min-h-screen bg-gray-50">

  {{-- Small nav or brand --}}
  @include('layouts.navigation')

  <main class="py-12">
    @yield('content')
  </main>

  @include('layouts.footer')

  @livewireScripts
  @stack('scripts')
</body>
</html>
