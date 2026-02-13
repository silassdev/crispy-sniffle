<div class="space-y-3">
  <div class="flex items-center justify-between">
    <h4 class="font-semibold">Certificate Requests</h4>
    <div>
      <input wire:model.debounce.300ms="q" placeholder="search student" class="border rounded px-2 py-1" />
      <select wire:model="status" class="border rounded px-2 py-1 text-sm">
        <option value="pending">Pending</option>
        <option value="approved">Approved</option>
        <option value="rejected">Rejected</option>
        <option value="all">All</option>
      </select>
    </div>
  </div>

  <div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50"><tr><th class="p-2">Student</th><th class="p-2">Trainer</th><th class="p-2">Type</th><th class="p-2">Status</th><th class="p-2 text-right">Actions</th></tr></thead>
      <tbody>
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="border-t">
          <td class="p-2"><?php echo e($c->student->name); ?> <div class="text-xs text-gray-500"><?php echo e($c->student->email); ?></div></td>
          <td class="p-2"><?php echo e($c->trainer->name); ?></td>
          <td class="p-2"><?php echo e($c->type); ?></td>
          <td class="p-2">
            <span class="text-xs px-2 py-1 rounded <?php echo e($c->status==='approved'?'bg-emerald-100 text-emerald-700' : ($c->status==='rejected'?'bg-red-100 text-red-700':'bg-yellow-100 text-yellow-700')); ?>"><?php echo e(ucfirst($c->status)); ?></span>
          </td>
          <td class="p-2 text-right">
            <!--[if BLOCK]><![endif]--><?php if($c->status === 'pending'): ?>
              <button wire:click="approve(<?php echo e($c->id); ?>)" class="px-2 py-1 bg-emerald-600 text-white rounded text-xs">Approve</button>
              <button onclick="return showRejectModal(<?php echo e($c->id); ?>)" class="px-2 py-1 border rounded text-xs">Reject</button>
            <?php else: ?>
              <a href="<?php echo e(route('certificates.public', $c->certificate_number)); ?>" class="text-xs text-indigo-600">View</a>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>
    <div class="p-3"><?php echo e($certs->links()); ?></div>
  </div>
</div>

<script>
  function showRejectModal(id) {
    const note = prompt('Enter rejection note (optional)');
    if(note === null) return;
    Livewire.emit('reject', id, note);
  }
</script><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views\livewire/admin/certificate-manager.blade.php ENDPATH**/ ?>