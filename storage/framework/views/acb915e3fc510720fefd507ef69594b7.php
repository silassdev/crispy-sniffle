<div class="space-y-4">
  <div class="flex items-center justify-between">
    <h3 class="text-lg font-semibold">Newsletter subscribers</h3>
    <div class="flex gap-2">
      <input wire:model.debounce.300ms="q" placeholder="search email or name" class="border rounded px-3 py-1"/>
      <button wire:click="exportCsv" class="px-3 py-1 bg-indigo-600 text-white rounded">Export CSV</button>
    </div>
  </div>

  <div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50">
        <tr><th class="p-2 text-left">Name</th><th class="p-2 text-left">Email</th><th class="p-2">Country</th><th class="p-2">Interest</th><th class="p-2">Date</th><th class="p-2 text-right">Action</th></tr>
      </thead>
      <tbody>
      <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="border-t">
          <td class="p-2"><?php echo e($s->name); ?></td>
          <td class="p-2"><?php echo e($s->email); ?></td>
          <td class="p-2"><?php echo e($s->country); ?></td>
          <td class="p-2"><?php echo e($s->interest); ?></td>
          <td class="p-2"><?php echo e($s->subscribed_at?->toDayDateTimeString()); ?></td>
          <td class="p-2 text-right">
            <button wire:click="delete(<?php echo e($s->id); ?>)" class="text-xs text-red-600 px-2 py-1 border rounded">Delete</button>
          </td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>

    <div class="p-3"><?php echo e($subs->links()); ?></div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/newsletter-manager.blade.php ENDPATH**/ ?>