

<?php $__env->startSection('dashboard-content'); ?>
    <h1 class="text-2xl mb-4">Trainers</h1>
    <?php echo $__env->make('admin.trainers.index-fragment', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.shell', ['section' => 'trainers', 'role' => 'admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/trainers/index-shell.blade.php ENDPATH**/ ?>