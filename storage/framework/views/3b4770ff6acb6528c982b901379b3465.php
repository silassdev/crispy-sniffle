

<?php $__env->startSection('content'); ?>
<div class="flex min-h-screen">
  
  <aside class="w-64 flex-shrink-0 sticky top-0 h-screen overflow-y-auto bg-white border-r border-gray-200">
    <?php echo $__env->make('dashboards.partials.sidebar', ['role' => auth()->user()->role ?? 'admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </aside>

  
  <main class="flex-1 overflow-y-auto relative">
    <div id="ajax-loader" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/30">
      <div class="loader-donut"></div>
    </div>

    <div id="admin-content" class="p-6">
      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.overview', ['wire:init' => 'loadCounters','wire:poll.visible.60s' => 'loadCounters']);

$__html = app('livewire')->mount($__name, $__params, 'lw-1978895029-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
  </main>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>