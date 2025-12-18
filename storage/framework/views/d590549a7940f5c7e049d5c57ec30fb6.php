

<?php $__env->startSection('content'); ?>
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-semibold">Admin Home</h1>
    <p class="text-sm text-gray-500">Quick links and metrics — this is not the admin dashboard</p>

    <div class="mt-4">
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn">Go to admin dashboard</a>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/home/auth/admin.blade.php ENDPATH**/ ?>