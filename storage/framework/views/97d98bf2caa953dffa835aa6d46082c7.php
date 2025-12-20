<a href="<?php echo e(route('notifications.index')); ?>" class="icon-nav-item" title="Notifications">
  <div class="relative">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
      <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
    </svg>
    <!--[if BLOCK]><![endif]--><?php if($unreadCount > 0): ?>
      <span class="absolute -top-1 -right-1 text-[10px] bg-red-600 text-white rounded-full min-w-[14px] h-[14px] px-1 flex items-center justify-center border-2 border-white leading-none">
        <?php echo e($unreadCount); ?>

      </span>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
  </div>
  <span class="icon-label">Notifications</span>
</a>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/notifications/notification-bell.blade.php ENDPATH**/ ?>