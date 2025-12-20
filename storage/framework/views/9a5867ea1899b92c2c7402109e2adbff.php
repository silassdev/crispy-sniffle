

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('admin.newsletter.index-fragment', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('dashboards.shell', ['section' => 'newsletter', 'role' => 'admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/newsletter/index.blade.php ENDPATH**/ ?>