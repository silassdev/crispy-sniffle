<div x-data="toast()" x-init="init()" class="fixed z-50 right-4 top-4 space-y-2">
  <template x-for="(t,i) in toasts" :key="i">
    <div x-show="t.show" x-transition class="max-w-sm p-3 rounded shadow bg-white dark:bg-gray-800 border">
      <div class="flex items-start gap-3">
        <div>
          <div class="font-medium" x-text="t.title"></div>
          <div class="text-sm text-gray-600 dark:text-gray-300" x-html="t.message"></div>
        </div>
        <button @click="remove(i)" class="ml-auto text-gray-400 hover:text-gray-600">✕</button>
      </div>
    </div>
  </template>
</div>

<script>
  function toast(){
    return {
      toasts: [],
      init() {
        // push session messages if present
        @if(session('success'))
          this.push('Success', {!! json_encode(session('success')) !!}, 6000);
        @endif
        @if(session('error'))
          this.push('Error', {!! json_encode(session('error')) !!}, 8000);
        @endif
      },
      push(title, message, ttl = 5000) {
        const t = { title, message, show: true };
        this.toasts.push(t);
        setTimeout(() => { t.show = false; }, ttl);
      },
      remove(i) { this.toasts.splice(i,1); }
    }
  }
</script>
