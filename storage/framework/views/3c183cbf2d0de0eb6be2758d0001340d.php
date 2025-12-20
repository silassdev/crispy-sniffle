<div id="login-modal-root"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
     role="dialog"
     aria-modal="true">

  <div class="relative w-full max-w-4xl mx-4 rounded-2xl overflow-hidden shadow-2xl bg-white dark:bg-gray-900 grid grid-cols-1 md:grid-cols-2">
    <!-- Left hero (desktop only) -->
    <div class="hidden md:flex flex-col justify-center gap-6 p-10 bg-gradient-to-br from-indigo-600 to-purple-600 text-white">
      <div class="flex items-center gap-3">
        <img src="<?php echo e(asset('img/igniscode.svg')); ?>" alt="Logo" class="w-12 h-12">
        <div>
          <h3 class="text-xl font-semibold">Welcome back</h3>
          <p class="text-sm opacity-90">Sign in to continue to your dashboard</p>
        </div>
      </div>

      <div class="mt-4 text-sm leading-relaxed opacity-45">
        <p>Secure access, fast sign in, and social login options.</p>
      </div>

      <div class="mt-auto">
        <div class="w-full h-36 rounded-lg bg-white/10 flex items-center justify-center text-white/80">
          <span class="text-sm">Illustration or marketing message</span>
        </div>
      </div>
    </div>

    <!-- Right form -->
    <div class="p-6 sm:p-10">
      <button type="button"
              id="login-modal-close"
              class="absolute right-4 top-4 md:top-6 text-gray-500 hover:text-gray-700 dark:text-gray-300"
              aria-label="Close"
              onclick="document.getElementById('login-modal-root').remove(); window.location.href = '/';">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>

      <form wire:submit.prevent="submit" method="POST" id="login-form" novalidate>
        <?php echo csrf_field(); ?>
        <div class="space-y-4">
          <!-- email -->
        <div>
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
        <input
              id="email"
              name="email"
              type="email"
              wire:model.defer="email"
              required
              autofocus
              @keydown.enter.prevent="$wire.call('focusPassword')"
              class="mt-1 block w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
              placeholder="you@example.com"
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
        <div class="relative">
  <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>

  <input
    id="password"
    name="password"
    type="password"
    wire:model.defer="password"
    autocomplete="current-password"
    class="mt-1 block w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 px-4 py-3 pr-12 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
    placeholder="••••••••"
  />

  <button
    type="button"
    id="toggle-password"
    class="absolute right-3 top-1/2 -translate-y-1/2 p-1 rounded text-gray-500 hover:text-gray-700 focus:outline-none"
    aria-label="Show password"
  >
    <svg id="icon-show" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
      <!-- eye icon path here -->
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


          <!-- options -->
          <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
              <input type="checkbox" name="remember" wire:model.defer="remember" class="rounded border-gray-200 dark:border-gray-700 text-indigo-600 focus:ring-indigo-500" />
              Remember me
            </label>

            <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-indigo-600 hover:underline">Forgot password?</a>
          </div>

          <!-- actions -->
          <div class="grid grid-cols-1 gap-3">
            <button
              type="submit"
              id="submit-button"
              wire:loading.attr="disabled"
              class="w-full inline-flex justify-center items-center gap-2 px-4 py-3 bg-indigo-600 text-white rounded-xl shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            >
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
              <span wire:loading.remove>Sign in</span>
              <span wire:loading>Signing in…</span>
            </button>

            <div class="flex items-center justify-center gap-3 text-sm text-gray-500">
              <span class="w-20 h-px bg-gray-200 inline-block"></span>
              <span>Or continue with</span>
              <span class="w-20 h-px bg-gray-200 inline-block"></span>
            </div>

            <!-- social buttons -->
            <div class="grid grid-cols-2 gap-3">
              <a href="<?php echo e(route('social.redirect', ['provider' => 'google'])); ?>?role=<?php echo e($role); ?>" class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg border bg-white hover:bg-gray-50 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php if( view()->exists('components.icons.google') ): ?>
                  <?php echo $__env->make('components.icons.google', ['class' => 'w-5 h-5'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php else: ?>
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"></svg>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <span class="text-sm text-gray-700">Google</span>
              </a>

              <a href="<?php echo e(route('social.redirect', ['provider' => 'github'])); ?>?role=<?php echo e($role); ?>" class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg border bg-gray-800 hover:bg-gray-900 text-white shadow-sm">
                <?php if( view()->exists('components.icons.github') ): ?>
                  <?php echo $__env->make('components.icons.github', ['class' => 'w-5 h-5'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php else: ?>
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"></svg>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <span class="text-sm">GitHub</span>
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
</div>



<!--[if BLOCK]><![endif]--><?php if($toast): ?>
  <?php
    // Ensure safe JS values
    $title = addslashes($toast['title'] ?? '');
    $message = addslashes($toast['message'] ?? '');
    $ttl = (int) ($toast['ttl'] ?? 5000);
    $type = addslashes($toast['type'] ?? 'info');
    $event = $toast['event'] ?? null;
  ?>

  <script>
    (function(){
      try {
        // If this is a toast payload, call APP_TOAST
        <!--[if BLOCK]><![endif]--><?php if(isset($toast['title']) || isset($toast['message'])): ?>
          if (window.APP_TOAST && typeof window.APP_TOAST.push === 'function') {
            window.APP_TOAST.push("<?php echo e($title); ?>", "<?php echo e($message); ?>", "<?php echo e($type); ?>", <?php echo e($ttl); ?>);
          } else {
            console.log('TOAST (fallback):', "<?php echo e($title); ?>", "<?php echo e($message); ?>", "<?php echo e($type); ?>", <?php echo e($ttl); ?>);
          }
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        // If the fallback requested a focus-password event, handle it here
        <!--[if BLOCK]><![endif]--><?php if($event === 'focus-password'): ?>
          const pwd = document.getElementById('password');
          if (pwd) pwd.focus();
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      } catch (err) {
        console.warn('Fallback toast handler error', err);
      }
    })();
  </script>
<?php endif; ?><!--[if ENDBLOCK]><![endif]--><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/forms/login-form.blade.php ENDPATH**/ ?>