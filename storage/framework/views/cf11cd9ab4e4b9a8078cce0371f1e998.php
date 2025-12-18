

<?php $__env->startSection('content'); ?>
  <div class="p-6">
    <h1 class="text-2xl mb-4">Students</h1>
    <?php echo $__env->make('admin.admins.index-fragment', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/admins/index-shell.blade.php ENDPATH**/ ?>