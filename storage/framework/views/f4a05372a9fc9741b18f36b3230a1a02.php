<?php $__env->startSection('title','Register'); ?>

<?php $__env->startSection('content'); ?>
  <div class="py-10">
    <div class="bg-white rounded-lg shadow p-6">
      <div class="text-center mb-4">
        <h1 class="text-2xl font-semibold">Sign in</h1>
        <p class="text-sm text-gray-500">Enter your credentials to continue</p>
      </div>

      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('forms.register-form', ['role' => request()->query('role','student')]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1581762906-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/auth/register.blade.php ENDPATH**/ ?>