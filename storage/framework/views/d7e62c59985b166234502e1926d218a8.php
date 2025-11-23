<!-- Register modal with blurred background (Livewire + vanilla JS version) -->
<div id="register-modal-root"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-md"
     role="dialog"
     aria-modal="true"
     style="-webkit-backdrop-filter: blur(8px); backdrop-filter: blur(8px);">

  <!-- Card -->
  <div class="relative w-full max-w-4xl mx-4 rounded-2xl overflow-hidden shadow-2xl bg-white/90 dark:bg-gray-900/80 grid grid-cols-1 md:grid-cols-2">
    <!-- Left hero (desktop) -->
    <div class="hidden md:flex flex-col justify-center gap-6 p-10 bg-gradient-to-br from-indigo-600 to-purple-600 text-white">
      <div class="flex items-center gap-3">
        <img src="<?php echo e(asset('img/igniscode.svg')); ?>" alt="Logo" class="w-12 h-12">
        <div>
          <h3 class="text-xl font-semibold">Create your account</h3>
          <p class="text-sm opacity-90">Join now and get access to your dashboard</p>
        </div>
      </div>

      <div class="mt-4 text-sm leading-relaxed opacity-95">
        <p>Secure sign up, social login, and role-based onboarding.</p>
      </div>

      <div class="mt-auto">
        <div class="w-full h-36 rounded-lg bg-white/10 flex items-center justify-center text-white/80">
          <span class="text-sm">Welcome aboard</span>
        </div>
      </div>
    </div>

    <!-- Right form -->
    <div class="p-6 sm:p-10">
      <!-- Close button (now plain HTML; JS will handle) -->
      <button type="button"
              id="register-modal-close"
              class="absolute right-4 top-4 md:top-6 text-gray-500 hover:text-gray-700 dark:text-gray-300"
              aria-label="Close">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <form wire:submit.prevent="submit" id="register-form" autocomplete="off" novalidate>
        <?php echo csrf_field(); ?>
        <div class="space-y-4">
          <!-- role display -->
          <div>
            <div class="mt-2 text-sm text-gray-700 dark:text-gray-200">
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
            <input
              id="name"
              name="name"
              wire:model.defer="name"
              required
              class="mt-1 block w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
              placeholder="Your full name"
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
            <input
              id="email"
              name="email"
              type="email"
              wire:model.defer="email"
              required
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

          <!-- password and confirmation -->
          <div class="space-y-4">
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
              <div class="relative">
                <input
                  id="password"
                  name="password"
                  type="password"
                  wire:model.defer="password"
                  autocomplete="new-password"
                  class="mt-1 block w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition pr-12"
                  placeholder="Create a strong password"
                />
                <button type="button" id="register-toggle-password" class="absolute right-3 top-1/2 -translate-y-1/2 p-1 rounded text-gray-500 hover:text-gray-700 focus:outline-none" aria-label="Show password">
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><!-- eye icon --></svg>
                </button>
              </div>
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
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm password</label>
              <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                wire:model.defer="password_confirmation"
                autocomplete="new-password"
                class="mt-1 block w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
                placeholder="Repeat your password"
              />
            </div>
          </div>

          <!-- global errors -->
          <!--[if BLOCK]><![endif]--><?php if($errors->has('registration')): ?>
            <div class="text-sm text-red-600"><?php echo e($errors->first('registration')); ?></div>
          <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

          <!-- primary actions -->
          <div class="grid grid-cols-1 gap-3">
            <button
              type="submit"
              id="register-submit"
              wire:loading.attr="disabled"
              class="w-full inline-flex justify-center items-center gap-2 px-4 py-3 bg-indigo-600 text-white rounded-xl shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            >
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5v14M5 12h14"/></svg>
              <span wire:loading.remove>Register</span>
              <span wire:loading>Submitting…</span>
            </button>

            <div class="flex items-center justify-center gap-3 text-sm text-gray-500 dark:text-gray-300">
              <span class="w-20 h-px bg-gray-200 dark:bg-gray-600 inline-block"></span>
              <span>Or continue with</span>
              <span class="w-20 h-px bg-gray-200 dark:bg-gray-600 inline-block"></span>
            </div>

            <!-- social buttons -->
            <div class="grid grid-cols-2 gap-3">
              <a href="<?php echo e(route('social.redirect', ['provider' => 'google'])); ?>?role=<?php echo e($role); ?>" class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white hover:bg-gray-50 shadow-sm">
                <!--[if BLOCK]><![endif]--><?php if( view()->exists('components.icons.google') ): ?>
                  <?php echo $__env->make('components.icons.google', ['class' => 'w-5 h-5'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php else: ?>
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"></svg>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <span class="text-sm text-gray-700 dark:text-gray-200">Google</span>
              </a>

              <a href="<?php echo e(route('social.redirect', ['provider' => 'github'])); ?>?role=<?php echo e($role); ?>" class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white hover:bg-gray-50 shadow-sm">
                <?php if( view()->exists('components.icons.github') ): ?>
                  <?php echo $__env->make('components.icons.github', ['class' => 'w-5 h-5'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php else: ?>
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"></svg>
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


<!--[if BLOCK]><![endif]--><?php if($toast): ?>
  <?php
    $title = addslashes($toast['title'] ?? '');
    $message = addslashes($toast['message'] ?? '');
    $ttl = (int) ($toast['ttl'] ?? 5000);
    $type = addslashes($toast['type'] ?? 'info');
  ?>

  <script>
    (function(){
      try {
        if (window.APP_TOAST && typeof window.APP_TOAST.push === 'function') {
          window.APP_TOAST.push("<?php echo e($title); ?>", "<?php echo e($message); ?>", "<?php echo e($type); ?>", <?php echo e($ttl); ?>);
        } else {
          console.log('TOAST (fallback):', "<?php echo e($title); ?>", "<?php echo e($message); ?>", "<?php echo e($type); ?>", <?php echo e($ttl); ?>);
        }
      } catch (err) {
        console.warn('Fallback toast handler error', err);
      }
    })();
  </script>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->

<!-- Small vanilla JS: validation, delegated handlers, re-attach hooks -->
<script>
(function () {
  // Delegated click handler for modal controls (works after Livewire DOM updates)
  function delegatedClickHandler(e) {
    const closeBtn = e.target.closest && e.target.closest('#register-modal-close');
    if (closeBtn) {
      const root = document.getElementById('register-modal-root');
      if (root) root.remove();
      return;
    }

    const toggle = e.target.closest && e.target.closest('#register-toggle-password');
    if (toggle) {
      const pwd = document.getElementById('password');
      if (pwd) {
        const isPwd = pwd.getAttribute('type') === 'password';
        pwd.setAttribute('type', isPwd ? 'text' : 'password');
        toggle.setAttribute('aria-pressed', isPwd ? 'true' : 'false');
      }
    }
  }

  // Attach handlers once
  function attachHandlers() {
    if (!window.__register_handlers_attached) {
      document.addEventListener('click', delegatedClickHandler);
      // keydown: Escape to close
      document.addEventListener('keydown', function(e){
        if (e.key === 'Escape') {
          const root = document.getElementById('register-modal-root');
          if (root) root.remove();
        }
      });

      // Form-level client validation
      const form = document.getElementById('register-form');
      if (form) {
        form.addEventListener('submit', function(e){
          // simple client validation to improve UX (server still validates)
          const name = (document.getElementById('name')?.value || '').trim();
          const email = (document.getElementById('email')?.value || '').trim();
          const password = (document.getElementById('password')?.value || '').trim();
          const passwordConfirmation = (document.getElementById('password_confirmation')?.value || '').trim();

          const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

          if (!name) {
            e.preventDefault();
            focusWithRing(document.getElementById('name'));
            return false;
          }
          if (!email || !emailValid) {
            e.preventDefault();
            focusWithRing(document.getElementById('email'));
            return false;
          }
          if (password.length < 8) {
            e.preventDefault();
            focusWithRing(document.getElementById('password'));
            return false;
          }
          if (password !== passwordConfirmation) {
            e.preventDefault();
            focusWithRing(document.getElementById('password_confirmation'));
            return false;
          }
          // let Livewire handle the submit
        });

        // Enter key helpers: move focus between inputs
        document.getElementById('email')?.addEventListener('keydown', function(e){
          if (e.key === 'Enter') { e.preventDefault(); document.getElementById('password')?.focus(); }
        });
        document.getElementById('password')?.addEventListener('keydown', function(e){
          if (e.key === 'Enter') { e.preventDefault(); document.getElementById('password_confirmation')?.focus(); }
        });
        document.getElementById('password_confirmation')?.addEventListener('keydown', function(e){
          if (e.key === 'Enter') { e.preventDefault(); document.getElementById('register-submit')?.click(); }
        });
      }

      window.__register_handlers_attached = true;
    }
  }

  function focusWithRing(el) {
    if(!el) return;
    el.focus();
    el.classList.add('ring-2','ring-red-300');
    setTimeout(()=> el.classList.remove('ring-2','ring-red-300'), 900);
  }

  attachHandlers();

  // Re-attach after Livewire updates (works with Livewire.hook if available)
  if (window.Livewire && typeof Livewire.hook === 'function') {
    Livewire.hook('message.processed', () => attachHandlers());
  } else if (window.Livewire && typeof Livewire.on === 'function') {
    Livewire.on('message.processed', () => attachHandlers());
  } else {
    // fallback attempts
    setTimeout(() => attachHandlers(), 300);
    setTimeout(() => attachHandlers(), 1000);
  }

  // If Livewire supports emitting app-toast, attach listener (preferred)
  (function attachLivewireToastListener(retries = 0) {
    if (window.Livewire && typeof Livewire.on === 'function') {
      Livewire.on('app-toast', (payload) => {
        const { title = '', message = '', ttl = 5000, type = 'info' } = payload || {};
        if (window.APP_TOAST && typeof window.APP_TOAST.push === 'function') {
          window.APP_TOAST.push(title, message, type, ttl);
        } else {
          console.log('TOAST', title, message, type, ttl);
        }
      });

      // Also focus-password if used
      Livewire.on('focus-password', () => {
        const pwd = document.getElementById('password');
        pwd?.focus();
      });

      return;
    }
    if (retries < 10) setTimeout(() => attachLivewireToastListener(retries + 1), 200);
  })();

})();
</script>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/forms/register-form.blade.php ENDPATH**/ ?>