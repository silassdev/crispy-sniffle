<section class="bg-slate-200 text-slate-500 border-b border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">

      <!-- Useful Links -->
      <nav aria-label="Useful links">
        <h3 class="text-gray-700 text-lg font-semibold mb-4 text-balance">Useful Links</h3>
        <ul class="space-y-2 text-sm">
          <li>
            <a href="{{ route('home') }}"
               @class([
                 'block px-2 py-1 rounded transition w-fit',
                 'text-white bg-slate-800' => request()->routeIs('home'),
                 'text-slate-300 hover:text-white hover:bg-slate-800/60' => ! request()->routeIs('home')
               ])>
              Home
            </a>
          </li>

          <li>
            <a href="{{ route('blogs.index') }}"
               @class([
                 'block px-2 py-1 rounded transition w-fit',
                 'text-white bg-slate-800' => request()->routeIs('blogs.*'),
                 'text-slate-300 hover:text-white hover:bg-slate-800/60' => ! request()->routeIs('blogs.*')
               ])>
              Blog
            </a>
          </li>

          <li>
            <a href="{{ route('contact.show') }}"
               @class([
                 'block px-2 py-1 rounded transition w-fit',
                 'text-white bg-slate-800' => request()->routeIs('contact.*'),
                 'text-slate-300 hover:text-white hover:bg-slate-800/60' => ! request()->routeIs('contact.*')
               ])>
              Contact
            </a>
          </li>

          <li>
            <a href="#pricing" class="block px-2 py-1 text-slate-300 hover:text-white hover:bg-slate-800/60 rounded transition w-fit">
              Pricing
            </a>
          </li>

          <li>
            <a href="#docs" class="block px-2 py-1 text-slate-300 hover:text-white hover:bg-slate-800/60 rounded transition w-fit">
              Docs
            </a>
          </li>
        </ul>
      </nav>


      <!-- Subscribe Action -->
      <div class="md:text-left lg:text-right">
        <h3 class="text-gray-700 text-lg font-semibold mb-4">Stay in the loop</h3>
        <p class="text-sm text-gray-600 mb-4">Subscribe for occasional updates about releases, tutorials and offers.</p>

        <form action="{{ route('admin.login') ?? '#' }}" method="POST" class="flex gap-2 justify-start lg:justify-end">
          @csrf
          <input name="email" type="email" placeholder="Your email" class="px-3 py-2 rounded bg-slate-800 border border-slate-700 text-sm text-slate-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600 w-full max-w-[200px]" />
          <button type="submit" class="px-4 py-2 rounded bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition shadow-sm">
            Subscribe
          </button>
        </form>
      </div>

    </div>
  </div>
</section>
