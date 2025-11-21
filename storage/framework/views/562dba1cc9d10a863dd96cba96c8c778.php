

<?php $__env->startSection('content'); ?>
  <div class="max-w-6xl mx-auto p-6">
    
    <div class="mb-6">
      <h1 class="text-2xl font-semibold">Welcome back, <?php echo e($user->name); ?></h1>
      <p class="text-sm text-gray-500">Explore courses, posts and the community.</p>
    </div>

    
    <div class="grid md:grid-cols-3 gap-6">
      <div class="md:col-span-2">
        <?php echo $__env->make('partials.feed', ['posts' => $posts ?? null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> 
      </div>
      <aside>
        <?php echo $__env->make('partials.suggested-courses', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </aside>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/home/auth/user.blade.php ENDPATH**/ ?>