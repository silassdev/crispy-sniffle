<div>
  <div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-2">
      <input wire:model.debounce.300ms="search" placeholder="Search students by name or email" class="px-3 py-2 border rounded w-72" />
      <button wire:click="$refresh" class="px-3 py-2 border rounded">Refresh</button>
    </div>
    <div class="text-sm text-gray-500">Showing <?php echo e($students->total()); ?> students</div>
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
        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td class="px-4 py-3"><?php echo e($s->name); ?></td>
            <td class="px-4 py-3"><?php echo e($s->email); ?></td>
            <td class="px-4 py-3"><?php echo e($s->created_at->toDateString()); ?></td>
            <td class="px-4 py-3 text-right">
              <button wire:click="$set('viewingId', <?php echo e($s->id); ?>)" class="inline-block mr-2 text-sm px-3 py-1 border rounded">View</button>

              <button wire:click="confirmDelete(<?php echo e($s->id); ?>)" class="inline-block text-sm px-3 py-1 bg-red-600 text-white rounded">
                Delete
              </button>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">No students found.</td></tr>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>

    <div class="p-4">
      <?php echo e($students->links()); ?>

    </div>
  </div>

  
  <!--[if BLOCK]><![endif]--><?php if($confirmDeleteId): ?>
    <div class="fixed inset-0 z-40 flex items-center justify-center bg-black/40">
      <div class="bg-white p-6 rounded shadow">
        <h3 class="font-semibold mb-2">Confirm delete</h3>
        <p class="text-sm text-gray-600 mb-4">This will permanently remove the student.</p>
        <div class="flex gap-2">
          <button wire:click="destroyConfirmed" class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
          <button wire:click="$set('confirmDeleteId', null)" class="px-4 py-2 border rounded">Cancel</button>
        </div>
      </div>
    </div>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

  
  <!--[if BLOCK]><![endif]--><?php if($viewingId && $viewingStudent): ?>
    <div class="fixed inset-0 z-50 flex items-start sm:items-center justify-center p-4 bg-black/40">
      <div class="bg-white w-full sm:max-w-2xl rounded shadow p-6 overflow-auto max-h-[80vh]">
        <div class="flex gap-6">
          <div class="w-1/3">
            <div class="w-full h-40 bg-gray-100 rounded flex items-center justify-center text-xl font-bold">
              <?php echo e(strtoupper(substr($viewingStudent->name,0,1))); ?>

            </div>
            <div class="mt-3 text-sm">
              <div class="font-medium"><?php echo e($viewingStudent->name); ?></div>
              <div class="text-gray-500"><?php echo e($viewingStudent->email); ?></div>
              <div class="text-xs text-gray-400">Joined: <?php echo e($viewingStudent->created_at->toDayDateTimeString()); ?></div>
            </div>
          </div>

          <div class="flex-1">
            <h3 class="text-lg font-semibold mb-2">Profile & stats</h3>
            <div class="grid grid-cols-2 gap-3 text-sm text-gray-700">
              
              <div><strong>Phone:</strong> <?php echo e($viewingStudent->phone ?? '—'); ?></div>
              <div><strong>Location:</strong> <?php echo e($viewingStudent->location ?? '—'); ?></div>
              <div><strong>Courses enrolled:</strong> <?php echo e($viewingStudent->courses_count ?? '0'); ?></div>
              <div><strong>Completed:</strong> <?php echo e($viewingStudent->completed_courses ?? '0'); ?></div>
              <div><strong>Total score:</strong> <?php echo e($viewingStudent->total_score ?? '0'); ?></div>
              <div><strong>Badges:</strong> <?php echo e(implode(', ', $viewingStudent->badges ?? []) ?: '—'); ?></div>
              <div class="col-span-2"><strong>Bio:</strong> <?php echo e($viewingStudent->bio ?? '—'); ?></div>
              <div class="col-span-2"><strong>Preferences:</strong> <?php echo e($viewingStudent->preferences ?? '—'); ?></div>
              <div class="col-span-2"><strong>Certificates / Links:</strong> 
                <!--[if BLOCK]><![endif]--><?php if(!empty($viewingStudent->certificates)): ?>
                  <ul class="list-disc ml-4 text-sm">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $viewingStudent->certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><a href="<?php echo e($c['url']); ?>" target="_blank" class="text-blue-600 hover:underline"><?php echo e($c['title'] ?? 'certificate'); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                  </ul>
                <?php else: ?>
                  — 
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
              </div>
            </div>

            <div class="mt-4 flex gap-2">
              <a href="<?php echo e(route('admin.students.show', $viewingStudent->id)); ?>" class="px-3 py-1 border rounded">Full profile</a>
              <button wire:click="closeModal()" class="px-3 py-1 border rounded">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

  <style>.loader{width:14px;height:14px;border:2px solid rgba(0,0,0,0.08);border-top-color:#111;border-radius:50%;animation:spin .9s linear infinite}@keyframes spin{to{transform:rotate(360deg)}}</style>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/student-list.blade.php ENDPATH**/ ?>