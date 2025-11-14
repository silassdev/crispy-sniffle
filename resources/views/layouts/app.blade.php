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
  console.log('section listener loaded');

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-section]');
    if (!btn) return;

    e.preventDefault();
    const name = btn.dataset.section;
    const fallback = btn.dataset.fallback;

    console.log('section click', name, fallback);

    try {
      // find Livewire root
      const root = document.querySelector('[wire\\:id]');
      if (window.Livewire && root) {
        const id = root.getAttribute('wire:id');
        const comp = window.Livewire.find(id);
        if (comp && typeof comp.call === 'function') {
          comp.call('showSection', name);
          console.log('called Livewire.showSection', name);
          return;
        }
      }
    } catch (err) {
      console.error('Livewire call failed', err);
    }

    if (fallback) {
      console.log('navigating to fallback', fallback);
      window.location.href = fallback;
    }
  });
</script>



  
  @stack('scripts')

 
  </body>
</html>
