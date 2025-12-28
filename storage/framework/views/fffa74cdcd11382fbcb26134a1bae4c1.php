<div class="bg-white rounded shadow p-3">
  <div class="flex items-center justify-between gap-3">
    <div class="flex items-center gap-3">
      <div class="text-sm font-semibold">Pending assessments</div>

      
      <div aria-hidden="true">
        <!--[if BLOCK]><![endif]--><?php if($count > 0): ?>
          <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium rounded-full bg-red-600 text-white">
            <?php echo e($count); ?>

          </span>
        <?php else: ?>
          <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-600">
            0
          </span>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </div>
    </div>

    <div class="flex items-center gap-2">
      <!--[if BLOCK]><![endif]--><?php if(!$showAll): ?>
        <button wire:click="viewAll" class="text-xs text-indigo-600 hover:underline">View all</button>
      <?php else: ?>
        <a href="<?php echo e(route('student.dashboard')); ?>" class="text-xs text-gray-500 hover:underline">Back</a>
      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
  </div>

  <div class="mt-3">
    <!--[if BLOCK]><![endif]--><?php if($assessments->isEmpty()): ?>
      <div class="text-sm text-gray-500">No pending assessments. Good job!</div>
    <?php else: ?>
      <ul class="space-y-3">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $assessments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="p-3 border rounded flex items-start justify-between">
            <div class="flex-1">
              <div class="font-medium text-sm"><?php echo e($a->title); ?></div>
              <div class="text-xs text-gray-500"><?php echo e($a->course->title ?? 'Course'); ?> • <?php echo e(ucfirst($a->type)); ?></div>
              <!--[if BLOCK]><![endif]--><?php if($a->due_at): ?>
                <div class="text-xs text-red-600 mt-1">Due: <?php echo e($a->due_at->diffForHumans()); ?> (<?php echo e($a->due_at->toDayDateTimeString()); ?>)</div>
              <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div class="flex items-center gap-2 ml-4">
              <!--[if BLOCK]><![endif]--><?php if($showAll): ?>
                <a href="<?php echo e(route('courses.show', $a->course->slug)); ?>" class="px-3 py-1 bg-indigo-600 text-white text-xs rounded">Open</a>
              <?php else: ?>
                <button wire:click="viewAll" class="px-3 py-1 bg-indigo-600 text-white text-xs rounded">Open</button>
              <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      </ul>

      
      <!--[if BLOCK]><![endif]--><?php if($showAll): ?>
        <div class="mt-4">
          <?php echo e($assessments->links()); ?>

        </div>
      <?php else: ?>
        <div class="mt-3 text-xs text-gray-500">Showing up to <?php echo e($limit); ?> items.</div>
      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/student/pending-assessments.blade.php ENDPATH**/ ?>