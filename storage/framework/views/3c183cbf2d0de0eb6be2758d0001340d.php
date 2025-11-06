<div id="login-form-root" class="w-full max-w-md mx-auto">
  <div class="bg-white dark:bg-gray-700 rounded-2xl shadow-lg overflow-hidden">
    
    <div class="px-6 py-6 sm:px-8 sm:py-8">
      <div class="flex items-center gap-3">
      </div>
    </div>

    <div class="px-6 pb-6 sm:px-8 sm:pb-8">
      <form wire:submit.prevent="submit" autocomplete="off" novalidate>
        <div class="space-y-4">
          
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input id="email" wire:model.defer="email" type="email" required autofocus
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

          
          <div x-data="{ show: false }" class="relative">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
            <input id="password" 
            name="password"
            wire:model.defer="password"
            autocomplete="new-password"
            class="mt-1 block w-full rounded-lg border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 pr-10"
            @input="(typeof $wire !== 'undefined') ? $wire.set('password', $event.target.value) : null"
            
            />
            <button type="button" x-on:click="show = !show" class="absolute right-2 top-8 text-gray-400 hover:text-gray-600" aria-pressed="false" x-bind:aria-label="show ? 'Hide password' : 'Show password'">
              <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
              <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

          
          <!--[if BLOCK]><![endif]--><?php if($errors->has('credentials')): ?>
            <div class="text-sm text-red-600"><?php echo e($errors->first('credentials')); ?></div>
          <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
          <!--[if BLOCK]><![endif]--><?php if($errors->has('too_many_attempts')): ?>
            <div class="text-sm text-red-600"><?php echo e($errors->first('too_many_attempts')); ?></div>
          <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

          
          <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
              <input type="checkbox" wire:model.defer="remember" class="rounded border-gray-200 dark:border-gray-700 text-indigo-600 focus:ring-indigo-500" />
              Remember me
            </label>

            <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-indigo-600 hover:underline">Forgot password?</a>
          </div>

          
          <div class="grid grid-cols-1 gap-3">
            <button type="submit" wire:loading.attr="disabled"
                    class="w-full inline-flex justify-center items-center gap-2 px-4 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
              <span wire:loading.remove>Sign in</span>
              <span wire:loading>Signing in…</span>
            </button>

            <div class="flex items-center justify-center gap-3 text-sm text-gray-500">
              <span class="w-24 h-px bg-gray-200 inline-block"></span>
              <span>Or continue with</span>
              <span class="w-24 h-px bg-gray-200 inline-block"></span>
            </div>

            
            <div class="grid grid-cols-2 gap-3">
              <a href="<?php echo e(route('social.redirect', ['provider' => 'google'])); ?>?role=<?php echo e($role); ?>" class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg border hover:bg-gray-50 dark:hover:bg-white/5">
                
                <!--[if BLOCK]><![endif]--><?php if( view()->exists('components.icons.google') ): ?>
                  <?php echo $__env->make('components.icons.google', ['class' => 'w-5 h-5'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php else: ?>
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><!-- fallback --></svg>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <span class="text-sm text-gray-700">Google</span>
              </a>

              <a href="<?php echo e(route('social.redirect', ['provider' => 'github'])); ?>?role=<?php echo e($role); ?>" class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg border hover:bg-gray-50 dark:hover:bg-white/5">
                
                <?php if( view()->exists('components.icons.github') ): ?>
                  <?php echo $__env->make('components.icons.github', ['class' => 'w-5 h-5'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php else: ?>
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><!-- fallback --></svg>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <span class="text-sm text-gray-700">GitHub</span>
              </a>
            </div>

            <p class="text-center text-xs text-gray-500">
              Don’t have an account?
              <a href="<?php echo e(route('register', ['role' => 'student'])); ?>" class="text-indigo-600 hover:underline">Create one</a>
            </p>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
  document.addEventListener('livewire:load', function () {
    // small delay to let browser autofill complete
    setTimeout(function () {
      document.querySelectorAll('#login-form-root input').forEach(function (el) {
        if (el.value) {
          // dispatch input event so Livewire picks up autofill values
          el.dispatchEvent(new Event('input', { bubbles: true }));
        }
      });
    }, 140); 
  });
</script>

</div><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/forms/login-form.blade.php ENDPATH**/ ?>