

<?php $__env->startSection('title', 'Notifications'); ?>

<?php $__env->startSection('content'); ?>
  <div class="fixed inset-0 bg-gray-50 flex flex-col">
    
    <header class="bg-white border-b px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <a href="<?php echo e(url()->previous()); ?>" class="text-gray-500 hover:text-gray-700">← Back</a>
        <h1 class="text-xl font-semibold">Notifications</h1>
        <div class="text-sm text-gray-500 ml-3">Manage all your notifications here</div>
      </div>

      <div class="flex items-center gap-3">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm text-indigo-600">Dashboard</a>
      </div>
    </header>

    
    <main class="flex-1 overflow-auto p-6">
      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('notifications.notifications-page', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1736899624-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </main>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/notifications/index.blade.php ENDPATH**/ ?>