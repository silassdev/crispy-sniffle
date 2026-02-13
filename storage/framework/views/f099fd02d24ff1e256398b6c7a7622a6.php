<div class="flex items-center gap-2">

<div>
  <!--[if BLOCK]><![endif]--><?php if($show): ?>
    <div class="fixed inset-0 z-50 flex items-center justify-center" style="backdrop-filter: blur(2px);">
      <div class="absolute inset-0 bg-black/30" wire:click="close" aria-hidden="true"></div>

      <div class="relative w-[95%] md:w-4/5 lg:w-3/4 max-h-[90vh] bg-white rounded shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-3 border-b">
          <div class="flex items-center gap-3">
            <h3 class="text-sm font-semibold">Certificate preview</h3>
            <!--[if BLOCK]><![endif]--><?php if($certificateId): ?>
              <span class="text-xs text-gray-500">#<?php echo e($certificateId); ?></span>
             <a href="<?php echo e(route('certificates.pdf.download', $certificateId)); ?>" class="px-3 py-1 text-xs bg-indigo-600 text-white rounded" target="_blank" rel="noopener">Download PDF</a>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
          </div>

          <div class="flex items-center gap-2">
            <!--[if BLOCK]><![endif]--><?php if($certificateId): ?>
              <a href="<?php echo e($certificateId ? route('certificates.pdf.download', $certificateId) : '#'); ?>" class="px-3 py-1 text-xs bg-indigo-600 text-white rounded" target="_blank" rel="noopener">Download PDF</a>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <button
              id="save-pdf-btn"
              type="button"
              class="px-3 py-1 text-xs bg-emerald-600 text-white rounded"
              data-save-url="<?php echo e($certificateId ? route('certificates.pdf.save', $certificateId) : ''); ?>"
              onclick="saveCertificateToStorage(this)"
            >
              Save to storage
            </button>
        

          <button class="px-3 py-1 text-xs border rounded" wire:click="close">Close</button>
        </div>
          </div>
        </div>

        <div class="relative flex flex-col h-[75vh]">
          
          <div x-data
               x-init="$watch(()=> $wire.loading, v => {
                    // handled by Livewire property updates - kept for compatibility
               })"
               class="absolute inset-0 flex items-center justify-center bg-white/70 z-20"
               style="<?php echo e($loading ? '' : 'display:none;'); ?>">
            <div class="flex items-center gap-3">
              <svg class="animate-spin w-5 h-5 text-indigo-600" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
              <div class="text-sm text-gray-700">Loading preview…</div>
            </div>
          </div>

          
          <div class="flex-1">
            <!--[if BLOCK]><![endif]--><?php if($iframeSrc): ?>
              <iframe
                id="certificate-preview-iframe"
                src="<?php echo e($iframeSrc); ?>"
                class="w-full h-full border-0"
                onload="window.Livewire && window.Livewire.emit('iframeLoaded')"
              ></iframe>
            <?php else: ?>
              <div class="w-full h-full flex items-center justify-center text-sm text-gray-500">Preview not available</div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
          </div>
        </div>
      </div>
    </div>

    <script>
      // Wire-up: when Livewire emits iframeLoaded, call server method iframeLoaded()
      document.addEventListener('livewire:load', function () {
        if (window.Livewire) {
          window.Livewire.on('iframeLoaded', () => {
            // call backend method to mark loading false
            window.Livewire.emit('callMethod', {
              name: 'iframeLoaded',
              component: 'window.Livewire.find('<?php echo e($_instance->getId()); ?>')' // not used but keep compatibility; we'll call server directly below
            });
          });
        }
      });

      // simpler direct listener from iframe onload (above uses emit('iframeLoaded'))
      // intercept that and call Livewire component method
      window.addEventListener('message', function(ev){ /* placeholder if needed */ }, false);

      // fallback: listen for the dispatchBrowserEvent from PHP open action to ensure overlay visible
      window.addEventListener('certificate:open', function(e){
        // no-op; kept so you can hook custom logic
      });
    </script>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>


  <!--[if BLOCK]><![endif]--><?php if($certificateId): ?>
    <a href="<?php echo e(route('certificates.pdf.download', $certificateId)); ?>" class="px-3 py-1 text-xs bg-indigo-600 text-white rounded" target="_blank" rel="noopener">Download PDF</a>

    <!-- NEW: Save to storage button -->
    <button
      id="save-pdf-btn"
      type="button"
      class="px-3 py-1 text-xs bg-emerald-600 text-white rounded"
      data-save-url="<?php echo e($certificateId ? route('certificates.pdf.save', $certificateId) : ''); ?>"
      onclick="saveCertificateToStorage(this)"
    >
      Save to storage
    </button>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/certificate/preview-modal.blade.php ENDPATH**/ ?>