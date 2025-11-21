<div class="p-4">
  <h2 class="text-2xl font-semibold mb-4">Trainers</h2>

  <?php if($trainers->count()): ?>
    <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="p-2 border rounded mb-2">
        <div class="font-medium"><?php echo e($t->name); ?></div>
        <div class="text-xs text-gray-500"><?php echo e($t->email); ?></div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="mt-4">
      <?php echo e($trainers->links()); ?>

    </div>
  <?php else: ?>
    <p class="text-sm text-gray-500">No trainers found.</p>
  <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/trainers/partials/index.blade.php ENDPATH**/ ?>