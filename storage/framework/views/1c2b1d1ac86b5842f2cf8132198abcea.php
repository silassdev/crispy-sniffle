<?php
  $courses = $courses ?? \App\Models\Course::latest()->take(6)->get();
?>

<div class="space-y-3 text-sm">
  <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <a href="<?php echo e(url('/courses/' . ($c->slug ?? $c->id))); ?>" class="block p-2 rounded hover:bg-gray-50 transition">
      <div class="font-medium"><?php echo e($c->title); ?></div>
      <div class="text-xs text-gray-500"><?php echo e(Str::limit($c->description ?? '', 60)); ?></div>
    </a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="text-gray-500">No courses available yet.</div>
  <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/partials/suggested-courses.blade.php ENDPATH**/ ?>