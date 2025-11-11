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
    
    <aside x-data="{ open: true }" :class="open ? 'w-72' : 'w-16'" class="transition-all duration-200 border-r bg-white">
      <div class="h-screen flex flex-col">
        <div class="flex items-center justify-between p-4">
          <a href="<?php echo e(auth()->check() ? (auth()->user()->isAdmin() ? route('admin.dashboard') : (auth()->user()->isTrainer() ? route('trainer.dashboard') : route('student.dashboard'))) : route('home')); ?>" class="flex items-center gap-2">
            <img src="<?php echo e(asset('img/logo.png')); ?>" class="w-8 h-8" alt="logo">
            <span x-show="open" class="font-bold" style="display:inline-block"><?php echo e(config('app.name')); ?></span>
          </a>
          <button @click="open = !open" class="p-1 rounded hover:bg-gray-100">
            <svg x-show="open" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M6 6l8 4-8 4V6z" /></svg>
            <svg x-show="!open" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" x-cloak><path d="M4 6h12M4 10h12M4 14h12" /></svg>
          </button>
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

        <div class="p-4 border-t bg-white">
          <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500"><?php if(auth()->guard()->check()): ?> <?php echo e(auth()->user()->name); ?> <?php endif; ?></div>
            <div>
              <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('actions.logout', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1570940825-0', $__slots ?? [], get_defined_vars());

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