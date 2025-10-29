{{-- resources/views/layouts/footer.blade.php --}}
<footer class="bg-slate-900 text-slate-200 mt-16">
  <div class="container mx-auto px-6 py-12">
    <div class="grid md:grid-cols-3 gap-8">

      <!-- Useful Links -->
      <div>
        <h3 class="text-white text-lg font-semibold mb-4">Useful Links</h3>
        <ul class="space-y-2 text-sm">
          <li>
            <a href="{{ route('home') }}"
               @class([
                 'inline-block px-1 py-1 rounded',
                 'text-white' => request()->routeIs('home'),
                 'text-slate-300 hover:text-white' => ! request()->routeIs('home')
               ])>
              Home
            </a>
          </li>

          <li>
            <a href="{{ route('blogs.index') }}"
               @class([
                 'inline-block px-1 py-1 rounded',
                 'text-white' => request()->routeIs('blogs.*'),
                 'text-slate-300 hover:text-white' => ! request()->routeIs('blogs.*')
               ])>
              Blog
            </a>
          </li>

          <li>
            <a href="{{ route('contact.show') }}"
               @class([
                 'inline-block px-1 py-1 rounded',
                 'text-white' => request()->routeIs('contact.*'),
                 'text-slate-300 hover:text-white' => ! request()->routeIs('contact.*')
               ])>
              Contact
            </a>
          </li>

          <li>
            <a href="#pricing" class="text-slate-300 hover:text-white inline-block px-1 py-1">Pricing</a>
          </li>

          <li>
            <a href="#docs" class="text-slate-300 hover:text-white inline-block px-1 py-1">Docs</a>
          </li>
        </ul>

        <!-- Admin icon  -->
        <div class="mt-6">
          <button type="button"
            onclick="window.dispatchEvent(new CustomEvent('open-admin'));"
            class="inline-flex items-center gap-2 px-3 py-2 bg-slate-800 hover:bg-slate-700 rounded focus:outline-none focus:ring focus:ring-offset-2 focus:ring-slate-600"
            aria-haspopup="dialog"
          >
            <svg class="w-5 h-5 text-slate-200" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 20a8 8 0 0116 0" /> </svg>

            <span class="text-sm">Admin</span>
          </button>
        </div>
      </div>

      <!-- Socials -->
      <div>
  <h3 class="text-white text-lg font-semibold mb-4">Follow</h3>
  <p class="text-sm text-slate-300 mb-4">Connect on social media</p>

  <div class="flex items-center gap-3">
    <!-- GitHub -->
    <a href="https://github.com/yourusername" target="_blank" rel="noopener noreferrer"
       class="p-2 rounded bg-slate-800 hover:bg-slate-700 transform transition-transform duration-200 ease-out motion-safe:hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600"
       aria-label="GitHub">
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M12 .5C5.65.5.5 5.65.5 12c0 5.1 3.3 9.4 7.9 10.9.6.1.8-.3.8-.6v-2c-3.2.7-3.9-1.5-3.9-1.5-.5-1.2-1.2-1.5-1.2-1.5-1-.7.1-.7.1-.7 1.1.1 1.7 1.1 1.7 1.1 1 .1.7 1.7 2.7 2.3.2-.7.4-1.2.7-1.5-2.6-.3-5.3-1.3-5.3-5.9 0-1.3.5-2.4 1.2-3.2-.1-.3-.5-1.6.1-3.3 0 0 1-.3 3.3 1.2a11.4 11.4 0 0 1 6 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.7.2 3 .1 3.3.8.8 1.2 1.9 1.2 3.2 0 4.6-2.7 5.6-5.3 5.9.4.3.8 1 .8 2v3c0 .3.2.7.8.6A11.5 11.5 0 0 0 23.5 12C23.5 5.65 18.35.5 12 .5Z"/>
      </svg>
    </a>

    <!-- LinkedIn -->
    <a href="https://www.linkedin.com/in/yourusername" target="_blank" rel="noopener noreferrer"
       class="p-2 rounded bg-slate-800 hover:bg-slate-700 transform transition-transform duration-200 ease-out motion-safe:hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600"
       aria-label="LinkedIn">
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
        <path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8h4V24h-4V8zm7.5 0h3.8v2.2h.1c.5-1 1.8-2.2 3.8-2.2 4 0 4.8 2.6 4.8 6V24h-4v-7.8c0-1.9 0-4.2-2.6-4.2s-3 2-3 4V24h-4V8z"/>
      </svg>
    </a>

    <!-- X (Twitter) -->
    <a href="https://x.com/yourusername" target="_blank" rel="noopener noreferrer"
       class="p-2 rounded bg-slate-800 hover:bg-slate-700 transform transition-transform duration-200 ease-out motion-safe:hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600"
       aria-label="X">
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
        <path d="M18.9 1.5h3.6l-7.9 9.1 9.3 12.4h-7.3l-5.7-7.5-6.5 7.5H1.8l8.4-9.7L1.2 1.5h7.5l5.2 6.9 5-6.9z"/>
      </svg>
    </a>

    <!-- Facebook -->
    <a href="https://facebook.com/yourusername" target="_blank" rel="noopener noreferrer"
       class="p-2 rounded bg-slate-800 hover:bg-slate-700 transform transition-transform duration-200 ease-out motion-safe:hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600"
       aria-label="Facebook">
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
        <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.3l-.4 3h-1.9v7A10 10 0 0 0 22 12"/>
      </svg>
    </a>

    <!-- YouTube -->
    <a href="https://youtube.com/yourusername" target="_blank" rel="noopener noreferrer"
       class="p-2 rounded bg-slate-800 hover:bg-slate-700 transform transition-transform duration-200 ease-out motion-safe:hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600"
       aria-label="YouTube">
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
        <path d="M23.5 6.2s-.2-1.6-.8-2.3c-.8-.9-1.7-.9-2.1-1C17.9 2.5 12 2.5 12 2.5h0s-5.9 0-8.6.4c-.4.1-1.3.1-2.1 1-.6.7-.8 2.3-.8 2.3S0 8.1 0 10v1.9c0 1.9.2 3.8.2 3.8s.2 1.6.8 2.3c.8.9 1.9.9 2.4 1 1.7.2 7.2.4 8.6.4s6.9 0 8.6-.4c.5-.1 1.6-.1 2.4-1 .6-.7.8-2.3.8-2.3s.2-1.9.2-3.8V10c0-1.9-.2-3.8-.2-3.8zM9.5 14.5v-5l5.2 2.5-5.2 2.5z"/>
      </svg>
    </a>
  </div>
