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
            <a href="<?php echo e(route('home')); ?>"
               class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('home'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('home')
               ]); ?>">
              Home
            </a>
          </li>

          <li>
            <a href="<?php echo e(route('blogs.index')); ?>"
               class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('blogs.*'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('blogs.*')
               ]); ?>">
              Blog Feed
            </a>
          </li>

          <li>
            <a href="<?php echo e(route('contact.show')); ?>"
               class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('contact.*'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('contact.*')
               ]); ?>">
              Contact Us
            </a>
          </li>

          <li>
            <a href="<?php echo e(route('pricing')); ?>"
               class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('pricing'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('pricing')
               ]); ?>">
              Pricing Plans
            </a>
          </li>

          <li>
            <a href="<?php echo e(route('contribution')); ?>"
               class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('contribution'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('contribution')
               ]); ?>">
              Contributors
            </a>
          </li>

          <li>
            <a href="<?php echo e(route('sponsor')); ?>"
               class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('sponsor'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('sponsor')
               ]); ?>">
              Sponsor
            </a>
          </li>

          <li>
            <a href="<?php echo e(route('feedback')); ?>"
               class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                 'inline-flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-bold',
                 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' => request()->routeIs('feedback'),
                 'text-slate-400 hover:text-white hover:bg-white/5' => ! request()->routeIs('feedback')
               ]); ?>">
              Feedback
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

        <div class="max-w-sm lg:ml-auto">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('newsletter-subscription', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2564592631-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
      </div>

    </div>
  </div>
</section>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/links.blade.php ENDPATH**/ ?>