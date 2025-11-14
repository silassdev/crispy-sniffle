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

  <x-toast />

  
  @include('layouts.navigation')


  <main class="pt-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    @yield('content')
  </main>

  @include('layouts.footer')

  @livewireScripts

<script>
  // global helper used in some places in your markup: onclick="emitLivewire('showSection', 'trainers')"
  function emitLivewire(event, payload = null) {
    if (window.livewire) {
      // if payload is not null, emit with payload; otherwise emit bare event
      if (payload !== null) {
        window.livewire.emit(event, payload);
      } else {
        window.livewire.emit(event);
      }
      return true;
    }

    console.warn('Livewire not found — cannot emit event:', event);
    return false;
  }

  // Optional: forward keyboard nav to Livewire for accessibility
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-section]');
    if (!btn) return;
    // keep UI snappy on non-Livewire-aware elements
    // emit a document-level event if desired (unused by Livewire)
    document.dispatchEvent(new CustomEvent('section:clicked', { detail: btn.dataset.section }));
  });
</script>


  
  @stack('scripts')

 
  </body>
</html>
