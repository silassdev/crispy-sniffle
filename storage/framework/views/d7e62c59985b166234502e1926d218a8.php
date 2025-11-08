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

          <!-- password + show toggle -->
          <div x-data="{ show: false, showConfirm: false }" class="space-y-4">

  <!-- Password -->
  <div class="relative">
    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
      Password
    </label>

    <input
      id="password"
      name="password"
      :type="show ? 'text' : 'password'"
      wire:model.defer="password"
      autocomplete="new-password"
      class="mt-1 block w-full rounded-lg border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 pr-10"
    />

    <button
      type="button"
      x-on:click="show = !show"
      class="absolute right-2 top-8 text-gray-400 hover:text-gray-600"
      :aria-pressed="show.toString()"
      x-bind:aria-label="show ? 'Hide password' : 'Show password'"
    >
      <!-- Eye (visible) -->
      <svg x-show="!show" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
      </svg>

      <!-- Eye-off (hidden) -->
      <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3l18 18"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.88 9.88A3 3 0 0114.12 14.12"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c1.17 0 2.295.247 3.327.687"/>
      </svg>
    </button>

    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-500 mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
  </div>

  <!-- Confirm password -->
  <div class="relative">
    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
      Confirm password
    </label>

    <input
      id="password_confirmation"
      name="password_confirmation"
      :type="showConfirm ? 'text' : 'password'"
      wire:model.defer="password_confirmation"
      autocomplete="new-password"
      class="mt-1 block w-full rounded-lg border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 pr-10"
    />

    <button
      type="button"
      x-on:click="showConfirm = !showConfirm"
      class="absolute right-2 top-8 text-gray-400 hover:text-gray-600"
      :aria-pressed="showConfirm.toString()"
      x-bind:aria-label="showConfirm ? 'Hide confirm password' : 'Show confirm password'"
    >
      <!-- Eye (visible) -->
      <svg x-show="!showConfirm" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
      </svg>

      <!-- Eye-off (hidden) -->
      <svg x-show="showConfirm" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3l18 18"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.88 9.88A3 3 0 0114.12 14.12"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c1.17 0 2.295.247 3.327.687"/>
      </svg>
    </button>
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