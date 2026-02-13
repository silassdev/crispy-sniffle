<div>
  
  <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6 bg-slate-50 p-4 rounded-xl border border-slate-100">
    <div class="flex flex-1 items-center gap-2 w-full sm:w-auto">
      <div class="relative flex-1 sm:flex-none">
        <input wire:model.live.debounce.300ms="q" type="search" placeholder="Search..." class="w-full pl-9 pr-4 py-2 text-sm border-slate-200 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" />
        <svg class="w-4 h-4 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </div>
      <select wire:model.live="filter" class="py-2 pl-3 pr-8 text-sm border-slate-200 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white">
        <option value="all">All</option>
        <option value="unread">Unread</option>
        <option value="read">Read</option>
      </select>
    </div>

    <div class="flex items-center gap-2 w-full sm:w-auto overflow-x-auto pb-1 sm:pb-0 no-scrollbar">
      <!--[if BLOCK]><![endif]--><?php if(count($selected) > 0): ?>
        <button wire:click="bulkMarkRead" class="whitespace-nowrap px-3 py-2 bg-indigo-600 text-white rounded-lg text-xs font-semibold hover:bg-indigo-700 transition-colors shadow-sm">Mark Read</button>
        <button wire:click="bulkDelete" class="whitespace-nowrap px-3 py-2 bg-rose-600 text-white rounded-lg text-xs font-semibold hover:bg-rose-700 transition-colors shadow-sm">Delete</button>
        <button wire:click="clearSelection" class="whitespace-nowrap px-3 py-2 text-slate-500 hover:text-slate-700 text-xs font-medium">Clear</button>
      <?php else: ?>
        <button wire:click="selectAllCurrentPage" class="whitespace-nowrap px-3 py-2 text-indigo-600 hover:bg-indigo-50 rounded-lg text-xs font-semibold transition-colors">Select Page</button>
        <button wire:click="markAsRead" class="whitespace-nowrap px-3 py-2 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition-colors">Mark All Read</button>
      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
  </div>

  
  <div wire:init="refreshList">
    
    <div wire:loading class="space-y-3">
      <!--[if BLOCK]><![endif]--><?php for($i = 0; $i < 5; $i++): ?>
        <div class="flex gap-4 p-4 rounded-xl border border-slate-100 bg-white animate-pulse">
          <div class="w-12 h-12 rounded-xl bg-slate-100"></div>
          <div class="flex-1 space-y-3">
            <div class="flex justify-between">
              <div class="h-4 bg-slate-100 rounded w-1/3"></div>
              <div class="h-3 bg-slate-100 rounded w-16"></div>
            </div>
            <div class="h-3 bg-slate-100 rounded w-5/6"></div>
            <div class="flex gap-2 pt-1">
              <div class="h-8 bg-slate-50 rounded-lg w-20"></div>
              <div class="h-8 bg-slate-50 rounded-lg w-20"></div>
            </div>
          </div>
        </div>
      <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    
    <div wire:loading.remove class="space-y-3">
      <!--[if BLOCK]><![endif]--><?php if($items->count()): ?>
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $isRead = !empty($n->read_at);
            $data = (array) ($n->data ?? []);
            $title = $data['title'] ?? 'Notification';
            $message = $data['message'] ?? ($data['body'] ?? '');
            $link = $data['link'] ?? null;
            $type = $data['type'] ?? 'info';
          ?>

          <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'group relative p-4 rounded-xl border transition-all duration-200 flex gap-4 items-start',
            'bg-white border-slate-100 hover:border-indigo-200 hover:shadow-md' => $isRead,
            'bg-indigo-50/30 border-indigo-100 hover:border-indigo-200 shadow-sm' => !$isRead
          ]); ?>">
            <div class="flex flex-col items-center gap-2 mt-1">
              <input type="checkbox" wire:model.live="selected" value="<?php echo e($n->id); ?>" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 shadow-sm transition-all" />
              <!--[if BLOCK]><![endif]--><?php if(!$isRead): ?>
                <div class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></div>
              <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div class="flex-1 min-w-0">
              <div class="flex items-start justify-between gap-3 mb-1">
                <div>
                  <h4 class="font-bold text-slate-900 truncate pr-6"><?php echo e($title); ?></h4>
                  <div class="text-[11px] font-medium text-slate-500 flex items-center gap-1.5 mt-0.5">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <?php echo e(\Carbon\Carbon::parse($n->created_at)->diffForHumans()); ?>

                  </div>
                </div>
                
                <div class="flex items-center gap-1">
                   <button wire:click="delete('<?php echo e($n->id); ?>')" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all opacity-0 group-hover:opacity-100" title="Delete">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                  </button>
                </div>
              </div>

              <div class="text-sm text-slate-600 line-clamp-2 leading-relaxed mt-1">
                <?php echo e($message); ?>

              </div>

              <div class="mt-4 flex items-center gap-2">
                <!--[if BLOCK]><![endif]--><?php if($link): ?>
                  <button wire:click="markAndGo('<?php echo e($n->id); ?>', '<?php echo e($link); ?>')" class="px-3 py-1.5 bg-indigo-600 text-white rounded-lg text-xs font-bold hover:bg-indigo-700 transition-colors shadow-sm">
                    View Details
                  </button>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                
                <!--[if BLOCK]><![endif]--><?php if(!$isRead): ?>
                  <button wire:click="markAsRead('<?php echo e($n->id); ?>')" class="px-3 py-1.5 text-indigo-600 hover:bg-indigo-50 border border-transparent hover:border-indigo-100 rounded-lg text-xs font-bold transition-all">
                    Mark Read
                  </button>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      <?php else: ?>
        <div class="py-12 bg-white rounded-2xl border border-dashed border-slate-200 flex flex-col items-center text-center px-6">
          <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
          </div>
          <h5 class="text-slate-900 font-bold">All caught up!</h5>
          <p class="text-slate-500 text-sm mt-1 max-w-[200px]">No notifications found matching your current filter.</p>
        </div>
      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

      <div class="pt-4">
        <?php echo e($items->links()); ?>

      </div>
    </div>
  </div>
  <style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
  </style>

  <script>
    window.addEventListener('navigate-to', function(e){
      if (e.detail && e.detail.url) {
        window.location.href = e.detail.url;
      }
    });
  </script>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/notifications/notifications-page.blade.php ENDPATH**/ ?>