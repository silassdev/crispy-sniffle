


<?php
  $role = $role ?? (auth()->user()->role ?? 'student');
  $section = $section ?? 'overview';
?>

<?php $__env->startSection('content'); ?>
  <div class="flex min-h-[80vh]">
    
    <?php echo $__env->make('dashboards.partials.sidebar', ['role' => $role, 'activeSection' => $section], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main id="role-content" class="flex-1 p-6">
      
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
    </main>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/shell.blade.php ENDPATH**/ ?>