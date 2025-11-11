<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', config('app.name'))</title>
  @vite(['resources/css/app.css','resources/js/app.js']) {{-- or your asset pipeline --}}
  @livewireStyles
</head>
<body class="bg-gray-50">
  <div id="app" class="min-h-screen flex">
    {{-- Sidebar area (left) --}}
    <aside x-data="{ open: true }" :class="open ? 'w-72' : 'w-16'" class="transition-all duration-200 border-r bg-white">
      <div class="h-screen flex flex-col">
        <div class="flex items-center justify-between p-4">
          <a href="{{ auth()->check() ? (auth()->user()->isAdmin() ? route('admin.dashboard') : (auth()->user()->isTrainer() ? route('trainer.dashboard') : route('student.dashboard'))) : route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('img/logo.png') }}" class="w-8 h-8" alt="logo">
            <span x-show="open" class="font-bold" style="display:inline-block">{{ config('app.name') }}</span>
          </a>
          <button @click="open = !open" class="p-1 rounded hover:bg-gray-100">
            <svg x-show="open" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M6 6l8 4-8 4V6z" /></svg>
            <svg x-show="!open" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" x-cloak><path d="M4 6h12M4 10h12M4 14h12" /></svg>
          </button>
        </div>

        <div class="flex-1 overflow-auto">
          {{-- include role-specific sidebar items --}}
          @if(auth()->check() && auth()->user()->isAdmin())
            @include('dashboards.partials.sidebar', ['role' => 'admin', 'open' => true])
          @elseif(auth()->check() && auth()->user()->isTrainer())
            @include('dashboards.partials.sidebar', ['role' => 'trainer', 'open' => true])
          @else
            @include('dashboards.partials.sidebar', ['role' => 'student', 'open' => true])
          @endif
        </div>

        <div class="p-4 border-t bg-white">
          <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500">@auth {{ auth()->user()->name }} @endauth</div>
            <div>
              <livewire:actions.logout />
            </div>
          </div>
        </div>
      </div>
    </aside>

    {{-- Main content --}}
    <main class="flex-1 p-6">
      <div class="max-w-7xl mx-auto">
        <header class="mb-6">
          <h1 class="text-2xl font-semibold">@yield('page-title')</h1>
          @hasSection('page-subtitle') <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle')</p> @endif
        </header>

        <div>
          @yield('content')
        </div>
      </div>
    </main>
  </div>

  @livewireScripts
  <script>
    // keep small helper for toggling sections or livewire events if needed
    window.addEventListener('app-toast', e => {
      const d = e.detail ?? e;
      // implement your toast show logic or use a global toast component
      console.info('TOAST', d);
    });
  </script>
</body>
</html>
