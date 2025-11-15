
<?php
  $dashboardRoute = 'home';

  if (auth()->check()) {
      $u = auth()->user();

      if (method_exists($u, 'isAdmin') && $u->isAdmin()) {
          $dashboardRoute = 'admin.dashboard';
      } elseif (method_exists($u, 'isTrainer') && $u->isTrainer()) {
          $dashboardRoute = 'trainer.dashboard';
      } else {
          $dashboardRoute = 'student.dashboard';
      }
  }
?>

<nav x-data="nav()" @keydown.window="if($event.key === 'Escape'){ closeAll() }" class="bg-white border-b">
  <style>
    /* quick local styles — composited transitions, tighter logo spacing */
    .nav-link { position: relative; transition: color .14s ease; }
    .nav-link::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -8px;
      height: 3px;
      width: 0%;
      background: linear-gradient(90deg,#7c3aed,#06b6d4);
      border-radius: 6px;
      transition: width .18s ease;
      opacity: 0.95;
    }
    .nav-link:hover::after,
    .nav-link:focus::after,
    .nav-link[aria-expanded="true"]::after { width: 100%; }

    /* lightweight panel animation using transform+opacity for GPU compositing */
    .menu-panel {
      min-width: 18.75rem; /* 300px */
      border-radius: 0.5rem;
      box-shadow: 0 8px 20px rgba(2,6,23,0.06);
      will-change: transform, opacity;
      transform-origin: top left;
      transform: translateY(6px) scale(0.995);
      opacity: 0;
      pointer-events: none;
      transition: transform 160ms cubic-bezier(.2,.9,.2,1), opacity 140ms ease;
    }
    .menu-panel.open {
      transform: translateY(0) scale(1);
      opacity: 1;
      pointer-events: auto;
    }

    .menu-item { transition: background-color .12s ease, transform .06s ease; }
    .menu-item:hover { background: #f8fafc; transform: translateY(-2px); }

    /* tighten logo + name spacing on larger screens */
    @media (min-width: 768px) {
      .nav-left-gap { gap: 0.75rem; }
    }

    /* mobile backdrop */
    .mobile-backdrop { background: rgba(15,23,42,0.03); }
  </style>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      
      <div class="flex items-center nav-left-gap">
        <a href="<?php echo e(route($dashboardRoute)); ?>" class="flex items-center gap-3">
          <img src="<?php echo e(asset('img/igniscode.svg')); ?>" alt="Logo" class="w-10 h-10 object-contain">
          <span class="font-extrabold text-lg leading-none"><?php echo e(config('app.name')); ?></span>
        </a>

        
        <?php if(auth()->guard()->guest()): ?>
        <div class="hidden md:flex md:items-center md:ml-6 md:space-x-3">
          
          <div class="relative"
               @mouseenter="open('solutions')"
               @mouseleave="closeDelayed('solutions')"
               @focusin="open('solutions')">
            <button
              @click="toggle('solutions')"
              :aria-expanded="isOpen('solutions') ? 'true' : 'false'"
              aria-controls="solutions-panel"
              class="nav-link inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 rounded hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-300"
            >
              <span>Solutions</span>
              <svg class="w-4 h-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" /></svg>
            </button>

            <div
              id="solutions-panel"
              x-ref="solutionsPanel"
              x-bind:class="isOpen('solutions') ? 'menu-panel open absolute left-0 mt-3 bg-white border z-50' : 'menu-panel absolute left-0 mt-3 bg-white border z-50'"
              @mouseenter="clearCloseTimeout('solutions')"
              @mouseleave="closeDelayed('solutions')"
              role="menu"
              aria-labelledby="solutions-button"
            >
              <div class="grid grid-cols-1 gap-0">
                <a href="#" class="menu-item flex gap-3 p-4 items-start border-b" role="menuitem" tabindex="0">
                  <div class="flex items-center justify-center w-10 h-10 rounded-md bg-indigo-50 text-indigo-600">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>
                  </div>
                  <div>
                    <div class="font-medium">Solution One</div>
                    <div class="text-xs text-gray-500">Short description that explains the benefit.</div>
                  </div>
                </a>

                <a href="#" class="menu-item flex gap-3 p-4 items-start border-b" role="menuitem" tabindex="0">
                  <div class="flex items-center justify-center w-10 h-10 rounded-md bg-teal-50 text-teal-600">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 5v14" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>
                  </div>
                  <div>
                    <div class="font-medium">Solution Two</div>
                    <div class="text-xs text-gray-500">A concise line on what it does.</div>
                  </div>
                </a>

                <a href="#" class="menu-item flex gap-3 p-4 items-start border-b" role="menuitem" tabindex="0">
                  <div class="flex items-center justify-center w-10 h-10 rounded-md bg-purple-50 text-purple-600">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"></circle></svg>
                  </div>
                  <div>
                    <div class="font-medium">Solution Three</div>
                    <div class="text-xs text-gray-500">How people use it and why it matters.</div>
                  </div>
                </a>

                <a href="#" class="menu-item flex gap-3 p-4 items-start" role="menuitem" tabindex="0">
                  <div class="flex items-center justify-center w-10 h-10 rounded-md bg-slate-50 text-slate-600">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h16" stroke="currentColor" stroke-width="2"></path></svg>
                  </div>
                  <div>
                    <div class="font-medium">Solution Four</div>
                    <div class="text-xs text-gray-500">Another short benefit line.</div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          
          <div class="relative"
               @mouseenter="open('resources')"
               @mouseleave="closeDelayed('resources')"
               @focusin="open('resources')">
            <button
              @click="toggle('resources')"
              :aria-expanded="isOpen('resources') ? 'true' : 'false'"
              class="nav-link inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 rounded hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-300"
            >
              <span>Resources</span>
              <svg class="w-4 h-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" /></svg>
            </button>

            <div
              x-ref="resourcesPanel"
              x-bind:class="isOpen('resources') ? 'menu-panel open absolute left-0 mt-3 bg-white border z-50' : 'menu-panel absolute left-0 mt-3 bg-white border z-50'"
              @mouseenter="clearCloseTimeout('resources')"
              @mouseleave="closeDelayed('resources')"
              role="menu"
            >
              <ul class="p-2">
                <li class="p-2 rounded hover:bg-gray-50 menu-item" role="menuitem" tabindex="0"><a href="#">Docs</a></li>
                <li class="p-2 rounded hover:bg-gray-50 menu-item" role="menuitem" tabindex="0"><a href="#">Tutorials</a></li>
                <li class="p-2 rounded hover:bg-gray-50 menu-item" role="menuitem" tabindex="0"><a href="#">Blog</a></li>
              </ul>
            </div>
          </div>

          
          <div class="relative"
               @mouseenter="open('company')"
               @mouseleave="closeDelayed('company')"
               @focusin="open('company')">
            <button
              @click="toggle('company')"
              :aria-expanded="isOpen('company') ? 'true' : 'false'"
              class="nav-link inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 rounded hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-300"
            >
              <span>Company</span>
              <svg class="w-4 h-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.25 4a.75.75 0 01-1.04 0l-4.25-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" /></svg>
            </button>

            <div
              x-ref="companyPanel"
              x-bind:class="isOpen('company') ? 'menu-panel open absolute left-0 mt-3 w-56 bg-white border z-50' : 'menu-panel absolute left-0 mt-3 w-56 bg-white border z-50'"
              @mouseenter="clearCloseTimeout('company')"
              @mouseleave="closeDelayed('company')"
              role="menu"
            >
              <ul class="p-2">
                <li class="p-2 flex items-center gap-3 rounded hover:bg-gray-50 menu-item" role="menuitem" tabindex="0">
                  <svg class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 12h18" stroke="currentColor" stroke-width="2"></path></svg>
                  <a href="#">About</a>
                </li>
                <li class="p-2 flex items-center gap-3 rounded hover:bg-gray-50 menu-item" role="menuitem" tabindex="0">
                  <svg class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 5v14" stroke="currentColor" stroke-width="2"></path></svg>
                  <a href="#">Careers</a>
                </li>
                <li class="p-2 flex items-center gap-3 rounded hover:bg-gray-50 menu-item" role="menuitem" tabindex="0">
                  <svg class="w-5 h-5 text-slate-600" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h16" stroke="currentColor" stroke-width="2"></path></svg>
                  <a href="#">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>

      
      <div class="flex items-center gap-4">
        <?php if(auth()->guard()->guest()): ?>
          <div class="hidden md:flex md:items-center md:gap-3">
          <a href="<?php echo e(route('login')); ?>" 
          class="hidden md:inline text-sm font-inter text-gray-700 
          hover:text-gray-900 hover:underline underline-offset-4 
          transition-all duration-200">Login</a>
          <a href="<?php echo e(route('register')); ?>" 
          class="hidden md:inline text-sm font-inter px-4 py-2 rounded-lg bg-indigo-600 text-white
          hover:bg-indigo-700 hover:shadow-lg hover:scale-[1.03]
          active:scale-[0.98]
          transition-all duration-200">Sign up</a>
          </div>
        <?php else: ?>
          <div class="hidden md:flex md:items-center md:gap-3">
            <a href="<?php echo e(route($dashboardRoute)); ?>" class="text-sm text-gray-700 hover:text-indigo-600 transition">Dashboard</a>
            <div>
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
          </div>
        <?php endif; ?>

        
        <div class="md:hidden">
          <button @click="mobile = !mobile" class="p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-300" aria-label="Toggle menu" :aria-expanded="mobile ? 'true' : 'false'">
            <svg x-show="!mobile" x-cloak class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg x-show="mobile" x-cloak class="w-6 h-6 transform rotate-90" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  
  <div x-show="mobile" x-cloak x-transition class="md:hidden mobile-backdrop border-t">
    <div class="px-4 py-4 space-y-3">
      <?php if(auth()->guard()->guest()): ?>
        <a @click="mobile = false" href="#" class="block py-2 text-gray-700">Solutions</a>
        <a @click="mobile = false" href="#" class="block py-2 text-gray-700">Products</a>
        <a @click="mobile = false" href="#" class="block py-2 text-gray-700">Resources</a>
        <a @click="mobile = false" href="#" class="block py-2 text-gray-700">Company</a>

        <div class="pt-3 border-t">
          <a href="<?php echo e(route('login')); ?>" class="block py-2">Login</a>
          <a href="<?php echo e(route('register')); ?>" class="block py-2">Sign up</a>
        </div>
      <?php else: ?>
        <a @click="mobile = false" href="<?php echo e(route($dashboardRoute)); ?>" class="block py-2">Dashboard</a>
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

        open(name){
          for (const k in this.openMenus) if (k !== name) this.openMenus[k] = false;
          this.openMenus[name] = true;
          this.clearCloseTimeout(name);
        },

        toggle(name){
          if(this.isOpen(name)) this.openMenus[name] = false;
          else this.open(name);
        },

        isOpen(name){ return !!this.openMenus[name]; },

        close(name){ this.openMenus[name] = false; this.clearCloseTimeout(name); },

        closeAll(){ for (const k in this.openMenus) this.openMenus[k] = false; },

        closeDelayed(name){
          this.clearCloseTimeout(name);
          this.timeouts[name] = setTimeout(()=> { this.openMenus[name] = false; this.timeouts[name] = null; }, 180);
        },

        clearCloseTimeout(name){
          if(this.timeouts[name]){ clearTimeout(this.timeouts[name]); this.timeouts[name] = null; }
        }
      }
    }
  </script>
</nav>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>