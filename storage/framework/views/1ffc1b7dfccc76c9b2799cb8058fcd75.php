<div>
  <div class="flex items-center justify-between mb-4 gap-3">
    <div class="flex items-center gap-2">
      <input wire:model.debounce.300ms="search" type="text" placeholder="Search trainers by name or email" class="px-3 py-2 border rounded w-72" />
      <button wire:click="$refresh" class="px-3 py-2 border rounded">Refresh</button>
    </div>

    <div class="text-sm text-gray-500">
      Pending: <strong><?php echo e($pending->count()); ?></strong> • Approved total: <strong><?php echo e($approved->total()); ?></strong>
    </div>
  </div>

  
  <div class="mb-6">
    <h3 class="text-lg font-semibold mb-2">Pending trainers</h3>

    <!--[if BLOCK]><![endif]--><?php if($pending->isEmpty()): ?>
      <div class="p-4 rounded border text-sm text-gray-500">No pending trainers.</div>
    <?php else: ?>
      <div class="grid gap-3">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="p-3 bg-white rounded border flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-sm font-semibold">
                <?php echo e(strtoupper(substr($t->name,0,1))); ?>

              </div>
              <div>
                <div class="font-medium"><?php echo e($t->name); ?></div>
                <div class="text-xs text-gray-500"><?php echo e($t->email); ?></div>
                <div class="text-xs text-gray-400">Registered <?php echo e($t->created_at->diffForHumans()); ?></div>
              </div>
            </div>

            <div class="flex items-center gap-2">
              <button wire:click="$set('viewingId', <?php echo e($t->id); ?>)" class="px-2 py-1 text-sm rounded border">View</button>

              <button wire:click="approve(<?php echo e($t->id); ?>)"
                      wire:loading.attr="disabled"
                      wire:target="approve(<?php echo e($t->id); ?>)"
                      class="px-3 py-1 text-sm rounded bg-emerald-600 text-white hover:bg-emerald-700">
                <span wire:loading wire:target="approve(<?php echo e($t->id); ?>)" class="loader inline-block mr-2"></span>
                Approve
              </button>

              <button wire:click="reject(<?php echo e($t->id); ?>)"
                      wire:loading.attr="disabled"
                      wire:target="reject(<?php echo e($t->id); ?>)"
                      class="px-3 py-1 text-sm rounded bg-yellow-500 text-white hover:bg-yellow-600">
                <span wire:loading wire:target="reject(<?php echo e($t->id); ?>)" class="loader inline-block mr-2"></span>
                Reject
              </button>

              <button wire:click="confirmDelete(<?php echo e($t->id); ?>)" class="px-3 py-1 text-sm rounded bg-red-600 text-white hover:bg-red-700">
                Delete
              </button>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
  </div>

  
  <div class="bg-white rounded shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left">Name</th>
          <th class="px-4 py-2 text-left">Email</th>
          <th class="px-4 py-2 text-left">Joined</th>
          <th class="px-4 py-2 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100">
        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $approved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td class="px-4 py-3"><?php echo e($t->name); ?></td>
            <td class="px-4 py-3"><?php echo e($t->email); ?></td>
            <td class="px-4 py-3"><?php echo e($t->created_at->toDateString()); ?></td>
            <td class="px-4 py-3 text-right">
              <button wire:click="$set('viewingId', <?php echo e($t->id); ?>)" class="inline-block mr-2 text-sm px-3 py-1 border rounded">View</button>

              <a href="<?php echo e(route('admin.trainers.show', $t->id)); ?>" class="inline-block mr-2 text-sm px-3 py-1 border rounded">Profile</a>

              <button wire:click="confirmDelete(<?php echo e($t->id); ?>)"
                      wire:loading.attr="disabled"
                      wire:target="destroyConfirmed"
                      class="inline-block text-sm px-3 py-1 bg-red-600 text-white rounded">
                <span wire:loading wire:target="destroyConfirmed" class="loader inline-block mr-2"></span>Delete
              </button>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="4" class="px-4 py-6 text-center text-gray-500">No approved trainers yet.</td>
          </tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>

    <div class="p-4">
      <?php echo e($approved->links()); ?>

    </div>
  </div>

  
  <!--[if BLOCK]><![endif]--><?php if($confirmDeleteId): ?>
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
      <div class="bg-white p-6 rounded shadow">
        <h3 class="font-semibold mb-3">Confirm delete</h3>
        <p class="text-sm text-gray-600 mb-4">This action is permanent. Are you sure?</p>
        <div class="flex gap-2">
          <button wire:click="destroyConfirmed" class="px-4 py-2 bg-red-600 text-white rounded">Yes, delete</button>
          <button wire:click="$set('confirmDeleteId', null)" class="px-4 py-2 border rounded">Cancel</button>
        </div>
      </div>
    </div>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

  
  <!--[if BLOCK]><![endif]--><?php if($viewingId && $viewingTrainer): ?>
    <div class="fixed inset-0 z-50 flex items-start sm:items-center justify-center p-4 bg-black/40">
      <div class="bg-white w-full sm:max-w-2xl rounded shadow p-6 overflow-auto max-h-[80vh]">
        <div class="flex gap-6">
          <div class="w-1/3">
            <div class="w-full h-40 bg-gray-100 rounded flex items-center justify-center text-xl font-bold">
              <?php echo e(strtoupper(substr($viewingTrainer->name,0,1))); ?>

            </div>
            <div class="mt-3 text-sm">
              <div class="font-medium"><?php echo e($viewingTrainer->name); ?></div>
              <div class="text-gray-500"><?php echo e($viewingTrainer->email); ?></div>
              <div class="text-xs text-gray-400">Joined: <?php echo e($viewingTrainer->created_at->toDayDateTimeString()); ?></div>
            </div>
          </div>

          <div class="flex-1">
            <h3 class="text-lg font-semibold mb-2">Profile</h3>
            <div class="grid grid-cols-2 gap-3 text-sm text-gray-700">
              <div><strong>Bio:</strong> <?php echo e($viewingTrainer->bio ?? '—'); ?></div>
              <div><strong>Phone:</strong> <?php echo e($viewingTrainer->phone ?? '—'); ?></div>
              
              <div><strong>Approved:</strong>
       <?php echo e($viewingTrainer->approved
      ? ($viewingTrainer->approved_at?->toDayDateTimeString() ?? 'Yes')
      : 'No'); ?>

            </div>

     <div><strong>Rejected:</strong>
       <?php echo e($viewingTrainer->rejected
      ? ($viewingTrainer->rejected_at?->toDayDateTimeString() ?? 'Yes')
      : 'No'); ?>

             </div>

              <div class="col-span-2 mt-2"><strong>Other info:</strong> <?php echo e($viewingTrainer->additional_info ?? '—'); ?></div>
            </div>

            <div class="mt-4 flex gap-2">
              <!--[if BLOCK]><![endif]--><?php if(! $viewingTrainer->approved && ! $viewingTrainer->rejected): ?>
                <button wire:click="approve(<?php echo e($viewingTrainer->id); ?>)" class="px-3 py-1 bg-emerald-600 text-white rounded">Approve</button>
                <button wire:click="reject(<?php echo e($viewingTrainer->id); ?>)" class="px-3 py-1 bg-yellow-500 text-white rounded">Reject</button>
              <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
              <button wire:click="closeModal()" class="px-3 py-1 border rounded">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/trainer-list.blade.php ENDPATH**/ ?>