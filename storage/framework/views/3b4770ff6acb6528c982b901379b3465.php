

<?php $__env->startSection('content'); ?>
<div class="flex">
  <?php echo $__env->make('dashboards.partials.sidebar', ['role' => auth()->user()->role ?? 'admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main class="flex-1 p-6 relative">
    
    <div id="ajax-loader" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/30">
      <div class="loader-donut"></div>
    </div>

    <div id="admin-content">
      <?php if ($__env->exists('admin.overview')) echo $__env->make('admin.overview', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
  </main>
</div>

<script>
  window.ADMIN_ROUTES = window.ADMIN_ROUTES || {};
  window.ADMIN_ROUTES.counters = "<?php echo e(route('admin.counters')); ?>";
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>