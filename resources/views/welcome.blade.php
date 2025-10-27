<!doctype html>
<html lang="en" x-data="{ dark: (localStorage.getItem('dark')==='true') }"
      x-bind:class="{ 'dark': dark }"
      x-init="$watch('dark', value => localStorage.setItem('dark', value))">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>ALLPILAR LMS — Learn, Teach, Connect</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen antialiased">

  <!-- NAV -->
  <nav class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
    <a href="/" class="flex items-center gap-3">
      <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold">
        AP
      </div>
      <div class="font-semibold text-lg">ALLPILAR LMS</div>
    </a>

    <div class="flex items-center gap-3">
      <button
        x-on:click="dark = !dark"
        class="p-2 rounded-md hover:bg-gray-200/50 dark:hover:bg-white/5 transition"
        :aria-pressed="dark"
        title="Toggle dark mode">
        <template x-if="!dark">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 3v1m0 16v1m8.66-12.34l-.7.7M4.34 5.34l-.7.7M21 12h-1M4 12H3m15.36 6.36l-.7-.7M6.34 6.34l-.7-.7"/>
          </svg>
        </template>
        <template x-if="dark">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M17.293 13.293A8 8 0 116.707 2.707a7 7 0 0010.586 10.586z"/>
          </svg>
        </template>
      </button>

      <a href="{{ route('login') }}" class="text-sm px-4 py-2 border rounded-md hover:bg-gray-100 dark:hover:bg-white/5">Login</a>

      <div class="hidden sm:block">
        <a href="{{ route('register', ['role' => 'student']) }}" class="ml-2 text-sm px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Register (Student)</a>
        <a href="{{ route('register', ['role' => 'trainer']) }}" class="ml-2 text-sm px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Register (Trainer)</a>
        <a href="{{ route('login', ['admin' => '1']) }}" class="ml-2 text-sm px-4 py-2 border rounded-md hover:bg-gray-100 dark:hover:bg-white/5">Admin Login</a>
      </div>

      <!-- mobile menu toggle -->
      <div class="sm:hidden ml-2" x-data="{ open: false }">
        <button x-on:click="open = !open" class="p-2 rounded-md hover:bg-gray-200/50 dark:hover:bg-white/5">
          <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
        <div x-show="open" x-cloak class="mt-2 absolute right-4 bg-white dark:bg-gray-800 border rounded-md p-3 w-44 space-y-2 shadow-lg">
          <a href="{{ route('login') }}" class="block text-sm">Login</a>
          <a href="{{ route('register', ['role' => 'student']) }}" class="block text-sm">Register (Student)</a>
          <a href="{{ route('register', ['role' => 'trainer']) }}" class="block text-sm">Register (Trainer)</a>
          <a href="{{ route('login', ['admin' => '1']) }}" class="block text-sm">Admin Login</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header class="max-w-7xl mx-auto px-6 py-12 flex flex-col lg:flex-row items-center gap-12">
    <div class="flex-1">
      <h1 class="text-3xl md:text-4xl font-extrabold leading-tight">
        Build skills. Teach others. Grow together.
      </h1>
      <p class="mt-4 text-base md:text-lg text-gray-600 dark:text-gray-300">
        Free, simple LMS built with Laravel, Tailwind and Alpine — create courses, share notes, manage live sessions and join a community.
      </p>

      <div class="mt-8 flex flex-wrap gap-3">
        <a href="{{ route('register', ['role' => 'student']) }}" class="px-5 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Get started (Student)</a>

        <a href="{{ route('register', ['role' => 'trainer']) }}" class="px-5 py-3 bg-green-600 text-white rounded-md hover:bg-green-700">Apply as Trainer</a>

        <a href="{{ route('login') }}" class="px-5 py-3 border rounded-md hover:bg-gray-100 dark:hover:bg-white/5">Login</a>
      </div>

      <div class="mt-6 flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
        <div class="flex items-center gap-2">
          <span class="inline-block w-2 h-2 bg-indigo-600 rounded-full"></span>
          <span>Free to use</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="inline-block w-2 h-2 bg-green-600 rounded-full"></span>
          <span>Verified trainers</span>
        </div>
      </div>
    </div>

    <div class="flex-1 max-w-xl">
      <div class="bg-gradient-to-br from-white to-indigo-50 dark:from-gray-800 dark:to-gray-800/60 border rounded-2xl p-6 shadow-lg">
        <h3 class="font-semibold">Quick access</h3>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Choose where to go — links below will preselect your role on registration.</p>

        <div class="mt-4 grid grid-cols-1 gap-3">
          <a href="{{ route('register', ['role' => 'student']) }}" class="flex items-center justify-between px-4 py-3 rounded-lg border hover:bg-gray-50 dark:hover:bg-white/5">
            <div>
              <div class="font-medium">Register — Student</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Enroll and start learning</div>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>

          <a href="{{ route('register', ['role' => 'trainer']) }}" class="flex items-center justify-between px-4 py-3 rounded-lg border hover:bg-gray-50 dark:hover:bg-white/5">
            <div>
              <div class="font-medium">Apply — Trainer</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Create courses after admin verification</div>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>

          <a href="{{ route('login') }}" class="flex items-center justify-between px-4 py-3 rounded-lg border hover:bg-gray-50 dark:hover:bg-white/5">
            <div>
              <div class="font-medium">Login</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Return to your dashboard</div>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>

          <a href="{{ route('login', ['admin' => '1']) }}" class="flex items-center justify-between px-4 py-3 rounded-lg border hover:bg-gray-50 dark:hover:bg-white/5">
            <div>
              <div class="font-medium">Admin Login</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Admin dashboard & approvals</div>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>

      <!-- small screenshot / card -->
      <div class="mt-6 text-xs text-gray-500 dark:text-gray-400">
        <span class="font-medium">Tip:</span> Trainers must be approved by Admin before they can publish courses. You will be notified by email.
      </div>
    </div>
  </header>

  <!-- Footer -->
  <footer class="mt-12 border-t border-gray-200 dark:border-gray-800 py-6">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between text-sm text-gray-500">
      <div>© {{ date('Y') }} ALLPILAR LMS</div>
      <div class="space-x-3">
        <a href="#" class="hover:underline">Privacy</a>
        <a href="#" class="hover:underline">Terms</a>
        <a href="#" class="hover:underline">Contact</a>
      </div>
    </div>
  </footer>

</body>
</html>
