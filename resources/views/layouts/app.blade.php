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

@if(session()->has('app_toast'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const payload = @json(session('app_toast'));

            // Dispatch a native browser event named 'appToast'
            window.dispatchEvent(new CustomEvent('appToast', { detail: payload }));

            // Optional: If you want to immediately handle it here (fallback),
            // attempt to use a common toast library if present (toastr example),
            // otherwise just console.log.
            try {
                // If toastr is loaded
                if (typeof toastr !== 'undefined') {
                    const ttl = payload.ttl || 4000;
                    const title = payload.title || '';
                    const msg = payload.message || '';
                    const level = payload.level || 'info';
                    // toastr[level] exists for 'success','info','warning','error'
                    if (typeof toastr[level] === 'function') {
                        toastr[level](msg, title, { timeOut: ttl });
                    } else {
                        toastr.info(msg, title, { timeOut: ttl });
                    }
                } else if (typeof Notyf !== 'undefined') {
                    // Notyf example
                    const notyf = new Notyf();
                    notyf.open({type: payload.level || 'info', message: payload.message});
                } else {
                    // Fallback: let app code (or dev console) handle it
                    console.log('appToast payload:', payload);
                }
            } catch (err) {
                console.error('Error showing toast fallback:', err);
            }
        });
    </script>
@endif


</body>
</html>
