

<?php $__env->startSection('title','Not allowed'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto py-16 px-4">
  <div class="bg-white p-6 rounded shadow text-center">
    <h1 class="text-2xl font-semibold mb-2">Access denied</h1>
    <p class="text-gray-600 mb-4">Your account (role: <?php echo e($userRole); ?>) is not allowed here.</p>
    <p class="text-sm text-gray-500">This page requires: <?php echo e(implode(', ', $requiredRoles)); ?>.</p>
    <div class="mt-6">
      <a href="<?php echo e(route('home')); ?>" class="px-4 py-2 bg-indigo-600 text-white rounded">Return home</a>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/errors/forbidden_role.blade.php ENDPATH**/ ?>