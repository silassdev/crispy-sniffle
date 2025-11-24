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
    document.addEventListener('DOMContentLoaded', function() {
      // 1. Safe Element Selection
      const contentEl = document.getElementById('admin-content');
      const loader = document.getElementById('ajax-loader');
      const sidebar = document.getElementById('admin-sidebar');
      const countersEl = document.getElementById('admin-counters');
      const toggle = document.getElementById('sidebar-toggle');
      
      // SVG Icons for the toggle (if they exist)
      const openIcon = document.getElementById('toggle-open');
      const closeIcon = document.getElementById('toggle-close');

      // --- Helper Functions ---

      function showLoader() {
        if (loader) { loader.classList.remove('hidden'); loader.classList.add('flex'); }
      }

      function hideLoader() {
        if (loader) { loader.classList.add('hidden'); loader.classList.remove('flex'); }
      }

      function setActive(sectionName, linkEl) {
        document.querySelectorAll('.ajax-link.dash-active').forEach(i => i.classList.remove('dash-active'));
        if (linkEl) linkEl.classList.add('dash-active');
      }

      // --- Core Logic ---

      async function fetchCounters() {
        if (!countersEl) return; // Safety check
        try {
          const res = await fetch("<?php echo e(route('admin.counters')); ?>", {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
          });
          if (!res.ok) return;
          const data = await res.json();
          countersEl.innerHTML = `S:${data.students} • T:${data.trainers} • A:${data.admins}`;
        } catch (e) {
          console.warn('Failed to fetch counters', e);
        }
      }

      async function loadUrl(url, sectionName, linkEl = null, push = true) {
        if (!contentEl) {
            // Fallback if admin-content container is missing
            window.location.href = url;
            return;
        }

        showLoader();
        try {
          const res = await fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
          });
          
          if (!res.ok) {
            window.location.href = url;
            return;
          }
          
          const html = await res.text();
          contentEl.innerHTML = html;
          setActive(sectionName, linkEl);
          
          if (push) history.pushState({ url, section: sectionName }, '', url);
          
          fetchCounters();
        } catch (err) {
          console.error('AJAX load failed', err);
          window.location.href = url;
        } finally {
          hideLoader();
        }
      }

      // --- Event Listeners ---

      // 1. Sidebar Toggle (Consolidated Logic)
      if (sidebar && toggle) {
        toggle.addEventListener('click', function() {
          const collapsed = sidebar.classList.toggle('collapsed');
          
          // Toggle Icons if they exist
          if (openIcon && closeIcon) {
            openIcon.classList.toggle('hidden', collapsed);
            closeIcon.classList.toggle('hidden', !collapsed);
          }
          
          toggle.setAttribute('aria-expanded', String(!collapsed));
        });
      }

      // 2. AJAX Links
      document.querySelectorAll('.ajax-link').forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const url = this.dataset.route || this.href;
          const section = this.dataset.section || null;
          loadUrl(url, section, this, true);
        });
      });

      // 3. History Navigation (Back/Forward)
      window.addEventListener('popstate', function(e) {
        const state = e.state;
        if (state && state.url) {
          loadUrl(state.url, state.section, null, false);
        } else {
          window.location.reload();
        }
      });

      // Initial load
      fetchCounters();
    });

  </script>

  <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/layouts/app.blade.php ENDPATH**/ ?>