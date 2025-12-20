<div class="space-y-4">
  <div class="flex items-center justify-between">
    <h3 class="text-lg font-semibold">Feedback</h3>
    <div>
      <input wire:model.debounce.300ms="q" placeholder="search name/email/message" class="border rounded px-3 py-1"/>
    </div>
  </div>

  <div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50">
        <tr><th class="p-2 text-left">Name</th><th class="p-2">Email</th><th class="p-2">Country</th><th class="p-2">Type</th><th class="p-2">Date</th><th class="p-2 text-right">Action</th></tr>
      </thead>
      <tbody>
      <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="border-t">
          <td class="p-2"><?php echo e($f->name); ?></td>
          <td class="p-2"><?php echo e($f->email); ?></td>
          <td class="p-2"><?php echo e($f->country); ?></td>
          <td class="p-2"><?php echo e($f->type); ?></td>
          <td class="p-2"><?php echo e($f->created_at->diffForHumans()); ?></td>
          <td class="p-2 text-right">
            <button wire:click="view(<?php echo e($f->id); ?>)" class="px-2 py-1 border rounded text-xs">View</button>
            <button wire:click="markResolved(<?php echo e($f->id); ?>)" class="px-2 py-1 border rounded text-xs">Resolve</button>
            <button wire:click="delete(<?php echo e($f->id); ?>)" class="px-2 py-1 border rounded text-xs text-red-600">Delete</button>
          </td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>

    <div class="p-3"><?php echo e($items->links()); ?></div>
  </div>

  
  <!--[if BLOCK]><![endif]--><?php if($viewItem): ?>
    <div class="fixed inset-0 z-50 flex items-start justify-center pt-20">
      <div class="absolute inset-0 bg-black/40" wire:click="$set('viewing', null)"></div>
      <div class="relative z-10 w-full max-w-2xl bg-white rounded shadow-lg p-6">
        <div class="flex justify-between items-start">
          <div>
            <h4 class="font-semibold"><?php echo e($viewItem->name ?: 'Unknown'); ?></h4>
            <div class="text-xs text-gray-500"><?php echo e($viewItem->email); ?> • <?php echo e($viewItem->country); ?></div>
          </div>
          <div>
            <button wire:click="$set('viewing', null)" class="px-2 py-1 border rounded text-sm">Close</button>
          </div>
        </div>

        <div class="mt-4 prose max-w-none"><?php echo nl2br(e($viewItem->message)); ?></div>

        <div class="mt-4 flex gap-2">
          <!--[if BLOCK]><![endif]--><?php if(!$viewItem->resolved): ?>
            <button wire:click="markResolved(<?php echo e($viewItem->id); ?>)" class="px-3 py-1 bg-emerald-600 text-white rounded">Mark resolved</button>
          <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
          <button wire:click="delete(<?php echo e($viewItem->id); ?>)" class="px-3 py-1 border rounded text-red-600">Delete</button>
        </div>
      </div>
    </div>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/feedback-manager.blade.php ENDPATH**/ ?>