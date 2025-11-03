
<nav x-data="nav()" 
     x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)" 
     :class="scrolled ? 'backdrop-blur bg-white/80 shadow-md' : 'bg-transparent'"
     class="fixed w-full z-50 transition-all duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      
      
      <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2">
        <img src="<?php echo e(asset('img/icon.jpg')); ?>" alt="Logo" class="w-10 h-10 object-contain">
        <span class="font-bold text-lg tracking-tight"><?php echo e(config('app.name')); ?></span>
      </a>

      
      <div class="hidden md:flex md:items-center md:space-x-6">

        
        <div class="relative group">
          <button class="flex items-center gap-2 py-2 px-2 font-medium text-gray-700 hover:text-indigo-600 transition">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 3.75h-6v6h6v-6zM20.25 3.75h-6v6h6v-6zM9.75 14.25h-6v6h6v-6zM20.25 14.25h-6v6h6v-6z"/>
            </svg>
            <span>Solutions</span>
            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
            </svg>
          </button>
          <div class="absolute left-0 mt-3 w-72 bg-white/90 backdrop-blur border rounded-lg shadow-lg opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200">
            <ul class="p-3 space-y-2 text-sm">
              <li class="flex items-start gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 2.25l-6.563 9h7.5l-1.5 10.5 10.5-13.5h-7.5l-2.937-6z"/>
                </svg>
                <div>
                  <div class="font-medium">Automation Suite</div>
                  <div class="text-xs text-gray-500">Kickstart workflows and reduce manual ops</div>
                </div>
              </li>
              <li class="flex items-start gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 20.25h18M6.75 16.5V9.75M12 16.5V6.75M17.25 16.5V12.75"/>
                </svg>
                <div>
                  <div class="font-medium">Analytics</div>
                  <div class="text-xs text-gray-500">Real-time dashboards and insights</div>
                </div>
              </li>
              <li class="flex items-start gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3.75l7.5 3v6.75c0 4.223-3.375 6.75-7.5 6.75s-7.5-2.527-7.5-6.75V6.75l7.5-3zM9 12.75l2 2 4-4"/>
                </svg>
                <div>
                  <div class="font-medium">Security</div>
                  <div class="text-xs text-gray-500">Compliance-ready access controls</div>
                </div>
              </li>
              <li class="flex items-start gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21.75c5.385 0 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25 2.25 6.615 2.25 12s4.365 9.75 9.75 9.75zM4.5 9h15M4.5 15h15M12 2.25c0 0 3.75 4.5 3.75 9.75S12 21.75 12 21.75 8.25 17.25 8.25 12 12 2.25 12 2.25z"/>
                </svg>
                <div>
                  <div class="font-medium">Global CDN</div>
                  <div class="text-xs text-gray-500">Fast delivery across regions</div>
                </div>
              </li>
            </ul>
          </div>
        </div>

        
        <div class="relative group">
          <button class="flex items-center gap-2 py-2 px-2 font-medium text-gray-700 hover:text-indigo-600 transition">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511l-8.25-4.5-8.25 4.5M20.25 8.511v6.978l-8.25 4.5-8.25-4.5V8.511M12 20.0V12"/>
            </svg>
            <span>Products</span>
            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
            </svg>
          </button>
          <div class="absolute left-0 mt-3 w-56 bg-white/90 backdrop-blur border rounded-lg shadow-lg opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200">
            <ul class="p-3 space-y-2 text-sm">
              <li class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6.75h18v3H3v-3zM3 12.75h18v3H3v-3zM3 18.75h18v3H3v-3z"/>
                </svg>
                <span>Product A</span>
              </li>
              <li class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 3.75h4.5l.75 2.25 2.25.75v4.5l-2.25.75-.75 2.25h-4.5l-.75-2.25-2.25-.75v-4.5l2.25-.75.75-2.25zM12 10.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
                </svg>
                <span>Product B</span>
              </li>
              <li class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 9l3 3-3 3M13 15h3M3.75 5.25h16.5v13.5H3.75z"/>
                </svg>
                <span>Product C</span>
              </li>
            </ul>
          </div>
        </div>

        
        <div class="relative group">
          <button class="flex items-center gap-2 py-2 px-2 font-medium text-gray-700 hover:text-indigo-600 transition">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.75c-2.25-1.5-4.5-1.5-6.75 0v10.5c2.25-1.5 4.5-1.5 6.75 0 2.25-1.5 4.5-1.5 6.75 0V6.75c-2.25-1.5-4.5-1.5-6.75 0z"/>
            </svg>
            <span>Resources</span>
            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
            </svg>
          </button>
          <div class="absolute left-0 mt-3 w-56 bg-white/90 backdrop-blur border rounded-lg shadow-lg opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200">
            <ul class="p-3 space-y-2 text-sm">
              <li class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 6.75h6M9 10.5h6M9 14.25h6M6.75 3.75h10.5v16.5H6.75z"/>
                </svg>
                <span>Docs</span>
              </li>
              <li class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21.75a9.75 9.75 0 100-19.5 9.75 9.75 0 000 19.5zM10.5 9.75l4.5 2.25-4.5 2.25v-4.5z"/>
                </svg>
                <span>Tutorials</span>
              </li>
              <li class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 6.75h10.5v10.5H4.5zM18.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H6.75"/>
                </svg>
                <span>Blog</span>
              </li>
            </ul>
          </div>
        </div>

        
        <div class="relative group">
          <button class="flex items-center gap-2 py-2 px-2 font-medium text-gray-700 hover:text-indigo-600 transition">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 3.75h10.5v16.5H6.75zM9.75 7.5h2.25M9.75 10.5h2.25M9.75 13.5h2.25M12 20.25v-3h2.25"/>
            </svg>
            <span>Company</span>
            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
            </svg>
          </button>
          <div class="absolute left-0 mt-3 w-56 bg-white/90 backdrop-blur border rounded-lg shadow-lg opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200">
            <ul class="p-3 space-y-2 text-sm">
              <li class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21.75a9.75 9.75 0 100-19.5 9.75 9.75 0 000 19.5zM12 9.75h.008v.008H12V9.75zm0 3v4.5"/>
                </svg>
                <span>About</span>
              </li>
              <li class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 6.75h6v3H9v-3zM3.75 9.75h16.5V18a3 3 0 01-3 3H6.75a3 3 0 01-3-3V9.75z"/>
                </svg>
                <span>Careers</span>
              </li>
              <li class="flex items-center gap-3 p-2 rounded hover:bg-indigo-50">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5v10.5H3.75zM4.5 8.25l7.5 5.25 7.5-5.25"/>
                </svg>
                <span>Contact</span>
              </li>
            </ul>
          </div>
        </div>

      </div>

      
      <div class="flex items-center gap-4">
        <?php if(auth()->guard()->guest()): ?>
          <a href="<?php echo e(route('login')); ?>" class="hidden md:inline text-sm hover:text-indigo-600">Login</a>
          <a href="<?php echo e(route('register')); ?>" class="hidden md:inline text-sm px-3 py-1 border rounded-lg hover:bg-indigo-600 hover:text-white transition">Sign up</a>
        <?php else: ?>
          <a href="<?php echo e(route('student.dashboard')); ?>" class="hidden md:inline text-sm hover:text-indigo-600">Dashboard</a>
          <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('actions.logout', ['class' => 'hidden md:inline']);

