<div x-data="toast()" x-init="init()" class="fixed z-[9999] right-4 top-4 space-y-3 pointer-events-none w-full max-w-xs sm:max-w-sm">
  <template x-if="active">
    <div x-show="active.show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-[-20px] scale-95"
         x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 transform translate-y-[-20px] scale-95"
         class="pointer-events-auto relative overflow-hidden rounded-2xl p-4 shadow-2xl backdrop-blur-md border animate-fade-in-up"
         :class="{
           'bg-emerald-500/90 border-emerald-400/50 text-white shadow-emerald-500/20': active.type === 'success',
           'bg-rose-500/90 border-rose-400/50 text-white shadow-rose-500/20': active.type === 'error',
           'bg-amber-500/90 border-amber-400/50 text-white shadow-amber-500/20': active.type === 'warning',
           'bg-blue-500/90 border-blue-400/50 text-white shadow-blue-500/20': active.type === 'info'
         }">
      
      <div class="flex items-start gap-4">
        <!-- Icon Container -->
        <div class="shrink-0 p-2 rounded-xl bg-white/20 backdrop-blur-sm shadow-inner">
          <template x-if="active.type === 'success'">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
          </template>
          <template x-if="active.type === 'error'">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
          </template>
          <template x-if="active.type === 'warning'">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
          </template>
          <template x-if="active.type === 'info'">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          </template>
        </div>

        <div class="flex-1 min-w-0 pt-0.5">
          <div class="font-bold text-base tracking-tight leading-tight" x-text="active.title"></div>
          <div class="text-sm opacity-90 mt-1 font-medium leading-relaxed" x-html="active.message"></div>
        </div>

        <button @click="dismiss()" class="shrink-0 ml-2 p-1.5 rounded-lg hover:bg-white/20 transition-colors opacity-70 hover:opacity-100 transition duration-200">
          <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
      </div>

      <!-- Progress Bar (Internal) -->
      <div class="absolute bottom-0 left-0 h-1 bg-white/30 transition-all ease-linear" :style="`width: ${progress}%`" x-show="active.show"></div>
    </div>
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

        window.addEventListener('app-toast', (e) => {
          const d = e.detail || {};
          this.enqueue(d.title || d.type?.toUpperCase() || 'Note', d.message || '', d.type || 'info', d.ttl ?? 4000);
        });
      },

      makeId(title, message) {
        return (title ?? '') + '||' + (message ?? '');
      },

      enqueue(title, message, type = 'info', ttl = 4000) {
        const id = this.makeId(title, message);
        if (this.active && this.active.id === id) return;
        if (this.queue.some(q => q.id === id)) return;

        this.queue.push({ id, title, message, type, ttl });
        this.process();
      },

      process() {
        if (this.active || this.queue.length === 0) return;

        const next = this.queue.shift();
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
        clearTimeout(this.timer);
        this.hideCurrent();
      },

      replace(title, message, type = 'info', ttl = 4000) {
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
