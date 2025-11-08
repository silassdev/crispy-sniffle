<div x-data="toast()" x-init="init()" class="fixed z-50 right-4 top-4 space-y-2 pointer-events-none">
  <template x-for="(t,i) in toasts" :key="i">
    <div x-show="t.show" x-transition class="pointer-events-auto max-w-sm p-3 rounded shadow bg-white dark:bg-gray-800 border">
      <div class="flex items-start gap-3">
        <div class="flex-1">
          <div class="font-medium text-sm" x-text="t.title"></div>
          <div class="text-sm text-gray-600 dark:text-gray-300 mt-1" x-html="t.message"></div>
        </div>
        <button @click="remove(i)" class="ml-3 text-gray-400 hover:text-gray-600">✕</button>
      </div>
    </div>
  </template>
</div>

<script>
  function toast() {
    return {
      toasts: [],
      init() {
        // push session success & error
        <?php if(session('success')): ?>
          this.push('Success', <?php echo json_encode(session('success')); ?>, 6000);
        <?php endif; ?>
        <?php if(session('error')): ?>
          this.push('Error', <?php echo json_encode(session('error')); ?>, 8000);
        <?php endif; ?>

        // push validation errors if present
        <?php if($errors->any()): ?>
          let errors = <?php echo json_encode($errors->all()); ?>;
          let html = errors.map(e => '<div>• ' + e + '</div>').join('');
          this.push('Please fix the following', html, 9000);
        <?php endif; ?>

        // listen for programmatic toasts
        window.addEventListener('app-toast', (e) => {
          const d = e.detail || {};
          this.push(d.title || 'Note', d.message || '', d.ttl || 5000);
        });
      },
      push(title, message, ttl = 5000) {
        const t = { title, message, show: true };
        this.toasts.push(t);
        setTimeout(() => { t.show = false; }, ttl);
      },
      remove(i) { this.toasts.splice(i, 1); }
    }
  }
</script>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/components/toast.blade.php ENDPATH**/ ?>