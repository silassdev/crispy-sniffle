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

<?php if(session()->has('app_toast')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const payload = <?php echo json_encode(session('app_toast'), 15, 512) ?>;

            // Dispatch a native browser event named 'appToast'
            window.dispatchEvent(new CustomEvent('appToast', { detail: payload }));

            // Optional: If you want to immediately handle it here (fallback),
            // attempt to use a common toast library if present (toastr example),
            // otherwise just console.log.
            try {
                // If toastr is loaded
                if (typeof toastr !== 'undefined') {
                    const ttl = payload.ttl || 4000;
                    const title = payload.title || '';
                    const msg = payload.message || '';
                    const level = payload.level || 'info';
                    // toastr[level] exists for 'success','info','warning','error'
                    if (typeof toastr[level] === 'function') {
                        toastr[level](msg, title, { timeOut: ttl });
                    } else {
                        toastr.info(msg, title, { timeOut: ttl });
                    }
                } else if (typeof Notyf !== 'undefined') {
                    // Notyf example
                    const notyf = new Notyf();
                    notyf.open({type: payload.level || 'info', message: payload.message});
                } else {
                    // Fallback: let app code (or dev console) handle it
                    console.log('appToast payload:', payload);
                }
            } catch (err) {
                console.error('Error showing toast fallback:', err);
            }
        });
    </script>
<?php endif; ?>


</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/app.blade.php ENDPATH**/ ?>