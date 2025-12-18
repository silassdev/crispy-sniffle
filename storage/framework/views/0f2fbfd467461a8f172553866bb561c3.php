
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
    .nav-link.active::after,
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

    @media (min-width: 768px) {
      .nav-left-gap { gap: 0.75rem; }
    }

    .mobile-backdrop { background: rgba(15,23,42,0.03); }
  </style>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      
      <div class="flex items-center nav-left-gap">
        <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3">
          <img src="<?php echo e(asset('img/igniscode.svg')); ?>" alt="Logo" class="w-10 h-10 object-contain">
          <span class="font-extrabold text-lg leading-none"><?php echo e(config('app.name')); ?></span>
        </a>

        
        <?php if(auth()->guard()->guest()): ?>
        <div class="hidden md:flex md:items-center md:ml-6 md:space-x-3">
          <a href="<?php echo e(route('home')); ?>" 
             class="<?php echo \Illuminate\Support\Arr::toCssClasses([
               'nav-link inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 rounded hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-300',
               'active' => request()->routeIs('home')
             ]); ?>">
             Home
          </a>

          <a href="<?php echo e(route('blogs.index')); ?>" 
             class="<?php echo \Illuminate\Support\Arr::toCssClasses([
               'nav-link inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 rounded hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-300',
               'active' => request()->routeIs('blogs.*')
             ]); ?>">
             Blog
          </a>

          <a href="<?php echo e(route('contact.show')); ?>" 
             class="<?php echo \Illuminate\Support\Arr::toCssClasses([
               'nav-link inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 rounded hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-300',
               'active' => request()->routeIs('contact.show')
             ]); ?>">
             Contact
          </a>

          <a href="<?php echo e(route('about')); ?>" class="nav-link inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 rounded hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-300">
             About
          </a>
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
        <a @click="mobile = false" href="<?php echo e(route('home')); ?>" class="block py-2 text-gray-700">Home</a>
        <a @click="mobile = false" href="<?php echo e(route('blogs.index')); ?>" class="block py-2 text-gray-700">Blog</a>
        <a @click="mobile = false" href="<?php echo e(route('contact.show')); ?>" class="block py-2 text-gray-700">Contact</a>
        <a @click="mobile = false" href="#" class="block py-2 text-gray-700">About</a>

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
        closeAll(){ this.mobile = false; }
      }
    }
  </script>
</nav>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>