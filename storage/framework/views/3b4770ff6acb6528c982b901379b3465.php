


<?php $__env->startSection('content'); ?>
<div class="flex">

 <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('sidebar', ['role' => auth()->user()->role]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1978895029-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

 <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.dashboard-shell', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1978895029-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

 </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>