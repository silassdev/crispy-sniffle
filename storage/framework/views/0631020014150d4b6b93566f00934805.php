


<?php $__env->startSection('content'); ?>
  <div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-3">
      <img src="/assets/logo.svg" alt="App" class="w-8 h-8"/>
      <h1 class="text-xl font-semibold">Jobs</h1>
    </div>


  </div>

  
  <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.job-manager', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1094338760-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  
  <script src="<?php echo e(asset('js/notifications.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('dashboards.shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/jobs/index.blade.php ENDPATH**/ ?>