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


  <main class="pt-5 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    @yield('content')
  </main>

  @include('layouts.footer')

    @livewireScripts

        <script>
  (function () {
    // a single delegated click handler for the modal controls
    function delegatedClickHandler(e) {
      const closeBtn = e.target.closest && e.target.closest('#login-modal-close');
      if (closeBtn) {
        const root = document.getElementById('login-modal-root');
        if (root) root.remove();
        return;
      }

      const toggle = e.target.closest && e.target.closest('#toggle-password');
      if (toggle) {
        const pwd = document.getElementById('password');
        if (pwd) {
          pwd.setAttribute('type', pwd.type === 'password' ? 'text' : 'password');
          toggle.setAttribute('aria-pressed', String(pwd.type === 'text'));
        }
      }
    }

    // attach once and ensure we re-attach if Livewire re-renders
    function attachHandlers() {
      if (!window.__login_modal_handlers_attached) {
        document.addEventListener('click', delegatedClickHandler);
        window.__login_modal_handlers_attached = true;
      }
    }

    attachHandlers();

    // Re-attach (no-op if already attached) after Livewire messages are processed.
    // Works with Livewire v2+ (hook) and a fallback for older versions that might expose an event.
    if (window.Livewire && typeof Livewire.hook === 'function') {
      Livewire.hook('message.processed', () => attachHandlers());
    } else if (window.Livewire && typeof Livewire.on === 'function') {
      // some older installs emit this event name - it's harmless even if not used
      Livewire.on('message.processed', () => attachHandlers());
    } else {
      // last resort: re-run attach after short delays (covers edge cases)
      setTimeout(() => attachHandlers(), 300);
      setTimeout(() => attachHandlers(), 1000);
    }

    // Optional: also support the focus-password emitted event (modern Livewire)
    (function attachFocusListener() {
      if (window.Livewire && typeof Livewire.on === 'function') {
        Livewire.on('focus-password', () => {
          const pwd = document.getElementById('password');
          pwd?.focus();
        });
      } else {
        // If Livewire can't emit, your fallback inline script already handles focusing
      }
    })();
  })();
  </script>


  @stack('scripts')


  
  @stack('scripts')

 
  </body>
</html>
