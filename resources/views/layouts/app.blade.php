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

  <div id="toast-container" class="toast-container" style="position:fixed;top:20px;right:20px;z-index:1000;display:block;"></div>

  @include('layouts.navigation')

  <main class="pt-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @yield('content')
  </main>

  @include('layouts.footer')

  @livewireScripts
  @stack('scripts')


 @if(session('success') || session('error'))
<script>
    // Listener for toast events
    window.addEventListener('app-toast', function (event) {
        const toastContainer = document.getElementById('toast-container');
        const { title, message, ttl } = event.detail;

        // Check if container exists
        if (toastContainer) {
            toastContainer.innerHTML = `
                <div class="toast">
                    <h4>${title}</h4>
                    <p>${message}</p>
                </div>
            `;

            // Automatically clear toast after TTL
            setTimeout(() => {
                toastContainer.innerHTML = '';
            }, ttl || 5000);
        }
    });

    // Listener for redirect events
    window.addEventListener('redirect-to', function (event) {
        const { url } = event.detail;
        if (url) {
            // Redirect browser
            window.location.href = url;
        }
    });
</script>
@endif

</body>
</html>
