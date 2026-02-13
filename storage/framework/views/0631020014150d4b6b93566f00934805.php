

<?php $__env->startSection('dashboard-content'); ?>
  <?php echo $__env->make('admin.jobs.index-fragment', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('js/notifications.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('dashboards.shell', ['section' => 'jobs', 'role' => 'admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/jobs/index.blade.php ENDPATH**/ ?>