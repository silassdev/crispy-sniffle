

<?php $__env->startSection('title', 'Application recieved'); ?>

<?php $__env->startSection('content'); ?>
  <div class="max-w-3xl mx-auto py-16 px-4">
  <div class="bg-white rounded shadow p-6 text-center">
   <h1 class="text-2xl font-semibold mb-3">Application recieved</h1>

 <?php if(session('trainer_email')): ?>
    <p class="text-gray-700">Thanks - your application for trainer account was receive for<strong><?php echo e(session('trainer_email')); ?></strong>.</p>

    <?php else: ?>

    <p class="mt-4 text-sm text-gray-500">Thanks - your trainer application was recieved. We'll notify you when its reviewed.</p>
 <?php endif; ?>

    <p class="mt-4 text-sm text-ray-500">An administrator will review your profile and approve if everything looks good. This may take a short while.</p>
      <div class="mt-6 flex justify-center gap-3">
      <a href="<?php echo e(route('login')); ?>" class='px-4 py-2 border rounded">Back to login</a>
      <a href="<?php echo e(route('home')); ?>" class='px-4 py-2 bg-indigo-600 text-white rounded">Go to Home</a>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/trainer/pending.blade.php ENDPATH**/ ?>