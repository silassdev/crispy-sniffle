

<?php $__env->startSection('content'); ?>
  <div class="p-6">
    <h1 class="text-xl font-semibold">Admins — Index</h1>
    <p>This is a placeholder. Replace with your admin listing UI.</p>

    <?php if(isset($admins) && $admins->count()): ?>
      <ul>
        <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><a href="<?php echo e(route('admin.admins.show', $a->id)); ?>"><?php echo e($a->name); ?> (<?php echo e($a->email); ?>)</a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>

      <?php echo e($admins->links()); ?>

    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/admins/index.blade.php ENDPATH**/ ?>