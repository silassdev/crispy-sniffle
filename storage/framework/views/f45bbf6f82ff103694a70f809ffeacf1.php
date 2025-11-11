<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?> 
  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


</head>
<body class="bg-gray-50">
  <div id="app" class="min-h-screen flex">
    

    <aside x-data="{ open: true }"
       x-init="() => { 
         document.body.dataset.sidebarOpen = open ? 'true' : 'false'; 
         $watch('open', v => document.body.dataset.sidebarOpen = v ? 'true' : 'false') 
       }"
       :class="open ? 'w-72' : 'w-16'"
       class="transition-all duration-200 border-r bg-white">

  <div class="h-screen flex flex-col">
    
    <div class="flex items-center p-4">
      <a href="<?php echo e(auth()->check() ? (auth()->user()->isAdmin() ? route('admin.dashboard') : (auth()->user()->isTrainer() ? route('trainer.dashboard') : route('student.dashboard'))) : route('home')); ?>" 
         class="flex items-center gap-2">
        <img src="<?php echo e(asset('img/icon.jpg')); ?>" class="w-8 h-8" alt="logo">
      </a>
    </div>

    
    <div class="flex-1 overflow-auto">
      <?php if(auth()->check() && auth()->user()->isAdmin()): ?>
        <?php echo $__env->make('dashboards.partials.sidebar', ['role' => 'admin', 'open' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php elseif(auth()->check() && auth()->user()->isTrainer()): ?>
        <?php echo $__env->make('dashboards.partials.sidebar', ['role' => 'trainer', 'open' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php else: ?>
        <?php echo $__env->make('dashboards.partials.sidebar', ['role' => 'student', 'open' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <?php endif; ?>
    </div>

    <div class="p-4 border-t bg-white space-y-2">
  
  <a href="<?php echo e(route('logout')); ?>" 
     class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h6a2 2 0 012 2v1" />
    </svg>
    <span x-show="open" x-transition>Logout</span>
  </a>

  
  <button @click="open = !open" 
          class="w-full flex items-center justify-center p-2 rounded hover:bg-gray-100">
    <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
    <svg x-show="!open" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
  </button>
</div>
  </div>
</aside>


    
    <main class="flex-1 p-6">
      <div class="max-w-7xl mx-auto">
        <header class="mb-6">
          <h1 class="text-2xl font-semibold"><?php echo $__env->yieldContent('page-title'); ?></h1>
          <?php if (! empty(trim($__env->yieldContent('page-subtitle')))): ?> <p class="text-sm text-gray-500 mt-1"><?php echo $__env->yieldContent('page-subtitle'); ?></p> <?php endif; ?>
        </header>

        <div>
          <?php echo $__env->yieldContent('content'); ?>
        </div>
      </div>
    </main>
  </div>

  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

  <script>
    // keep small helper for toggling sections or livewire events if needed
    window.addEventListener('app-toast', e => {
      const d = e.detail ?? e;
      // implement your toast show logic or use a global toast component
      console.info('TOAST', d);
    });
  </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>