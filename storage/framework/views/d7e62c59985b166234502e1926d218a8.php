<div id="register-form-root" class="w-full max-w-md mx-auto">
  <div class="bg-white dark:bg-gray-700 rounded-2xl shadow-lg overflow-hidden">
    <!-- top hero -->
    <div class="px-6 py-6 sm:px-8 sm:py-8">
      <div class="flex items-center gap-3">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Create an account</h2>
      </div>
    </div>

    <div class="px-6 pb-6 sm:px-8 sm:pb-8">
      <form wire:submit.prevent="submit" autocomplete="off" novalidate>
        <div class="space-y-4">

          <!-- role selection -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Signing up as</label>

            <!-- displayed current role -->
            <div class="mt-2 text-sm text-gray-700 dark:text-gray-200">
              <strong>selected:</strong>
              <?php echo e($role === 'trainer' ? 'Trainer (requires approval)' : ( $role === 'student' ? 'Student' : ucfirst($role ?? 'student') )); ?>

            </div>

            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-500 mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
          </div>

          <!-- name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
            <input id="name" wire:model.defer="name" required
                   class="mt-1 block w-full rounded-lg border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300"
            />
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-500 mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
          </div>

          <!-- email -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input id="email" wire:model.defer="email" type="email" required
                   class="mt-1 block w-full rounded-lg border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300"
            />
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-500 mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
          </div>

          <!-- password (NO peek eye) -->
          <div class="space-y-4">
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Password
              </label>

              <input
                id="password"
                name="password"
                type="password"
                wire:model.defer="password"
                autocomplete="new-password"
                class="mt-1 block w-full rounded-lg border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300"
              />
              <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-500 mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Confirm password
              </label>

              <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                wire:model.defer="password_confirmation"
                autocomplete="new-password"
                class="mt-1 block w-full rounded-lg border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300"
              />
            </div>
          </div>

          <!-- global errors -->
          <!--[if BLOCK]><![endif]--><?php if($errors->has('registration')): ?>
            <div class="text-sm text-red-600"><?php echo e($errors->first('registration')); ?></div>
          <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

          <!-- primary actions -->
          <div class="grid grid-cols-1 gap-3">
            <button type="submit" wire:loading.attr="disabled"
                    class="w-full inline-flex justify-center items-center gap-2 px-4 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5v14M5 12h14"/>
              </svg>
              <span wire:loading.remove>Register</span>
              <span wire:loading>Submitting…</span>
            </button>

            <div class="flex items-center justify-center gap-3 text-sm text-gray-500 dark:text-gray-300">
              <span class="w-24 h-px bg-gray-200 dark:bg-gray-600 inline-block"></span>
              <span>Or continue with</span>
              <span class="w-24 h-px bg-gray-200 dark:bg-gray-600 inline-block"></span>
            </div>

            <!-- social buttons -->
            <div class="grid grid-cols-2 gap-3">
              <a href="<?php echo e(route('social.redirect', ['provider' => 'google'])); ?>?role=<?php echo e($role); ?>" class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-white/5">
                <!--[if BLOCK]><![endif]--><?php if( view()->exists('components.icons.google') ): ?>
                  <?php echo $__env->make('components.icons.google', ['class' => 'w-5 h-5'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php else: ?>
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><!-- fallback --></svg>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <span class="text-sm text-gray-700 dark:text-gray-200">Google</span>
              </a>

              <a href="<?php echo e(route('social.redirect', ['provider' => 'github'])); ?>?role=<?php echo e($role); ?>" class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-white/5">
                <?php if( view()->exists('components.icons.github') ): ?>
                  <?php echo $__env->make('components.icons.github', ['class' => 'w-5 h-5'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php else: ?>
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><!-- fallback --></svg>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <span class="text-sm text-gray-700 dark:text-gray-200">GitHub</span>
              </a>
            </div>

            <p class="text-center text-xs text-gray-500 dark:text-gray-300">
              Already have an account?
              <a href="<?php echo e(route('login')); ?>" class="text-indigo-600 hover:underline">Sign in</a>
            </p>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/forms/register-form.blade.php ENDPATH**/ ?>