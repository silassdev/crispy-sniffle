
<footer class="bg-slate-900 text-slate-200 mt-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Useful Links -->
      <nav aria-label="Useful links">
        <h3 class="text-white text-lg font-semibold mb-4">Useful Links</h3>
        <ul class="space-y-2 text-sm">
          <li>
            <a href="<?php echo e(route('home')); ?>"
               class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                 'block px-2 py-1 rounded transition',
                 'text-white' => request()->routeIs('home'),
                 'text-slate-300 hover:text-white hover:bg-slate-800/60' => ! request()->routeIs('home')
               ]); ?>">
              Home
            </a>
          </li>

          <li>
            <a href="<?php echo e(route('blogs')); ?>"
               class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                 'block px-2 py-1 rounded transition',
                 'text-white' => request()->routeIs('blogs.*'),
                 'text-slate-300 hover:text-white hover:bg-slate-800/60' => ! request()->routeIs('blogs.*')
               ]); ?>">
              Blog
            </a>
          </li>

          <li>
            <a href="<?php echo e(route('contact.show')); ?>"
               class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                 'block px-2 py-1 rounded transition',
                 'text-white' => request()->routeIs('contact.*'),
                 'text-slate-300 hover:text-white hover:bg-slate-800/60' => ! request()->routeIs('contact.*')
               ]); ?>">
              Contact
            </a>
          </li>

          <li>
            <a href="#pricing" class="block px-2 py-1 text-slate-300 hover:text-white hover:bg-slate-800/60 rounded transition">
              Pricing
            </a>
          </li>

          <li>
            <a href="#docs" class="block px-2 py-1 text-slate-300 hover:text-white hover:bg-slate-800/60 rounded transition">
              Docs
            </a>
          </li>
        </ul>
      </nav>

      <!-- About -->
      <div>
        <h3 class="text-white text-lg font-semibold mb-4">About</h3>
        <p class="text-sm text-slate-300 mb-4">Building clean, fast Laravel apps & custom APIs — available for hire.</p>
        <p class="text-xs text-slate-500">© <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. All rights reserved.</p>
      </div>

      <!-- Extra: small site info or newsletter CTA -->
      <div class="md:text-right">
        <h3 class="text-white text-lg font-semibold mb-4">Stay in the loop</h3>
        <p class="text-sm text-slate-300 mb-4">Subscribe for occasional updates about releases, tutorials and offers.</p>

        <!-- simple non-js email form (optional) -->
        <form action="<?php echo e(route('admin.login') ?? '#'); ?>" method="POST" class="flex gap-2 justify-start md:justify-end">
          <?php echo csrf_field(); ?>
          <input name="email" type="email" placeholder="Your email" class="px-3 py-2 rounded bg-slate-800 border border-slate-700 text-sm text-slate-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600" />
          <button type="submit" class="px-3 py-2 rounded bg-emerald-600 text-white text-sm hover:bg-emerald-700">Subscribe</button>
        </form>
      </div>
    </div>

    
    <div class="mt-10 border-t border-slate-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-3">
        <img src="<?php echo e(asset('img/igniscode.svg')); ?>" alt="<?php echo e(config('app.name')); ?> logo" class="w-6 h-6">
        <span class="text-sm text-slate-400"><?php echo e(config('app.name')); ?></span>
      </div>

      <ul class="flex flex-wrap items-center gap-4 text-xs text-slate-400">
        <li><a href="<?php echo e(route('admin.login') ?? '#'); ?>" class="hover:text-white">Privacy</a></li>
        
        <li><a href="#" class="hover:text-white">Break</a></li>
      </ul>
    </div>
  </div>
</footer>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/footer.blade.php ENDPATH**/ ?>