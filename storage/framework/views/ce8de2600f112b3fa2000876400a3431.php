<div class="relative">
  <button class="p-2 rounded hover:bg-gray-100">
    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    <span class="inline-block ml-1 text-xs text-red-600"><?php echo e($unread->count()); ?></span>
  </button>

  
  <div class="absolute right-0 mt-2 w-80 bg-white shadow rounded z-20">
    <div class="p-3 text-sm">
      <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $unread; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="py-2 border-b last:border-b-0">
          <div class="font-medium"><?php echo e($n->data['title'] ?? 'Notification'); ?></div>
          <div class="text-xs text-gray-500"><?php echo e(Str::limit($n->data['message'] ?? '', 80)); ?></div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="py-3 text-center text-gray-500">No unread notifications</div>
      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/community-notifications.blade.php ENDPATH**/ ?>