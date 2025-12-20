

<?php
  $role = $role ?? (auth()->user()->role ?? 'student');
  $section = $section ?? 'dashboard';
?>

<?php $__env->startSection('content'); ?>
  <div class="flex min-h-screen">
    
    <aside class="w-64 flex-shrink-0 sticky top-0 h-screen overflow-y-auto bg-white border-r border-gray-200">
      
      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('sidebar', ['role' => $role,'activeSection' => $section]);

$__html = app('livewire')->mount($__name, $__params, 'lw-3631665400-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </aside>

    
    <main id="role-content" class="flex-1 overflow-y-auto">
      <div class="p-6">
        <?php if(View::exists("livewire.{$role}.{$section}")): ?>
          <livewire:<?php echo e($role); ?>.<?php echo e($section); ?> />
        <?php elseif(View::exists("dashboards.partials.sections.{$role}.{$section}")): ?>
          <?php echo $__env->make("dashboards.partials.sections.{$role}.{$section}", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php elseif(View::exists("dashboards.partials.sections.{$section}")): ?>
          <?php echo $__env->make("dashboards.partials.sections.{$section}", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php else: ?>
          <div class="p-4 border rounded">
            <h2 class="text-xl font-semibold">No section found</h2>
            <p class="text-sm text-gray-500">Section: <?php echo e($section); ?> (role: <?php echo e($role); ?>)</p>
          </div>
        <?php endif; ?>
      </div>
    </main>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/shell.blade.php ENDPATH**/ ?>