$__html = app('livewire')->mount($__name, $__params, 'lw-1679130785-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        <?php endif; ?>

        
        <button @click="mobile = !mobile" class="md:hidden p-2 rounded focus:outline-none" aria-label="Toggle menu">
          <svg x-show="!mobile" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg x-show="mobile" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  
  <div x-show="mobile" x-cloak
       x-transition:enter="transition transform duration-300"
       x-transition:enter-start="-translate-x-full opacity-0"
       x-transition:enter-end="translate-x-0 opacity-100"
       x-transition:leave="transition transform duration-300"
       x-transition:leave-start="translate-x-0 opacity-100"
       x-transition:leave-end="-translate-x-full opacity-0"
       class="fixed inset-y-0 left-0 w-72 bg-white shadow-lg p-6 z-50">
    <nav class="space-y-4">
      <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-indigo-600">
        
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 3.75h-6v6h6v-6zM20.25 3.75h-6v6h6v-6zM9.75 14.25h-6v6h6v-6zM20.25 14.25h-6v6h6v-6z"/>
        </svg>
        <span>Solutions</span>
      </a>
      <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-indigo-600">
        
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511l-8.25-4.5-8.25 4.5M20.25 8.511v6.978l-8.25 4.5-8.25-4.5V8.511M12 20.0V12"/>
        </svg>
        <span>Products</span>
      </a>
      <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-indigo-600">
        
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.75c-2.25-1.5-4.5-1.5-6.75 0v10.5c2.25-1.5 4.5-1.5 6.75 0 2.25-1.5 4.5-1.5 6.75 0V6.75c-2.25-1.5-4.5-1.5-6.75 0z"/>
        </svg>
        <span>Resources</span>
      </a>
      <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-indigo-600">
        
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 3.75h10.5v16.5H6.75zM9.75 7.5h2.25M9.75 10.5h2.25M9.75 13.5h2.25M12 20.25v-3h2.25"/>
        </svg>
        <span>Company</span>
      </a>

      <div class="pt-4 border-t space-y-2">
        <?php if(auth()->guard()->guest()): ?>
          <a href="<?php echo e(route('login')); ?>" class="flex items-center gap-3">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6.75h3v10.5h-3M12 15l3-3-3-3M6.75 4.5h6v15h-6a2.25 2.25 0 01-2.25-2.25V6.75A2.25 2.25 0 016.75 4.5z"/>
            </svg>
            <span>Login</span>
          </a>
          <a href="<?php echo e(route('register')); ?>" class="flex items-center gap-3">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 8.25A3 3 0 119 8.25a3 3 0 016 0zM4.5 19.5a6 6 0 0112 0M18 8.25v3M19.5 9.75h-3"/>
            </svg>
            <span>Sign up</span>
          </a>
        <?php else: ?>
          <a href="<?php echo e(route('student.dashboard')); ?>" class="flex items-center gap-3">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 4.5h6v6h-6zM13.5 4.5h6v6h-6zM4.5 13.5h6v6h-6zM16.5 13.5h3M18 12v3"/>
            </svg>
            <span>Dashboard</span>
          </a>
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
        <?php endif; ?>
      </div>
    </nav>
  </div>

  <script>
    function nav(){
      return {
        mobile: false,
        scrolled: false
      }
    }
  </script>
</nav>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>