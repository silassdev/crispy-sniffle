

<?php $__env->startSection('dashboard-content'); ?>
    <h1 class="text-2xl mb-4">Students</h1>
    <?php echo $__env->make('admin.students.index-fragment', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.shell', ['section' => 'students', 'role' => 'admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/students/index-shell.blade.php ENDPATH**/ ?>