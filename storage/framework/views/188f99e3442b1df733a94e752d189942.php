<!doctype html>
<html lang="<?php echo e(str_replace('_','-',app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title><?php echo $__env->yieldContent('title','Welcome'); ?> - <?php echo e(config('app.name')); ?></title>

  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

  <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">
<?php if(session('success') || session('error')): ?>
   <script>
         document.addEventListener('DOMContentLoaded', function () {
    <?php if(session('success')): ?> window.dispatchEvent(newCustomEvent('app-toast', {
     detail: { 
     title: 'Success', 
     message: <?php echo json_encode(session('success')); ?>, 
     ttl:6000 }
    }
    }));
   <?php endif; ?>
   
<?php if(session('error')): ?> window.dispatchEvent(newCustomEvent('app-toast', {
    detail: {
    title: 'Error', 
    message: <?php echo json_encode(session('success')); ?>, 
       ttl:8000 }
       }
    }));
  <?php endif; ?>
  });
  </script>
<?php endif; ?>

  <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main id="main" class="pt-20 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4">
      <?php echo $__env->yieldContent('content'); ?>
    </div>
  </main>

  <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/guest.blade.php ENDPATH**/ ?>