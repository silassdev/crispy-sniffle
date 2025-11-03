<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title><?php echo $__env->yieldContent('title','Welcome'); ?> - <?php echo e(config('app.name')); ?></title>

  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
  
  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="min-h-screen bg-gray-50">

  
  <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main class="py-12">
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/guest.blade.php ENDPATH**/ ?>