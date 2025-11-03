
<div id="login-form-root" class="max-w-md mx-auto p-6 bg-white rounded shadow">
  <h2 class="text-xl font-semibold mb-4">Login</h2>

  <form wire:submit.prevent="submit" autocomplete="off" novalidate>
    <div class="mb-3">
      <label class="block text-sm font-medium">Email</label>
      <input wire:model.defer="email" type="email" class="mt-1 block w-full rounded border-gray-200" required>
      <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-500 mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">Password</label>
      <input wire:model.defer="password" type="password" class="mt-1 block w-full rounded border-gray-200" required>
      <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-500 mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <!--[if BLOCK]><![endif]--><?php if($errors->has('credentials')): ?>
      <div class="text-sm text-red-600 mb-3"><?php echo e($errors->first('credentials')); ?></div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <!--[if BLOCK]><![endif]--><?php if($errors->has('too_many_attempts')): ?>
      <div class="text-sm text-red-600 mb-3"><?php echo e($errors->first('too_many_attempts')); ?></div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="flex items-center justify-between gap-3">
      <button type="submit" wire:loading.attr="disabled" class="px-4 py-2 bg-indigo-600 text-white rounded">
        <span wire:loading.remove>Login</span>
        <span wire:loading>Logging in…</span>
      </button>

      <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-gray-600">Forgot password?</a>
    </div>

    <div class="mt-4 text-sm text-gray-500">
      Or login with:
      <div class="flex gap-2 mt-2">
        <a href="<?php echo e(route('social.redirect', ['provider' => 'google'])); ?>?role=<?php echo e($role); ?>" class="px-3 py-2 border rounded">Google</a>
        <a href="<?php echo e(route('social.redirect', ['provider' => 'github'])); ?>?role=<?php echo e($role); ?>" class="px-3 py-2 border rounded">GitHub</a>
      </div>
    </div>
  </form>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/forms/login-form.blade.php ENDPATH**/ ?>