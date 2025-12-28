<div>
  <div class="flex items-center justify-between mb-4">
    <h3 class="font-semibold">Assessments</h3>
    <div>
      <button wire:click="$emit('openAssessmentEditor', {course_id: <?php echo e($courseId ?? 'null'); ?> })" class="px-3 py-1 bg-indigo-600 text-white rounded">New Assessment</button>
    </div>
  </div>

  <div class="bg-white rounded shadow">
    <table class="w-full text-sm">
      <thead class="bg-gray-50">
        <tr><th class="p-2">Title</th><th class="p-2">Type</th><th class="p-2">Course</th><th class="p-2">Due</th><th class="p-2 text-right">Actions</th></tr>
      </thead>
      <tbody>
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $assessments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="border-t">
          <td class="p-2"><?php echo e($a->title); ?></td>
          <td class="p-2"><?php echo e(ucfirst($a->type)); ?></td>
          <td class="p-2"><?php echo e($a->course->title ?? '-'); ?></td>
          <td class="p-2"><?php echo e(optional($a->due_at)->toDayDateTimeString() ?? '-'); ?></td>
          <td class="p-2 text-right">
            <button wire:click="$emit('openAssessmentEditor', <?php echo e($a->id); ?>)" class="px-2 py-1 border rounded text-xs">Edit</button>
            <a href="<?php echo e(route('trainer.assessments.submissions', $a->id)); ?>" class="px-2 py-1 border rounded text-xs">Submissions</a>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
    <div class="p-3"><?php echo e($assessments->links()); ?></div>
  </div>

  <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('trainer.assignment-editor', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3910182854-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</div><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views\livewire/trainer/assignment-manager.blade.php ENDPATH**/ ?>