</div>


      <!-- Short about / copyright -->
      <div class="md:text-right">
        <h3 class="text-white text-lg font-semibold mb-4">About</h3>
        <p class="text-sm text-slate-300 mb-4">Building clean, fast Laravel apps & custom APIs — available for hire.</p>
        <div class="text-xs text-slate-500">© {{ date('Y') }} All Pilar</div>
      </div>
    </div>
  </div>

  <!-- Admin Modal (login/signup, doughnut loader, toast) -->
<div x-data="adminAuth()" x-init="init()" x-cloak>
  <div x-show="open" class="fixed inset-0 bg-black/50 z-40" @click="open=false"></div>

  <!-- modal -->
  <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg overflow-hidden">
      <div class="px-6 py-4">
        <div class="flex items-center justify-between">
          <h4 class="text-lg text-gray-700 font-semibold" x-text="mode === 'login' ? 'Admin Login' : 'Create Account'"></h4>
          <button @click="open=false" class="text-slate-400">✕</button>
        </div>

        <!-- toggle -->
        <div class="mt-3 flex gap-2">
          <button :class="mode==='login' ? 'bg-slate-900 text-white' : 'bg-gray-100'" @click="mode='login'" class="px-3 py-1 rounded">Login</button>
          <button :class="mode==='signup' ? 'bg-slate-900 text-white' : 'bg-gray-100'" @click="mode='signup'" class="px-3 py-1 rounded">Sign Up</button>
        </div>

        <form @submit.prevent="submit" class="mt-4 space-y-4">
  <!-- Signup fields -->
  <template x-if="mode==='signup'">
    <div class="space-y-4">
      <!-- Full name -->
      <div class="relative w-full">
        <input
          x-model="form.fullname"
          name="fullname"
          placeholder=" "
          required
          class="peer w-full border-2 border-gray-300 rounded-md px-3 pt-5 pb-2 text-base
           text-gray-900 placeholder-gray-400
           focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
  />
  <label
    class="absolute left-3 top-5 text-gray-500 text-base transition-all duration-200
           peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400
           peer-placeholder-shown:text-base
           peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-600
           peer-[&:not(:placeholder-shown)]:top-2 peer-[&:not(:placeholder-shown)]:text-xs peer-[&:not(:placeholder-shown)]:text-blue-600" >Full name</label>
      </div>

      <!-- Username -->
      <div class="relative w-full">
        <input
          x-model="form.username"
          name="username"
          placeholder=" "
          required
          class="peer w-full border-2 border-gray-300 rounded-md px-3 pt-5 pb-2 text-base
           text-gray-900 placeholder-gray-400
           focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
  />
  <label
    class="absolute left-3 top-5 text-gray-500 text-base transition-all duration-200
           peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400
           peer-placeholder-shown:text-base
           peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-600
           peer-[&:not(:placeholder-shown)]:top-2 peer-[&:not(:placeholder-shown)]:text-xs peer-[&:not(:placeholder-shown)]:text-blue-600"
  >
          Username
        </label>
      </div>

      <!-- Email -->
      <div class="relative w-full">
  <input
    type="email"
    x-model="form.email"
    name="email"
    placeholder=" "
    required
    class="peer w-full border-2 border-gray-300 rounded-md px-3 pt-5 pb-2 text-base
           text-gray-900 placeholder-gray-400
           focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
  />
  <label
    class="absolute left-3 top-5 text-gray-500 text-base transition-all duration-200
           peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400
           peer-placeholder-shown:text-base
           peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-600
           peer-[&:not(:placeholder-shown)]:top-2 peer-[&:not(:placeholder-shown)]:text-xs peer-[&:not(:placeholder-shown)]:text-blue-600"
  >
    Email
  </label>
