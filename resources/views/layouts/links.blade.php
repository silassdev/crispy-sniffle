<section class="bg-slate-900 text-slate-400 border-t border-slate-800 relative overflow-hidden group">
  <!-- Abstract Decoration -->
  <div class="absolute -right-24 -top-24 w-96 h-96 bg-indigo-600 rounded-full blur-[120px] opacity-20 group-hover:opacity-30 transition-opacity duration-700"></div>
  <div class="absolute -left-24 -bottom-24 w-96 h-96 bg-blue-600 rounded-full blur-[120px] opacity-10"></div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-16">

      <!-- Useful Links -->
      <nav aria-label="Useful links">
        <h3 class="text-white text-xl font-extrabold mb-8 flex items-center gap-3">
            <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
            Quick Navigation
        </h3>
        <ul class="space-y-4 text-sm">
          <li>
            <a href="{{ route('home') }}"
               @class([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('home'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('home')
               ])>
              Home
            </a>
          </li>

          <li>
            <a href="{{ route('blogs.index') }}"
               @class([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('blogs.*'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('blogs.*')
               ])>
              Blog Feed
            </a>
          </li>

          <li>
            <a href="{{ route('contact.show') }}"
               @class([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('contact.*'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('contact.*')
               ])>
              Contact Us
            </a>
          </li>

          <li>
            <a href="{{ route('pricing') }}"
               @class([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('pricing'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('pricing')
               ])>
              Pricing Plans
            </a>
          </li>

          <li>
            <a href="{{ route('contribution') }}"
               @class([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('contribution'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('contribution')
               ])>
              Contributing
            </a>
          </li>
        </ul>
      </nav>

      <!-- Platform Info (Visual Placeholder) -->
      <div class="hidden lg:block">
           <h3 class="text-white text-xl font-extrabold mb-8 flex items-center gap-3">
                <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                Our Platform
           </h3>
           <p class="text-slate-400 text-sm leading-relaxed mb-6">
                Redefining the digital learning experience through a high-performance, community-driven LMS ecosystem.
           </p>
           <div class="flex items-center gap-4">
               <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center border border-white/10 text-white font-black text-lg">
                   L
               </div>
               <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center border border-white/10 text-white font-black text-lg">
                   M
               </div>
               <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center border border-white/10 text-white font-black text-lg">
                   S
               </div>
           </div>
      </div>

      <!-- Subscribe Action -->
      <div class="md:text-left lg:text-right">
        <h3 class="text-white text-xl font-extrabold mb-8 flex items-center gap-3 justify-start lg:justify-end">
            Join our Newsletter
            <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
        </h3>
        <p class="text-sm text-slate-400 mb-8 max-w-sm lg:ml-auto leading-relaxed">Subscribe for occasional updates about releases, tutorials and expert insights directly to your inbox.</p>

        <form action="{{ route('admin.login') ?? '#' }}" method="POST" class="space-y-3 max-w-sm lg:ml-auto">
          @csrf
          <div class="relative group/input">
              <input name="email" type="email" placeholder="name@company.com" 
                     class="w-full px-6 py-4 rounded-2xl bg-white/5 border border-white/10 text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500/50 focus:bg-white/10 transition-all duration-300" />
              <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-500 group-focus-within/input:text-emerald-500">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
              </div>
          </div>
          <button type="submit" class="w-full py-4 rounded-2xl bg-emerald-600 text-white font-extrabold hover:bg-emerald-500 transition-all duration-300 shadow-xl shadow-emerald-900/40 hover:-translate-y-1 transform">
            Get Updates
          </button>
        </form>
      </div>

    </div>
  </div>
</section>
