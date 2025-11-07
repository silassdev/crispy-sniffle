
<nav x-data="nav()" class="bg-white border-b shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      
      <div class="flex items-center gap-4">
        <a href="<?php echo e(auth()->check() ? route('student.dashboard') : route('home')); ?>" class="flex items-center gap-2">
          <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Logo" class="w-10 h-10 object-contain">
          <span class="font-bold text-lg"><?php echo e(config('app.name')); ?></span>
        </a>
      </div>

      
      <?php if(auth()->guard()->guest()): ?>
      <div class="hidden md:flex md:items-center md:space-x-6">
        
        <div class="relative" x-on:mouseenter="open('solutions')" x-on:mouseleave="closeDelayed('solutions')">
          <button @click="toggle('solutions')" class="flex items-center gap-2 py-2 px-3 hover:bg-gray-50 rounded">
            <span class="font-medium">Solutions</span>
            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" /></svg>
          </button>

          <div x-show="isOpen('solutions')" x-transition x-cloak
               @mouseenter="clearCloseTimeout('solutions')" @mouseleave="closeDelayed('solutions')"
               class="absolute left-0 mt-2 w-64 bg-white border rounded shadow-lg z-50">
            <ul class="p-3 space-y-2">
              <li class="flex items-start gap-3 p-2 hover:bg-gray-50 rounded">
                <svg class="w-5 h-5 text-indigo-600 mt-0.5" viewBox="0 0 24 24" fill="none"><path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>
                <div>
                  <div class="font-medium">Solution One</div>
                  <div class="text-xs text-gray-500">Short description</div>
                </div>
              </li>
              <li class="flex items-start gap-3 p-2 hover:bg-gray-50 rounded">
                <svg class="w-5 h-5 text-indigo-600 mt-0.5" viewBox="0 0 24 24" fill="none"><path d="M12 5v14" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>
                <div>
                  <div class="font-medium">Solution Two</div>
                  <div class="text-xs text-gray-500">Short description</div>
                </div>
              </li>
              <li class="flex items-start gap-3 p-2 hover:bg-gray-50 rounded">
                <svg class="w-5 h-5 text-indigo-600 mt-0.5" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"></circle></svg>
                <div>
                  <div class="font-medium">Solution Three</div>
                  <div class="text-xs text-gray-500">Short description</div>
                </div>
              </li>
              <li class="flex items-start gap-3 p-2 hover:bg-gray-50 rounded">
                <svg class="w-5 h-5 text-indigo-600 mt-0.5" viewBox="0 0 24 24" fill="none"><path d="M4 12h16" stroke="currentColor" stroke-width="2"></path></svg>
                <div>
                  <div class="font-medium">Solution Four</div>
                  <div class="text-xs text-gray-500">Short description</div>
                </div>
              </li>
            </ul>
          </div>
        </div>

        
        <div class="relative" x-on:mouseenter="open('products')" x-on:mouseleave="closeDelayed('products')">
          <button @click="toggle('products')" class="flex items-center gap-2 py-2 px-3 hover:bg-gray-50 rounded">
            <span class="font-medium">Products</span>
            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" /></svg>
          </button>
          <div x-show="isOpen('products')" x-cloak x-transition class="absolute left-0 mt-2 w-56 bg-white border rounded shadow-lg z-50">
            <ul class="p-3 space-y-2">
              <li class="p-2 hover:bg-gray-50 rounded">Product A</li>
              <li class="p-2 hover:bg-gray-50 rounded">Product B</li>
              <li class="p-2 hover:bg-gray-50 rounded">Product C</li>
            </ul>
          </div>
        </div>

        
        <div class="relative" x-on:mouseenter="open('resources')" x-on:mouseleave="closeDelayed('resources')">
          <button @click="toggle('resources')" class="flex items-center gap-2 py-2 px-3 hover:bg-gray-50 rounded">
            <span class="font-medium">Resources</span>
            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" /></svg>
          </button>
          <div x-show="isOpen('resources')" x-cloak x-transition class="absolute left-0 mt-2 w-48 bg-white border rounded shadow-lg z-50">
            <ul class="p-3 space-y-2">
              <li class="p-2 hover:bg-gray-50 rounded">Docs</li>
              <li class="p-2 hover:bg-gray-50 rounded">Tutorials</li>
              <li class="p-2 hover:bg-gray-50 rounded">Blog</li>
            </ul>
          </div>
        </div>

        
        <div class="relative" x-on:mouseenter="open('company')" x-on:mouseleave="closeDelayed('company')">
          <button @click="toggle('company')" class="flex items-center gap-2 py-2 px-3 hover:bg-gray-50 rounded">
            <span class="font-medium">Company</span>
            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" /></svg>
          </button>
          <div x-show="isOpen('company')" x-cloak x-transition class="absolute left-0 mt-2 w-48 bg-white border rounded shadow-lg z-50">
            <ul class="p-3 space-y-2">
              <li class="p-2 hover:bg-gray-50 rounded">About</li>
              <li class="p-2 hover:bg-gray-50 rounded">Careers</li>
              <li class="p-2 hover:bg-gray-50 rounded">Contact</li>
            </ul>
          </div>
        </div>
      </div>
      <?php endif; ?>

      
      <div class="flex items-center gap-4">
        <?php if(auth()->guard()->guest()): ?>
          <a href="<?php echo e(route('login')); ?>" class="hidden md:inline text-sm">Login</a>
          <a href="<?php echo e(route('register')); ?>" class="hidden md:inline text-sm px-3 py-1 border rounded">Sign up</a>
        <?php else: ?>
          
          <a href="<?php echo e(auth()->user()->isAdmin() ? route('admin.dashboard') : (auth()->user()->isTrainer() ? route('trainer.dashboard') : route('student.dashboard'))); ?>" class="hidden md:inline text-sm">Dashboard</a>
          <div class="hidden md:inline">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('actions.logout', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1679130785-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
          </div>
        <?php endif; ?>

        
        <button @click="mobile = !mobile" class="md:hidden p-2 rounded focus:outline-none" aria-label="Open menu">
          <svg x-show="!mobile" x-cloak class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg x-show="mobile" x-cloak class="w-6 h-6 transform rotate-90" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  
  <div x-show="mobile" x-cloak x-transition class="md:hidden border-t bg-white">
    <div class="px-4 py-4 space-y-2">
      <?php if(auth()->guard()->guest()): ?>
        <a @click="mobile = false" href="#" class="block py-2">Solutions</a>
        <a @click="mobile = false" href="#" class="block py-2">Products</a>
        <a @click="mobile = false" href="#" class="block py-2">Resources</a>
        <a @click="mobile = false" href="#" class="block py-2">Company</a>

        <div class="pt-3 border-t">
          <a href="<?php echo e(route('login')); ?>" class="block py-2">Login</a>
          <a href="<?php echo e(route('register')); ?>" class="block py-2">Sign up</a>
        </div>
      <?php else: ?>
        <a @click="mobile = false" href="<?php echo e(auth()->user()->isAdmin() ? route('admin.dashboard') : (auth()->user()->isTrainer() ? route('trainer.dashboard') : route('student.dashboard'))); ?>" class="block py-2">Dashboard</a>
        <div class="pt-3 border-t">
          <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('actions.logout', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1679130785-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script>
    function nav(){
      return {
        mobile: false,
        openMenus: {},
        timeouts: {},
        open(name){ this.openMenus[name] = true; this.clearCloseTimeout(name); },
        toggle(name){ this.openMenus[name] = !this.openMenus[name]; },
        isOpen(name){ return !!this.openMenus[name]; },
        closeDelayed(name){
          this.clearCloseTimeout(name);
          this.timeouts[name] = setTimeout(()=> this.openMenus[name] = false, 250);
        },
        clearCloseTimeout(name){
          if(this.timeouts[name]){ clearTimeout(this.timeouts[name]); this.timeouts[name] = null; }
        }
      }
    }
  </script>
</nav><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>