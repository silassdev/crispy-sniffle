<!doctype html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}"
      x-data="layout()" x-bind:class="{ 'dark': dark }"
      x-init="init()">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', config('app.name','ALLPILAR LMS'))</title>

    {{-- Helpful JS object --}}
    <script>
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}",
            @auth
            user: {
                id: {{ auth()->id() }},
                name: "{{ addslashes(auth()->user()->name) }}",
                role: "{{ auth()->user()->role ?? '' }}",
                approved: {{ auth()->user()->approved ? 'true' : 'false' }}
            }
            @else
            user: null
            @endauth
        };
    </script>

    {{-- Vite - builds app.css (Tailwind) and app.js (Alpine) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Page-specific styles --}}
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 antialiased">

  {{-- NAV --}}
  <header class="border-b border-gray-200 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center gap-3">
          <a href="{{ url('/') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-indigo-600 text-white flex items-center justify-center font-bold">AP</div>
            <div class="text-lg font-semibold hidden sm:block">{{ config('app.name','ALLPILAR LMS') }}</div>
          </a>
        </div>

        <nav class="flex items-center gap-3">
          <button
            x-on:click="toggleDark()"
            class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-white/5"
            :aria-pressed="dark"
            title="Toggle dark mode">
            <template x-if="!dark">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 3v1m0 16v1m8.66-12.34l-.7.7M4.34 5.34l-.7.7M21 12h-1M4 12H3m15.36 6.36l-.7-.7M6.34 6.34l-.7-.7"/>
              </svg>
            </template>
            <template x-if="dark">
              <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M17.293 13.293A8 8 0 116.707 2.707a7 7 0 0010.586 10.586z"/>
              </svg>
            </template>
          </button>

          @guest
            <a href="{{ route('login') }}" class="text-sm px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-white/5">Login</a>
            <a href="{{ route('register', ['role' => 'student']) }}" class="text-sm px-3 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Register</a>
          @else
            <div class="hidden sm:flex items-center gap-3">
              <a href="{{ route('student.dashboard') }}" class="text-sm px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-white/5">Dashboard</a>
            </div>

            <div x-data="{ open: false }" class="relative">
              <button x-on:click="open = !open" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-white/5">
                <span class="text-sm">{{ auth()->user()->name }}</span>
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 8l4 4 4-4"/>
                </svg>
              </button>

              <div x-show="open" x-cloak @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-md shadow-lg overflow-hidden z-50">
                <a href="{{ route('profile.show') ?? '#' }}" class="block px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-white/5">Profile</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-white/5">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                  @csrf
                </form>
              </div>
            </div>
          @endguest
        </nav>
      </div>
    </div>
  </header>

  {{-- MAIN --}}
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @yield('content')
  </main>

  {{-- Footer --}}
  <footer class="border-t border-gray-200 dark:border-gray-800 mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-sm text-gray-500 dark:text-gray-400">
      © {{ date('Y') }} {{ config('app.name','ALLPILAR LMS') }} — Built with Laravel + Tailwind + Alpine
    </div>
  </footer>

  {{-- Per-page scripts --}}
  @stack('scripts')

  {{-- Minimal inline Alpine data (kept at bottom so Alpine is ready) --}}
  <script>
    function layout() {
      return {
        dark: false,
        init() {
          // Initialize dark mode from localStorage
          try {
            const stored = localStorage.getItem('ap_dark');
            this.dark = stored === '1' ? true : false;
          } catch (e) { this.dark = false; }
        },
        toggleDark() {
          this.dark = !this.dark;
          try { localStorage.setItem('ap_dark', this.dark ? '1' : '0'); } catch(e){}
        },
        // convenience toggle for other buttons
        setDark(v) { this.dark = !!v; localStorage.setItem('ap_dark', this.dark ? '1' : '0'); }
      }
    }
  </script>
</body>
</html>
