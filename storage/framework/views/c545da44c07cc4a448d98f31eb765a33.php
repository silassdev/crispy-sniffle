<?php $__env->startSection('title','Login'); ?>

<?php $__env->startSection('content'); ?>
  <div class="py-8">
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('forms.login-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1876769108-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/auth/login.blade.php ENDPATH**/ ?>