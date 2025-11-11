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


 @if(session('success') || session('error'))


<script>
    window.addEventListener('app-toast', function(event) {
        const toastContainer = document.getElementById('toast-container');
        const { title, message, ttl } = event.detail;

        if (toastContainer) {
            toastContainer.innerHTML = `
                <div class="toast bg-indigo-500 text-white rounded-lg shadow-lg px-4 py-3 mb-3">
                    <h4 class="text-lg font-semibold">${title}</h4>
                    <p>${message}</p>
                </div>
            `;

            setTimeout(() => {
                toastContainer.innerHTML = '';
            }, ttl || 5000); // Default TTL is 5 seconds if undefined
        }
    });

    window.addEventListener('trainer-pending-redirect', function() {
        window.location.href = "{{ route('trainer.pending') }}";
    });

    window.addEventListener('student-dashboard-redirect', function() {
        window.location.href = "{{ route('student.dashboard') }}";
    });

    window.addEventListener('trainer-dashboard-redirect', function() {
        window.location.href = "{{ route('trainer.dashboard') }}";
    });

    window.addEventListener('admin-dashboard-redirect', function() {
        window.location.href = "{{ route('admin.dashboard') }}";
    });
</script>
@endif

</body>
</html>
