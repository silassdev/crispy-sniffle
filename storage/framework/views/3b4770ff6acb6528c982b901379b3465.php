

<?php $__env->startSection('title','Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
  <h1 class="text-2xl font-bold mb-4">Admin dashboard</h1>

  <div class="space-y-4">
    <div>
      <h3 class="font-semibold">Invite new admin</h3>
      
      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.invite-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1978895029-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>

    <div>
      <h3 class="font-semibold">Site stats</h3>
      <p class="text-sm text-gray-600">(Add charts / links here)</p>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>