<div class="p-4">
  <div wire:loading wire:target="loadCounters" class="space-y-4">
    <div class="animate-pulse grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
      <!--[if BLOCK]><![endif]--><?php for($i = 0; $i < 5; $i++): ?>
        <div class="h-28 rounded-2xl bg-gradient-to-br from-slate-100 to-white dark:from-slate-800 dark:to-slate-200 p-4">
          <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-1/3 mb-3"></div>
          <div class="h-8 bg-slate-200 dark:bg-slate-700 rounded w-1/2"></div>
        </div>
      <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
  </div>

  <div wire:loading.remove wire:target="loadCounters">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">
      <div>
        <h2 class="text-2xl sm:text-3xl font-bold leading-tight text-slate-900 dark:text-black">Overview</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-600">Key metrics for your application — updated in real time.</p>
      </div>

      <div class="flex items-center gap-3">
        <button wire:click="loadCounters"
                class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-white/70 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 shadow-sm hover:scale-105 transition transform">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6"/>
          </svg>
          <span class="text-xs text-slate-300 dark:text-slate-900">Refresh</span>
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">

      <?php
        $cards = [
          ['label'=>'Students','key'=>'students','from'=>'indigo-500','to'=>'emerald-400','trend'=>'+3.4%','trendColor'=>'text-green-600','trendNote'=>'since last week'],
          ['label'=>'Trainers','key'=>'trainers','from'=>'rose-500','to'=>'orange-400','trend'=>'—','trendColor'=>'text-slate-500','trendNote'=>'this month'],
          ['label'=>'Admins','key'=>'admins','from'=>'sky-500','to'=>'indigo-500','trend'=>'+1','trendColor'=>'text-indigo-600','trendNote'=>'new'],
          ['label'=>'Posts','key'=>'posts','from'=>'amber-400','to'=>'rose-400','trend'=>'—','trendColor'=>'text-slate-500','trendNote'=>'this quarter'],
          ['label'=>'Invites','key'=>'invites','from'=>'lime-400','to'=>'emerald-400','trend'=>'—','trendColor'=>'text-slate-500','trendNote'=>'pending'],
        ];
      ?>

      <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="relative overflow-visible rounded-2xl p-5 bg-blue-500 bg-slate-900 border border-slate-100 dark:border-slate-800 shadow hover:shadow-lg transition transform hover:-translate-y-1 min-h-[88px]">
        <div class="flex items-start justify-between gap-3">
          <div class="flex items-center gap-3 min-w-0">
            <div class="relative flex-shrink-0">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-<?php echo e($card['from']); ?> to-<?php echo e($card['to']); ?> flex items-center justify-center shadow-sm">
                
                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14c4 0 6 2 6 4v1H6v-1c0-2 2-4 6-4z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 10a3 3 0 100-6 3 3 0 000 6z"/>
                </svg>
              </div>

              
              <svg class="absolute -right-3 -top-3 w-20 h-20 opacity-10 pointer-events-none" viewBox="0 0 100 100" fill="none" aria-hidden="true">
                <defs>
                  <linearGradient id="g<?php echo e($loop->index); ?>" x1="0" x2="1">
                    <stop offset="0" stop-color="#000" stop-opacity="0.2"></stop>
                    <stop offset="1" stop-color="#000" stop-opacity="0.0"></stop>
                  </linearGradient>
                </defs>
                <circle cx="50" cy="50" r="40" fill="url(#g<?php echo e($loop->index); ?>)"/>
              </svg>
            </div>

            <div class="min-w-0">
              <div class="text-sm text-slate-500 dark:text-slate-300 truncate"><?php echo e($card['label']); ?></div>
              <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white leading-tight break-words">
                <?php echo e($counters[$card['key']] ?? 0); ?>

              </div>
            </div>
          </div>

          <div class="flex flex-col items-end ml-2">
            <div class="text-xs font-semibold <?php echo e($card['trendColor']); ?>"><?php echo e($card['trend']); ?></div>
            <div class="text-xs text-slate-400 dark:text-slate-500"><?php echo e($card['trendNote']); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/overview.blade.php ENDPATH**/ ?>