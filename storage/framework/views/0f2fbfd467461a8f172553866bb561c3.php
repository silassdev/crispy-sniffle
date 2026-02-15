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

    /* Premium Icon Nav Styles */
    .icon-nav-item {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 2.5rem;
      min-width: 2.5rem;
      border-radius: 0.75rem;
      color: #64748b; /* slate-500 */
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      background: transparent;
    }
    .icon-nav-item:hover {
      background-color: #f1f5f9; /* slate-100 */
      color: #4f46e5; /* indigo-600 */
      padding-left: 0.75rem;
      padding-right: 1rem;
    }
    .icon-label {
      max-width: 0;
      overflow: hidden;
      white-space: nowrap;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      font-size: 0.8125rem;
      font-weight: 600;
      opacity: 0;
      margin-left: 0;
    }
    .icon-nav-item:hover .icon-label {
      max-width: 8rem;
      margin-left: 0.625rem;
      opacity: 1;
    }
    .icon-nav-item svg {
      flex-shrink: 0;
      width: 1.25rem;
      height: 1.25rem;
    }
  </style>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center nav-left-gap">
        <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3">
          <img src="<?php echo e(asset('img/igniscode.png')); ?>" alt="Logo" class="w-10 h-10 object-contain">
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
          <div class="hidden md:flex md:items-center md:gap-2">
            
            <a href="<?php echo e(route($dashboardRoute)); ?>" class="icon-nav-item" title="Dashboard">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
              </svg>
              <span class="icon-label">Dashboard</span>
            </a>

            
            <div class="relative">
               <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('notifications.notification-bell', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1679130785-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </div>

            
            <a href="<?php echo e(route('profile.index')); ?>" class="icon-nav-item" title="Profile">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              <span class="icon-label">Profile</span>
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
        <a @click="mobile = false" href="<?php echo e(route('about')); ?>" class="block py-2 text-gray-700">About</a>

        <div class="pt-3 border-t">
          <a href="<?php echo e(route('login')); ?>" class="block py-2">Login</a>
          <a href="<?php echo e(route('register')); ?>" class="block py-2">Sign up</a>
        </div>
      <?php else: ?>
        <a @click="mobile = false" href="<?php echo e(route($dashboardRoute)); ?>" class="block py-2 text-gray-700 font-medium tracking-tight">Dashboard</a>
        <a @click="mobile = false" href="<?php echo e(route('notifications.index')); ?>" class="block py-2 text-gray-700 font-medium tracking-tight">Notifications</a>
        <a @click="mobile = false" href="<?php echo e(route('profile.index')); ?>" class="block py-2 text-gray-700 font-medium tracking-tight">Profile</a>
        
        <div class="pt-3 border-t">
          <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('actions.logout', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1679130785-2', $__slots ?? [], get_defined_vars());

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
        notificationsOpen: false,
        closeAll(){ 
          this.mobile = false; 
          this.notificationsOpen = false;
        }
      }
    }
  </script>

  
  <div x-show="notificationsOpen" 
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       class="fixed inset-0 z-[100] flex items-end sm:items-center justify-center p-0 sm:p-4 bg-slate-900/60 backdrop-blur-sm"
       x-cloak
       @click.self="notificationsOpen = false"
       @keydown.escape.window="notificationsOpen = false">
    
    
    <div x-show="notificationsOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-full sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-full sm:translate-y-0 sm:scale-95"
         class="relative w-full max-w-2xl h-[90vh] sm:h-auto sm:max-h-[85vh] bg-white sm:rounded-2xl shadow-2xl flex flex-col overflow-hidden">
      
      
      <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-white sticky top-0 z-10">
        <div class="flex items-center gap-3">
          <div class="bg-indigo-50 p-2 rounded-xl text-indigo-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-bold text-slate-900 leading-tight">Notifications</h3>
            <p class="text-xs text-slate-500 font-medium">Keep track of your latest updates</p>
          </div>
        </div>
        
        <button @click="notificationsOpen = false" class="p-2 rounded-xl hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      
      <div class="flex-1 overflow-y-auto bg-slate-50/30 custom-scrollbar p-6">
        <?php if(auth()->guard()->check()): ?>
          <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('notifications.notifications-page', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1679130785-3', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <style>
    /* Custom scrollbar for better aesthetics */
    .custom-scrollbar::-webkit-scrollbar {
      width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
      background: #f8fafc;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: #e2e8f0;
      border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: #cbd5e1;
    }
  </style>
</nav>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>