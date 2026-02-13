<div class="space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-xl font-semibold">Jobs</h2>
    <div class="flex items-center gap-2">
      <input type="text" wire:model.debounce.300ms="search" placeholder="Search jobs..." class="border rounded px-3 py-1" />
      <button wire:click="create" class="px-3 py-1 bg-indigo-600 text-white rounded">New Job</button>
    </div>
  </div>

  <div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-3 text-left">Company</th>
          <th class="p-3 text-left">Title</th>
          <th class="p-3 text-left">Type</th>
          <th class="p-3 text-left">Location</th>
          <th class="p-3 text-left">Status</th>
          <th class="p-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr class="border-t">
            <td class="p-3 flex items-center gap-3">
              <?php $logo = $job->getFirstMedia('company_logos'); ?>
              <!--[if BLOCK]><![endif]--><?php if($logo): ?>
                <img src="<?php echo e($logo->getUrl('logo_small')); ?>" alt="<?php echo e($job->company_name); ?>" class="w-10 h-10 object-cover rounded">
              <?php else: ?>
                <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center text-xs"><?php echo e(strtoupper(substr($job->company_name ?: 'J', 0, 1))); ?></div>
              <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
              <div><?php echo e($job->company_name); ?></div>
            </td>
            <td class="p-3"><?php echo e($job->title); ?></td>
            <td class="p-3"><?php echo e($job->employment_type); ?></td>
            <td class="p-3"><?php echo e($job->location); ?></td>
            <td class="p-3">
              <!--[if BLOCK]><![endif]--><?php if($job->is_active): ?>
                <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded">Open</span>
              <?php else: ?>
                <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded">Closed</span>
              <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </td>
            <td class="p-3 text-right">
              <button wire:click="edit(<?php echo e($job->id); ?>)" class="px-2 py-1 border rounded text-xs">Edit</button>
              <button wire:click="toggleActive(<?php echo e($job->id); ?>)" class="px-2 py-1 border rounded text-xs"><?php echo e($job->is_active ? 'Close' : 'Open'); ?></button>
              <button wire:click="confirmDelete(<?php echo e($job->id); ?>)" class="px-2 py-1 border rounded text-xs text-red-600">Delete</button>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      </tbody>
    </table>

    <div class="p-3">
      <?php echo e($jobs->links()); ?>

    </div>
  </div>

  
  <div x-data="{ open: <?php if ((object) ('showForm') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showForm'->value()); ?>')<?php echo e('showForm'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showForm'); ?>')<?php endif; ?> }" x-show="open" x-cloak class="fixed inset-0 z-50 flex items-start justify-center pt-16">
    <div class="absolute inset-0 bg-black/40" @click="$wire.resetForm()"></div>

    <div class="relative z-10 w-full max-w-2xl bg-white rounded shadow-lg p-6">
      <h3 class="font-semibold mb-4"><?php echo e($jobId ? 'Edit Job' : 'Create Job'); ?></h3>

      <div class="grid grid-cols-1 gap-3">
        <input wire:model.defer="title" type="text" placeholder="Job title" class="border rounded px-3 py-2" />
        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-600"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

        <div class="grid grid-cols-2 gap-2">
          <input wire:model.defer="company_name" type="text" placeholder="Company name" class="border rounded px-3 py-2" />
          <input wire:model.defer="employment_type" type="text" placeholder="Employment type" class="border rounded px-3 py-2" />
        </div>

        <div class="grid grid-cols-2 gap-2">
          <input wire:model.defer="location" type="text" placeholder="Location" class="border rounded px-3 py-2" />
          <input wire:model.defer="salary" type="text" placeholder="Salary (optional)" class="border rounded px-3 py-2" />
        </div>

        <input wire:model.defer="excerpt" type="text" placeholder="Short excerpt" class="border rounded px-3 py-2" />
        <textarea wire:model.defer="description" rows="6" placeholder="Full job description (markdown allowed)" class="border rounded px-3 py-2"></textarea>

        <input wire:model.defer="tech_stack" type="text" placeholder="Tech stack (comma separated)" class="border rounded px-3 py-2" />
        <div class="flex items-center gap-3">
          <label class="flex items-center gap-2">
            <input wire:model="is_active" type="checkbox" class="form-checkbox" />
            <span>Open for applications</span>
          </label>

          <div class="ml-auto">
            <input id="logoUpload" type="file" wire:model="logo" accept="image/*" class="hidden" />
            <label for="logoUpload" class="px-3 py-1 border rounded cursor-pointer text-sm">Upload logo</label>
            <div class="text-xs text-gray-500 mt-1">Max 1MB. Will be optimized to 120×120.</div>
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-600"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
          </div>
        </div>

        <div class="flex justify-end gap-2 pt-3">
          <button @click="open=false; $wire.resetForm()" class="px-3 py-1 border rounded">Cancel</button>
          <button wire:click="save" class="px-3 py-1 bg-indigo-600 text-white rounded">Save</button>
        </div>
      </div>
    </div>
  </div>

  
  <div id="deleteModal" x-data x-show="false" x-cloak @open-delete-job-modal.window=" $el.style.display='block'; $el.__x_show = true">
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/job-manager.blade.php ENDPATH**/ ?>