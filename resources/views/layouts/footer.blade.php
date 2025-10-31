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
</footer>
