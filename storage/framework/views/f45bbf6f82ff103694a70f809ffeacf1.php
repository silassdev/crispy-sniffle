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
        <img src="<?php echo e(asset('img/igniscode.svg')); ?>" class="w-8 h-8" alt="logo">
      </a>
    </div>

  <div class="flex-1 overflow-auto">
  <?php
    $role = auth()->check() && method_exists(auth()->user(), 'isAdmin') && auth()->user()->isAdmin()
        ? 'admin'
        : (auth()->check() && method_exists(auth()->user(), 'isTrainer') && auth()->user()->isTrainer() ? 'trainer' : 'student');
  ?>

  <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('sidebar', ['role' => $role]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1570940825-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</div>

    <div class="p-4 border-t bg-white space-y-2">



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

</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>