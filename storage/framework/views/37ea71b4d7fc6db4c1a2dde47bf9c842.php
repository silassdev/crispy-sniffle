<div class="max-w-6xl mx-auto">

  
  <div class="flex items-center justify-between gap-3 mb-4">
    <div class="flex items-center gap-3">
      <input wire:model.debounce.300ms="q" type="search" placeholder="Search notifications..." class="border rounded px-3 py-2" />
      <select wire:model="filter" class="border rounded px-2 py-2 text-sm">
        <option value="all">All</option>
        <option value="unread">Unread</option>
        <option value="read">Read</option>
      </select>
    </div>

    <div class="flex items-center gap-2">
      <button wire:click="selectAllCurrentPage" class="px-3 py-2 border rounded text-sm">Select all on this page</button>
      <button wire:click="clearSelection" class="px-3 py-2 border rounded text-sm">Clear</button>

      <button wire:click="bulkMarkRead" class="px-3 py-2 bg-emerald-600 text-white rounded text-sm" <?php if(empty($selected)): ?> disabled <?php endif; ?>>Mark selected read</button>
      <button wire:click="bulkDelete" class="px-3 py-2 bg-red-600 text-white rounded text-sm" <?php if(empty($selected)): ?> disabled <?php endif; ?>>Delete selected</button>
    </div>
  </div>

  
  <div wire:init="refreshList">
    
    <div wire:loading class="space-y-4">
      <!--[if BLOCK]><![endif]--><?php for($i = 0; $i < 6; $i++): ?>
        <div class="flex gap-3 items-start animate-pulse">
          <div class="w-12 h-12 rounded bg-gray-200"></div>
          <div class="flex-1 space-y-2">
            <div class="h-4 bg-gray-200 rounded w-1/3"></div>
            <div class="h-3 bg-gray-200 rounded w-2/3"></div>
            <div class="h-3 bg-gray-200 rounded w-1/2"></div>
          </div>
        </div>
      <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    
    <div wire:loading.remove class="bg-white rounded shadow overflow-hidden">
      <div class="divide-y">
        <!--[if BLOCK]><![endif]--><?php if($items->count()): ?>
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $isRead = !empty($n->read_at);
              $data = (array) ($n->data ?? []);
              $title = $data['title'] ?? 'Notification';
              $message = \Illuminate\Support\Str::limit($data['message'] ?? ($data['body'] ?? ''), 250);
              $link = $data['link'] ?? null;
            ?>

            <div class="p-4 flex gap-3 items-start">
              <div class="flex items-start gap-3">
                <input type="checkbox" wire:model="selected" value="<?php echo e($n->id); ?>" class="mt-1" />
                <div class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center text-sm font-semibold">
                  <?php echo e(strtoupper(substr($title,0,1))); ?>

                </div>
              </div>

              <div class="flex-1">
                <div class="flex items-start justify-between gap-3">
                  <div>
                    <div class="font-semibold"><?php echo e($title); ?></div>
                    <div class="text-xs text-gray-500"><?php echo e(\Carbon\Carbon::parse($n->created_at)->toDayDateTimeString()); ?></div>
                  </div>

                  <div class="text-right">
                    <!--[if BLOCK]><![endif]--><?php if($isRead): ?>
                      <span class="text-xs text-gray-500">Read</span>
                    <?php else: ?>
                      <span class="text-xs text-emerald-600">Unread</span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                  </div>
                </div>

                <div class="mt-2 text-gray-700"><?php echo nl2br(e($message)); ?></div>

                <div class="mt-3 flex items-center gap-2 text-sm">
                  <!--[if BLOCK]><![endif]--><?php if($link): ?>
                    <button wire:click="markAndGo('<?php echo e($n->id); ?>', '<?php echo e($link); ?>')" class="px-3 py-1 border rounded text-sm text-indigo-600">Open</button>
                  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                  <button wire:click="markAsRead('<?php echo e($n->id); ?>')" class="px-3 py-1 border rounded text-sm">Mark read</button>
                  <button wire:click="delete('<?php echo e($n->id); ?>')" class="px-3 py-1 border rounded text-sm text-red-600">Delete</button>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php else: ?>
          <div class="p-6 text-center text-gray-500">No notifications found.</div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </div>

      <div class="p-4">
        <?php echo e($items->links()); ?>

      </div>
    </div>
  </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
  // navigate-to listener (used by markAndGo)
  window.addEventListener('navigate-to', function(e){
    if (e.detail && e.detail.url) {
      window.location.href = e.detail.url;
    }
  });

  // optionally show a tiny notice when user selects many notifications
  document.addEventListener('livewire:update', function () {
    // disable bulk buttons if no selection: Livewire already handles disabled attr in markup,
    // this listener is available for any extra client-side UX you want.
  });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/notifications/notifications-page.blade.php ENDPATH**/ ?>