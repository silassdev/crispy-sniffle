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

  <main class="pt-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

  <?php echo $__env->yieldPushContent('scripts'); ?>

  
  <script>
  (function () {
    // central dispatcher - normalises payload and shows the toast via available library
    function showToast(payload) {
      if (!payload || typeof payload !== 'object') payload = {};

      var level = payload.level || payload.type || 'info';
      var title = payload.title || '';
      var message = payload.message || payload.msg || payload.body || '';
      var ttl = payload.ttl || payload.timeout || 4000;

      // Try toastr if present
      try {
        if (typeof toastr !== 'undefined' && typeof toastr[level] === 'function') {
          toastr[level](message, title, { timeOut: ttl });
          return;
        }
      } catch (e) {
        console.error('toastr error:', e);
      }

      // Try Notyf
      try {
        if (typeof Notyf !== 'undefined') {
          var notyf = new Notyf();
          notyf.open({ type: level, message: message || title });
          return;
        }
      } catch (e) {
        console.error('Notyf error:', e);
      }

      try {
        window.dispatchEvent(new CustomEvent('app-toast-fallback', { detail: payload }));
      } catch (e) {
        console.error('app-toast-fallback dispatch failed', e);
      }

      // Final fallback: console
      console.log('toast', { level: level, title: title, message: message, ttl: ttl });
    }

    // expose helper
    window.appToast = function (payload) {
      try { showToast(payload); } catch (err) { console.error('appToast helper error', err); }
    };

    // Listen for the canonical event name (CustomEvent with detail)
    window.addEventListener('app-toast', function (e) {
      showToast(e && e.detail ? e.detail : {});
    });

    // Accept legacy / alternate event name
    window.addEventListener('appToast', function (e) {
      showToast(e && e.detail ? e.detail : {});
    });

    // Accept Livewire's dispatchBrowserEvent which fires native events by name on window/document
    // If you do: $this->dispatchBrowserEvent('app-toast', $payload) in Livewire, it will be caught above.
    // Add explicit listener for backwards compatibility (some setups deliver event on document)
    document.addEventListener('app-toast', function (e) {
      showToast(e && e.detail ? e.detail : {});
    });

    // Wire up Livewire .on emitter (Livewire.emit('appToast', payload) or Livewire.emit('app-toast', payload))
    if (typeof Livewire !== 'undefined' && Livewire.on) {
      try {
        Livewire.on('appToast', function (payload) {
          // Livewire.emit sends payload directly
          showToast(payload || {});
        });
        Livewire.on('app-toast', function (payload) {
          showToast(payload || {});
        });
      } catch (err) {
        console.error('Livewire toast wiring error', err);
      }
    }

    // If there is a session flash (server-rendered), dispatch it on DOMContentLoaded
    document.addEventListener('DOMContentLoaded', function () {
      <?php if(session()->has('app_toast')): ?>
        (function () {
          var payload = <?php echo json_encode(session('app_toast'), 15, 512) ?>;
          try { showToast(payload); } catch (err) { console.error('session toast error', err); }
        })();
      <?php endif; ?>
    });

   
  })();
  </script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/app.blade.php ENDPATH**/ ?>