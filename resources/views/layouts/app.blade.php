<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>[x-cloak] {display:none!important} </style>
  <title>@yield('title', config('app.name'))</title>
  <script>
  window.routes = {
  adminLogin: "{{ route('admin.login') }}", adminRegister: "{{ route('admin.register') }}"};
  window.csrf = document.querySelector('meta[name="csrf-token"]').content;
</script>

  @vite(['resources/css/app.css','resources/js/app.js']) 
</head>
<body class="bg-gray-50 text-gray-800">
   <x-toast />
  <nav class="p-4 bg-white shadow">
<nav x-data="{ open: false }" class="bg-white shadow">
  <div class="container mx-auto px-4">
    <div class="flex items-center justify-between h-16">

      <!-- Brand -->
      <div class="flex items-center space-x-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
          <div class="w-10 h-10 bg-slate-800 text-white rounded flex items-center justify-center font-bold">iC</div>
          <span class="font-semibold text-lg">ignis<span class="text-3xl align-middle">&#60;</span>ode</span>
        </a>
      </div> 

      <!-- Desktop menu -->
      <div class="hidden md:flex items-center space-x-6">
        <div x-data="{ openDrop: false }" class="relative">
          <button @mouseenter="openDrop = true" @mouseleave="openDrop = false" @click="openDrop = !openDrop"
                  class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded focus:outline-none focus:ring">
            <span class="w-9 h-9 bg-gray-100 rounded flex items-center justify-center">
              <!-- product SVG icon -->
              <svg class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 7l9-4 9 4-9 4-9-4zM3 7v6a9 9 0 009 9 9 9 0 009-9V7"/>
              </svg>
            </span>
            <span class="text-sm font-medium">Product</span>
          </button>

          <!-- dropdown -->
          <div x-show="openDrop" x-transition
               @mouseenter="openDrop = true" @mouseleave="openDrop = false"
               class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded border z-30"
               style="display: none;">
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Overview</a>
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Features</a>
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Roadmap</a>
          </div>
        </div>

        <!-- Nav item: Solutions -->
        <div x-data="{ openDrop: false }" class="relative">
          <button @mouseenter="openDrop = true" @mouseleave="openDrop = false" @click="openDrop = !openDrop"
                  class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded focus:outline-none focus:ring">
            <span class="w-9 h-9 bg-gray-100 rounded flex items-center justify-center">
              <svg class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M20 21V7a2 2 0 00-2-2H7L4 7v14a2 2 0 002 2h12a2 2 0 002-2zM8 7V5a3 3 0 016 0v2"/>
              </svg>
            </span>
            <span class="text-sm font-medium">Solutions</span>
          </button>

          <div x-show="openDrop" x-transition
               @mouseenter="openDrop = true" @mouseleave="openDrop = false"
               class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded border z-30"
               style="display: none;">
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Custom APIs</a>
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Integrations</a>
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Support</a>
          </div>
        </div>

        <!-- Nav item: Services (the "1 other") -->
        <div x-data="{ openDrop: false }" class="relative">
          <button @mouseenter="openDrop = true" @mouseleave="openDrop = false" @click="openDrop = !openDrop"
                  class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded focus:outline-none focus:ring">
            <span class="w-9 h-9 bg-gray-100 rounded flex items-center justify-center">
              <svg class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8c-1.657 0-3 1.343-3 3v1H6v6h12v-6h-3v-1c0-1.657-1.343-3-3-3zM6 6h12"/>
              </svg>
            </span>
            <span class="text-sm font-medium">Services</span>
          </button>

          <div x-show="openDrop" x-transition
               @mouseenter="openDrop = true" @mouseleave="openDrop = false"
               class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded border z-30"
               style="display: none;">
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Consulting</a>
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Design</a>
          </div>
        </div>

        <a href="{{ route('contact.show') }}" class="px-3 py-2 hover:bg-gray-50 rounded text-sm">Contact</a>
      </div>

      <div class="md:hidden flex items-center">
        <button @click="open = !open" aria-expanded="false" :aria-expanded="open.toString()"
                class="p-2 rounded focus:outline-none focus:ring">
          <span x-show="!open" class="flex items-center gap-2">
            <span class="inline-block hover:bg-gray-200 text-5xl font-thin text-gray-800">=</span>
          </span>
          <span x-show="open" class="flex items-center gap-2" style="display: none;">
            <span class="inline-block hover:bg-gray-200 text-2xl font-light text-gray-800">✕</span>
          </span>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile drawer -->
  <div x-show="open" x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 transform -translate-y-2"
       x-transition:enter-end="opacity-100 transform translate-y-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 transform translate-y-0"
       x-transition:leave-end="opacity-0 transform -translate-y-2"
       class="md:hidden">
    <div class="px-4 pt-4 pb-6 border-t bg-white">
      <nav class="space-y-2">
        <div>
          <a href="#" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-50">
            <span class="w-9 h-9 bg-gray-100 rounded flex items-center justify-center">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4zM3 7v6a9 9 0 009 9 9 9 0 009-9V7"/></svg>
            </span>
            <span class="font-medium">Product</span>
          </a>
          <div class="pl-12 mt-1 space-y-1 text-sm">
            <a href="#" class="block px-2 py-1 rounded hover:bg-gray-50">Overview</a>
            <a href="#" class="block px-2 py-1 rounded hover:bg-gray-50">Features</a>
          </div>
        </div>

        <div>
          <a href="#" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-50">
            <span class="w-9 h-9 bg-gray-100 rounded flex items-center justify-center">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 21V7a2 2 0 00-2-2H7L4 7v14a2 2 0 002 2h12a2 2 0 002-2zM8 7V5a3 3 0 016 0v2"/></svg>
            </span>
            <span class="font-medium">Solutions</span>
          </a>
          <div class="pl-12 mt-1 space-y-1 text-sm">
            <a href="#" class="block px-2 py-1 rounded hover:bg-gray-50">Custom APIs</a>
            <a href="#" class="block px-2 py-1 rounded hover:bg-gray-50">Integrations</a>
          </div>
        </div>

        <div>
          <a href="#" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-50">
            <span class="w-9 h-9 bg-gray-100 rounded flex items-center justify-center">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3v1H6v6h12v-6h-3v-1c0-1.657-1.343-3-3-3zM6 6h12"/></svg>
            </span>
            <span class="font-medium">Services</span>
          </a>
          <div class="pl-12 mt-1 space-y-1 text-sm">
            <a href="#" class="block px-2 py-1 rounded hover:bg-gray-50">Consulting</a>
            <a href="#" class="block px-2 py-1 rounded hover:bg-gray-50">Design</a>
          </div>
        </div>

        <a href="{{ route('contact.show') }}" class="block px-3 py-2 rounded hover:bg-gray-50">Contact</a>
      </nav>
    </div>
  </div>
 </nav>

  <main class="container mx-auto p-6">
    @yield('content')
  </main>

 @include('layouts.footer')


 </body>
</html>
