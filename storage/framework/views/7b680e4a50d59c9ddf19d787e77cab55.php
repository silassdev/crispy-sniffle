
<div class="p-4">
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
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/overview/partials/index.blade.php ENDPATH**/ ?>