</div>
    </div>
  </template>

  <!-- Login email -->
  <template x-if="mode==='login'">
  <div class="relative w-full">
  <input
    type="email"
    x-model="form.email"
    name="email"
    placeholder="Enter your email"
    required
    class="peer w-full border-2 border-gray-300 rounded-md px-3 pt-5 pb-2 text-base
           text-gray-900 placeholder-gray-400
           focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
  />
  <label
    class="absolute left-3 top-5 text-gray-500 text-base transition-all duration-200
           peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400
           peer-placeholder-shown:text-base
           peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-600
           peer-[&:not(:placeholder-shown)]:top-2 peer-[&:not(:placeholder-shown)]:text-xs peer-[&:not(:placeholder-shown)]:text-blue-600"
  >
    Email
  </label>
</div>
  </template>

  <!-- Password -->
  <div class="relative w-full" x-data="{ show: false }">
  <input
    :type="show ? 'text' : 'password'"
    x-model="form.password"
    name="password"
    placeholder="Enter your password"
    required
    minlength="6"
    class="peer w-full border-2 border-gray-300 rounded-md px-3 pt-5 pb-2 text-base
           text-gray-900 placeholder-gray-400
           focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
  />
  <label
    class="absolute left-3 top-2 text-gray-500 text-sm transition-all duration-200
           peer-focus:-translate-y-2 peer-focus:text-xs peer-focus:text-blue-600
           peer-[&:not(:placeholder-shown)]:-translate-y-2 peer-[&:not(:placeholder-shown)]:text-xs peer-[&:not(:placeholder-shown)]:text-blue-600"
  >
    Password
  </label>

  <!-- Toggle button -->
  <button
    type="button"
    @click="show = !show"
    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
  >
    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7
               -1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
    </svg>
    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7
               a9.956 9.956 0 012.042-3.362M9.88 9.88a3 3 0 104.24 4.24M6.1 6.1l11.8 11.8"/>
    </svg>
  </button>
