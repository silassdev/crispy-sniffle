

<?php $__env->startSection('title','Reset password'); ?>

<?php $__env->startSection('content'); ?>
  <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Reset your password</h2>

    <?php if($errors->any()): ?>
      <div class="mb-4 text-red-600"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <form id ="paassword-request-form"method="POST" action="<?php echo e(route('password.email')); ?>">
      <?php echo csrf_field(); ?>
      <label class="block text-sm mb-1">Email</label>
      <input name="email" value="<?php echo e(old('email')); ?>" required type="email" placeholder="you@examplle.com" class="w-full border p-2 rounded mb-4" />
      <button class="px-4 py-2 bg-slate-900 text-white rounded">Send reset link</button>
    </form>
  </div>

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>