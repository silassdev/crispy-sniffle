

<?php $__env->startSection('title','Student dashboard'); ?>

<?php $__env->startSection('content'); ?>
  <div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-semibold">Student dashboard</h1>
    <p class="mt-3">Welcome, <?php echo e(auth()->user()->name ?? 'Student'); ?>.</p>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/student.blade.php ENDPATH**/ ?>