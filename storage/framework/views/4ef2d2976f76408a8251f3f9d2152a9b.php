 
<?php $__env->startSection('content'); ?>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-xl font-semibold mb-4">Pending Assessments</h1>

    
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('student.pending-assessments', ['showAll' => true,'perPage' => 10]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1241820638-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/student/assessments/index.blade.php ENDPATH**/ ?>