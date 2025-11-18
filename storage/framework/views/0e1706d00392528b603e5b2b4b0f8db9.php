

<?php $__env->startSection('content'); ?>
  <div class="flex">
    <?php echo $__env->make('dashboards.partials.sidebar', ['role' => auth()->user()->role ?? 'admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <main class="flex-1 p-6">
      <?php echo $__env->make('admin.trainers.partials.index', ['trainers' => $trainers], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </main>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/trainers/index.blade.php ENDPATH**/ ?>