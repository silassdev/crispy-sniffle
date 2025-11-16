<!doctype html>
<html lang="<?php echo e(str_replace('_','-',app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>

  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


  <?php echo $__env->yieldPushContent('head'); ?>

 </head>
 <body class="min-h-screen bg-gray-50 text-gray-800">

  <?php if (isset($component)) { $__componentOriginal7cfab914afdd05940201ca0b2cbc009b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $attributes = $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $component = $__componentOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>

  
  <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


  <main class="pt-5 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


        <script>
  (function () {
    // a single delegated click handler for the modal controls
    function delegatedClickHandler(e) {
      const closeBtn = e.target.closest && e.target.closest('#login-modal-close');
      if (closeBtn) {
        const root = document.getElementById('login-modal-root');
        if (root) root.remove();
        return;
      }

      const toggle = e.target.closest && e.target.closest('#toggle-password');
      if (toggle) {
        const pwd = document.getElementById('password');
        if (pwd) {
          pwd.setAttribute('type', pwd.type === 'password' ? 'text' : 'password');
          toggle.setAttribute('aria-pressed', String(pwd.type === 'text'));
        }
      }
    }

    // attach once and ensure we re-attach if Livewire re-renders
    function attachHandlers() {
      if (!window.__login_modal_handlers_attached) {
        document.addEventListener('click', delegatedClickHandler);
        window.__login_modal_handlers_attached = true;
      }
    }

    attachHandlers();

    // Re-attach (no-op if already attached) after Livewire messages are processed.
    // Works with Livewire v2+ (hook) and a fallback for older versions that might expose an event.
    if (window.Livewire && typeof Livewire.hook === 'function') {
      Livewire.hook('message.processed', () => attachHandlers());
    } else if (window.Livewire && typeof Livewire.on === 'function') {
      // some older installs emit this event name - it's harmless even if not used
      Livewire.on('message.processed', () => attachHandlers());
    } else {
      // last resort: re-run attach after short delays (covers edge cases)
      setTimeout(() => attachHandlers(), 300);
      setTimeout(() => attachHandlers(), 1000);
    }

    // Optional: also support the focus-password emitted event (modern Livewire)
    (function attachFocusListener() {
      if (window.Livewire && typeof Livewire.on === 'function') {
        Livewire.on('focus-password', () => {
          const pwd = document.getElementById('password');
          pwd?.focus();
        });
      } else {
        // If Livewire can't emit, your fallback inline script already handles focusing
      }
    })();
  })();
  </script>


  <?php echo $__env->yieldPushContent('scripts'); ?>


  
  <?php echo $__env->yieldPushContent('scripts'); ?>

 
  </body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/app.blade.php ENDPATH**/ ?>