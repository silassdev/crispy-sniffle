<div x-data="toast()" x-init="init()" class="fixed z-50 right-4 top-4 space-y-2 pointer-events-none">
  <template x-if="active">
    <div x-show="active.show"
         x-transition
         class="pointer-events-auto max-w-sm p-3 rounded shadow bg-white dark:bg-gray-800 border">
      <div class="flex items-start gap-3">
        <div class="flex-1">
          <div class="font-medium text-sm" x-text="active.title"></div>
          <div class="text-sm text-gray-600 dark:text-gray-300 mt-1" x-html="active.message"></div>
        </div>
        <button @click="dismiss()" class="ml-3 text-gray-400 hover:text-gray-600">✕</button>
      </div>
    </div>
  </template>
</div>


<script>
  function toast() {
    return {
      queue: [],
      active: null,
      timer: null,
      initialized: false,   
      lastShownId: null,   
      init() {
        if (this.initialized) return;
        this.initialized = true;

        // server-side flashes (use enqueue so they respect the single-toast queue)
        <?php if(session('success')): ?>
          this.enqueue('Success', <?php echo json_encode(session('success')); ?>, 3000);
        <?php endif; ?>
        <?php if(session('error')): ?>
          this.enqueue('Error', <?php echo json_encode(session('error')); ?>, 4000);
        <?php endif; ?>

        <?php if($errors->any()): ?>
          let errors = <?php echo json_encode($errors->all()); ?>;
          let html = errors.map(e => '<div>• ' + e + '</div>').join('');
          this.enqueue('Please fix the following', html, 5000);
        <?php endif; ?>

        // programmatic toasts
        window.addEventListener('app-toast', (e) => {
          const d = e.detail || {};
          this.enqueue(d.title || 'Note', d.message || '', d.ttl ?? 3000);
        });
      },

      // create a simple id for dedupe
      makeId(title, message) {
        return (title ?? '') + '||' + (message ?? '');
      },

      enqueue(title, message, ttl = 3000) {
        const id = this.makeId(title, message);

        // if currently showing the same toast, ignore
        if (this.active && this.active.id === id) return;

        // if already queued the same toast, ignore
        if (this.queue.some(q => q.id === id)) return;

        // push and start processing queue
        this.queue.push({ id, title, message, ttl });
        this.process();
      },

      process() {
        // already showing one
        if (this.active) return;
        if (this.queue.length === 0) return;

        const next = this.queue.shift();
        this.active = { id: next.id, title: next.title, message: next.message, show: true };

        // hide after ttl
        this.timer = setTimeout(() => {
          // start hide transition
          this.active.show = false;

          // wait for transition to finish before clearing and showing next
          setTimeout(() => {
            this.lastShownId = this.active.id;
            this.active = null;
            this.timer = null;
            this.process(); 
          }, 300); 
        }, next.ttl);
      },

      dismiss() {
        if (!this.active) return;
        clearTimeout(this.timer);
        this.active.show = false;
        setTimeout(() => {
          this.active = null;
          this.timer = null;
          this.process();
        }, 300);
      },

      // helper if you want to force-show and clear queue (optional)
      replace(title, message, ttl = 3000) {
        // clear queue & current toast, then show this one immediately
        this.queue = [];
        if (this.timer) clearTimeout(this.timer);
        this.active = null;
        setTimeout(() => { // allow any in-progress hide to finish
          this.enqueue(title, message, ttl);
        }, 50);
      }
    }
  }
</script>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/components/toast.blade.php ENDPATH**/ ?>