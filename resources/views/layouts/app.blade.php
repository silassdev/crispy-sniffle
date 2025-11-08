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
  @stack('scripts')

  {{-- Unified toast handler: session + Livewire + manual dispatch support --}}
  <script>
  (function () {
    // central dispatcher - normalises payload and shows the toast via available library
    function showToast(payload) {
      if (!payload || typeof payload !== 'object') payload = {};

      var level = payload.level || payload.type || 'info';
      var title = payload.title || '';
      var message = payload.message || payload.msg || payload.body || '';
      var ttl = payload.ttl || payload.timeout || 4000;

      // Try toastr if present
      try {
        if (typeof toastr !== 'undefined' && typeof toastr[level] === 'function') {
          toastr[level](message, title, { timeOut: ttl });
          return;
        }
      } catch (e) {
        console.error('toastr error:', e);
      }

      // Try Notyf
      try {
        if (typeof Notyf !== 'undefined') {
          var notyf = new Notyf();
          notyf.open({ type: level, message: message || title });
          return;
        }
      } catch (e) {
        console.error('Notyf error:', e);
      }

      try {
        window.dispatchEvent(new CustomEvent('app-toast-fallback', { detail: payload }));
      } catch (e) {
        console.error('app-toast-fallback dispatch failed', e);
      }

      // Final fallback: console
      console.log('toast', { level: level, title: title, message: message, ttl: ttl });
    }

    // expose helper
    window.appToast = function (payload) {
      try { showToast(payload); } catch (err) { console.error('appToast helper error', err); }
    };

    // Listen for the canonical event name (CustomEvent with detail)
    window.addEventListener('app-toast', function (e) {
      showToast(e && e.detail ? e.detail : {});
    });

    // Accept legacy / alternate event name
    window.addEventListener('appToast', function (e) {
      showToast(e && e.detail ? e.detail : {});
    });

    // Accept Livewire's dispatchBrowserEvent which fires native events by name on window/document
    // If you do: $this->dispatchBrowserEvent('app-toast', $payload) in Livewire, it will be caught above.
    // Add explicit listener for backwards compatibility (some setups deliver event on document)
    document.addEventListener('app-toast', function (e) {
      showToast(e && e.detail ? e.detail : {});
    });

    // Wire up Livewire .on emitter (Livewire.emit('appToast', payload) or Livewire.emit('app-toast', payload))
    if (typeof Livewire !== 'undefined' && Livewire.on) {
      try {
        Livewire.on('appToast', function (payload) {
          // Livewire.emit sends payload directly
          showToast(payload || {});
        });
        Livewire.on('app-toast', function (payload) {
          showToast(payload || {});
        });
      } catch (err) {
        console.error('Livewire toast wiring error', err);
      }
    }

    // If there is a session flash (server-rendered), dispatch it on DOMContentLoaded
    document.addEventListener('DOMContentLoaded', function () {
      @if(session()->has('app_toast'))
        (function () {
          var payload = @json(session('app_toast'));
          try { showToast(payload); } catch (err) { console.error('session toast error', err); }
        })();
      @endif
    });

   
  })();
  </script>

</body>
</html>