</div>

  <!-- Confirm password (signup only) -->
  <template x-if="mode==='signup'">
    <div class="relative w-full" x-data="{ show: false }">
  <input
    :type="show ? 'text' : 'password'"
    x-model="form.password_confirmation"
    name="password_confirmation"
    placeholder=" "
    required
    minlength="6"
    class="peer w-full border-2 border-gray-300 rounded-md px-3 pt-5 pb-2 text-base
           text-gray-900 placeholder-gray-400
           focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
  />
  <label
    class="absolute left-3 top-2 text-gray-500 text-sm transition-all duration-200
           peer-focus:-translate-y-2 peer-focus:text-xs peer-focus:text-blue-600
           peer-[&:not(:placeholder-shown)]:-translate-y-2 peer-[&:not(:placeholder-shown)]:text-xs peer-[&:not(:placeholder-shown)]:text-blue-600"
  >
    Confirm password
  </label>

  <!-- Toggle button -->
  <button
    type="button"
    @click="show = !show"
    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
  >
    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7
               -1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
    </svg>
    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7
               a9.956 9.956 0 012.042-3.362M9.88 9.88a3 3 0 104.24 4.24M6.1 6.1l11.8 11.8"/>
    </svg>
  </button>
</div>
  </template>

  <!-- Remember + Forgot -->
  <div class="flex items-center justify-between">
    <div class="flex items-center gap-2">
      <input x-model="form.remember" type="checkbox" id="remember" class="h-4 w-4" />
      <label for="remember" class="text-sm text-gray-700">Remember me</label>
    </div>
    <a href="{{ route('password.request') }}" class="text-sm text-blue-600">Forgot?</a>
  </div>

  <!-- Submit -->
  <div class="pt-2 relative">
    <div x-show="loading" class="absolute right-3 top-1/2 -translate-y-1/2">
      <svg class="w-7 h-7 animate-spin" viewBox="0 0 36 36">
        <circle cx="18" cy="18" r="15" stroke="#e5e7eb" stroke-width="6" fill="none"></circle>
        <circle cx="18" cy="18" r="15" stroke="#0f172a" stroke-width="6" stroke-dasharray="80 100" stroke-linecap="round" fill="none"></circle>
      </svg>
    </div>

    <button type="submit" class="w-full py-2 rounded bg-slate-900 text-white" :disabled="loading">
      <span x-text="mode==='login' ? 'Sign in' : 'Create account'"></span>
    </button>
  </div>
</form>

        <!-- small area for errors -->
        <div x-show="error" x-text="error" class="mt-3 text-sm text-red-600"></div>
      </div>
    </div>
  </div>

  <!-- Toast -->
<div 
  x-show="toast.show"
  x-transition
  :class="toast.type === 'error' ? 'bg-red-600' : 'bg-green-600'"
  class="fixed top-4 right-4 z-50 w-72 text-white rounded shadow-lg overflow-hidden"
>
  <div class="px-4 py-3">
    <span x-text="toast.message"></span>
  </div>
  <div class="h-1 bg-gray-700">
    <div 
      class="h-1"
      :class="toast.type === 'error' ? 'bg-red-400' : 'bg-green-400'"
      :style="`width: ${toast.progress}%; transition: width linear ${toast.duration}ms;`"
    ></div>
  </div>
</div>

</div>
</footer>
