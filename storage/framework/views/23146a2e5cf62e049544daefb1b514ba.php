

<?php $__env->startSection('dashboard-content'); ?>
    <?php echo $__env->make('admin.certificate.index-fragment', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.shell', ['section' => 'feedback', 'role' => 'admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/certificates/index.blade.php ENDPATH**/ ?>