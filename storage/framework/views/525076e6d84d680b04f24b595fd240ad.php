<div class="p-4">
  
  <div wire:loading wire:target="loadCounters" class="space-y-4">
    <div class="animate-pulse grid grid-cols-2 md:grid-cols-5 gap-4">
      <!--[if BLOCK]><![endif]--><?php for($i = 0; $i < 5; $i++): ?>
        <div class="h-20 rounded-lg bg-gray-100 dark:bg-slate-800 p-4">
          <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-1/3 mb-3"></div>
          <div class="h-6 bg-gray-200 dark:bg-slate-700 rounded w-1/2"></div>
        </div>
      <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
  </div>

  
  <div wire:loading.remove wire:target="loadCounters">
    <h2 class="text-2xl font-semibold mb-4">Overview</h2>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
      <div class="p-4 border rounded">
        <div class="text-sm text-gray-500">Students</div>
        <div class="text-2xl font-bold"><?php echo e($counters['students'] ?? 0); ?></div>
      </div>

      <div class="p-4 border rounded">
        <div class="text-sm text-gray-500">Trainers</div>
        <div class="text-2xl font-bold"><?php echo e($counters['trainers'] ?? 0); ?></div>
      </div>

      <div class="p-4 border rounded">
        <div class="text-sm text-gray-500">Admins</div>
        <div class="text-2xl font-bold"><?php echo e($counters['admins'] ?? 0); ?></div>
      </div>

      <div class="p-4 border rounded">
        <div class="text-sm text-gray-500">Posts</div>
        <div class="text-2xl font-bold"><?php echo e($counters['posts'] ?? 0); ?></div>
      </div>

      <div class="p-4 border rounded">
        <div class="text-sm text-gray-500">Invites</div>
        <div class="text-2xl font-bold"><?php echo e($counters['invites'] ?? 0); ?></div>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/overview.blade.php ENDPATH**/ ?>