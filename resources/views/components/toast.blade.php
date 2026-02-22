<div x-data="toast()" x-init="init()" class="fixed top-4 right-4 z-50">
  <template x-if="active && active.show">
    <div class="flex items-center gap-3 p-4 rounded-lg shadow-lg border backdrop-blur-sm transition-all duration-300"
         :class="{
           'bg-green-50 text-green-900 border-green-200': active.type === 'success',
           'bg-red-50 text-red-900 border-red-200': active.type === 'error',
           'bg-blue-50 text-blue-900 border-blue-200': active.type === 'info',
           'bg-yellow-50 text-yellow-900 border-yellow-200': active.type === 'warning',
         }">
      
      <div class="flex-1">
        <div class="font-bold" x-text="active.title"></div>
        <div class="text-sm opacity-90 mt-1 font-medium leading-relaxed" x-html="active.message"></div>
      </div>

      <button @click="dismiss()" class="shrink-0 ml-2 p-1.5 rounded-lg hover:bg-white/20 transition-colors opacity-70 hover:opacity-100 transition duration-200">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    </div>

    <!-- Progress Bar (Internal) -->
    <div class="absolute bottom-0 left-0 h-1 bg-white/30 transition-all ease-linear" :style="`width: ${progress}%`" x-show="active.show"></div>
  </template>
</div>


<script>
  function toast() {
    return {
      queue: [],
      active: null,
      timer: null,
      progress: 100,
      progressInterval: null,
      initialized: false,   
      init() {
        if (this.initialized) return;
        this.initialized = true;

        @if(session('success'))
          this.enqueue('Success', {!! json_encode(session('success')) !!}, 'success', 4000);
        @endif
        @if(session('error'))
          this.enqueue('Error', {!! json_encode(session('error')) !!}, 'error', 5000);
        @endif
        @if(session('warning'))
          this.enqueue('Warning', {!! json_encode(session('warning')) !!}, 'warning', 5000);
        @endif
        @if(session('info'))
          this.enqueue('Info', {!! json_encode(session('info')) !!}, 'info', 4000);
        @endif

        @if ($errors->any())
          let errors = {!! json_encode($errors->all()) !!};
          let html = errors.map(e => '<div>• ' + e + '</div>').join('');
          this.enqueue('Heads up!', html, 'error', 6000);
        @endif

        // Listen for Livewire notifications
        window.addEventListener('notify', (e) => {
          const d = e.detail;
          console.log('📢 Toast Event Received:', d);
          if (d && d.title && d.message) {
            this.enqueue(d.title, d.message, d.type || 'info', d.ttl || 4000);
          }
        });

        // Also listen for app-toast for backwards compatibility
        window.addEventListener('app-toast', (e) => {
          const d = e.detail || {};
          console.log('📢 App-Toast Event Received:', d);
          if (d.title && d.message) {
            this.enqueue(d.title, d.message, d.type || 'info', d.ttl || 4000);
          }
        });
      },

      makeId(title, message) {
        return (title ?? '') + '||' + (message ?? '');
      },

      enqueue(title, message, type = 'info', ttl = 4000) {
        const id = this.makeId(title, message);
        console.log('📥 Enqueuing toast:', { title, message, type, id });
        
        if (this.active && this.active.id === id) {
          console.log('⏭️ Toast already active, skipping duplicate');
          return;
        }
        if (this.queue.some(q => q.id === id)) {
          console.log('⏭️ Toast already in queue, skipping duplicate');
          return;
        }

        this.queue.push({ id, title, message, type, ttl });
        this.process();
      },

      process() {
        if (this.active || this.queue.length === 0) {
          console.log('⏸️ Process paused - active:', !!this.active, 'queue length:', this.queue.length);
          return;
        }

        const next = this.queue.shift();
        console.log('📤 Processing toast:', { title: next.title, message: next.message, type: next.type });
        
        this.active = { id: next.id, title: next.title, message: next.message, type: next.type, show: true };
        
        // Progress bar logic
        this.progress = 100;
        const start = Date.now();
        const duration = next.ttl;
        
        this.progressInterval = setInterval(() => {
          const elapsed = Date.now() - start;
          this.progress = Math.max(0, 100 - (elapsed / duration * 100));
        }, 10);

        this.timer = setTimeout(() => {
          this.hideCurrent();
        }, duration);
      },

      hideCurrent() {
        if (!this.active) return;
        
        console.log('👋 Hiding current toast:', this.active.title);
        this.active.show = false;
        if (this.progressInterval) clearInterval(this.progressInterval);
        
        setTimeout(() => {
          this.active = null;
          this.timer = null;
          this.process(); 
        }, 300);
      },

      dismiss() {
        if (!this.active) return;
        console.log('❌ Toast dismissed manually');
        clearTimeout(this.timer);
        this.hideCurrent();
      },

      replace(title, message, type = 'info', ttl = 4000) {
        console.log('🔄 Replacing toast:', { title, message, type });
        this.queue = [];
        if (this.timer) clearTimeout(this.timer);
        if (this.progressInterval) clearInterval(this.progressInterval);
        this.active = null;
        setTimeout(() => {
          this.enqueue(title, message, type, ttl);
        }, 50);
      }
    }
  }
</script>