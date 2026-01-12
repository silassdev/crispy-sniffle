

<?php $__env->startSection('dashboard-content'); ?>
<div class="space-y-3">
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-bold text-slate-800">Certificates</h1>
      <p class="text-slate-500">View and issue certificates to your students.</p>
    </div>

    <div class="flex items-center gap-3">
      <a href="<?php echo e(route('trainer.certificates.create')); ?>" class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">
        Request certificate
      </a>
    </div>
  </div>

  <div class="flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-between">
    <div class="flex gap-2 w-full sm:w-auto">
      <input
        wire:model.debounce.300ms="q"
        type="search"
        aria-label="Search students, email, course or certificate"
        placeholder="Search student, email, course..."
        class="border rounded px-3 py-2 w-full sm:w-64 text-sm"
      />
      <select wire:model="status" class="border rounded px-2 py-2 text-sm">
        <option value="all">All</option>
        <option value="pending">Pending</option>
        <option value="approved">Approved</option>
        <option value="rejected">Rejected</option>
      </select>

      <select wire:model="type" class="border rounded px-2 py-2 text-sm">
        <option value="all">All types</option>
        <option value="course_completion">Course completion</option>
        <option value="graduation">Graduation</option>
        <!-- add other types -->
      </select>
    </div>

    <div class="flex items-center gap-2">
      <label for="perPage" class="text-sm text-slate-600 hidden sm:inline">Per page</label>
      <select id="perPage" wire:model="perPage" class="border rounded px-2 py-2 text-sm">
        <option>10</option>
        <option>15</option>
        <option>25</option>
        <option>50</option>
      </select>
    </div>
  </div>

  <?php if($certs->isEmpty()): ?>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
      <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'icons.certificate'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-8 h-8 text-slate-400']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
      </div>
      <h3 class="text-lg font-medium text-slate-900">No certificates yet</h3>
      <p class="text-slate-500 max-w-sm mx-auto mt-2">
        Certificates you request or issue will be listed here.
      </p>
    </div>
  <?php else: ?>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
          <thead class="bg-slate-50 text-slate-700 font-medium uppercase text-xs">
            <tr>
              <th class="px-6 py-4">Certificate ID</th>
              <th class="px-6 py-4">Student</th>
              <th class="px-6 py-4">Type</th>
              <th class="px-6 py-4">Course</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <?php $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-6 py-4 font-mono text-slate-500">
                  <?php echo e($cert->certificate_number ?? 'Pending'); ?>

                </td>

                <td class="px-6 py-4">
                  <div class="font-medium text-slate-800"><?php echo e($cert->student->name ?? 'Unknown'); ?></div>
                  <div class="text-xs text-slate-500"><?php echo e($cert->student->email ?? ''); ?></div>
                </td>

                <td class="px-6 py-4 text-sm text-slate-600">
                  <?php echo e(str_replace('_', ' ', ucfirst($cert->type ?? '-'))); ?>

                </td>

                <td class="px-6 py-4">
                  <?php echo e(optional($cert->course)->title ?? '-'); ?>

                </td>

                <td class="px-6 py-4">
                  <?php
                    $badgeClass = match($cert->status) {
                      'approved' => 'bg-emerald-100 text-emerald-700',
                      'pending' => 'bg-amber-100 text-amber-700',
                      'rejected' => 'bg-red-100 text-red-700',
                      default => 'bg-slate-100 text-slate-700'
                    };
                  ?>
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium <?php echo e($badgeClass); ?>">
                    <?php echo e(ucfirst($cert->status)); ?>

                  </span>
                </td>

                <td class="px-6 py-4 text-right">
                  <?php if($cert->status === 'approved'): ?>
                    <a href="<?php echo e(route('trainer.certificates.show', $cert->id)); ?>" class="text-sky-600 hover:text-sky-700 font-medium">
                      View
                    </a>
                  <?php else: ?>
                    <a href="<?php echo e(route('trainer.certificates.show', $cert->id)); ?>" class="text-xs px-2 py-1 border rounded">View</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>

      <div class="px-6 py-4 flex items-center justify-between">
        <div class="text-sm text-slate-600">Showing <?php echo e($certs->firstItem() ?? 0); ?>–<?php echo e($certs->lastItem() ?? 0); ?> of <?php echo e($certs->total()); ?> certificates</div>
        <div><?php echo e($certs->links()); ?></div>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(request()->ajax() ? 'layouts.plain' : 'dashboards.shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/trainer/certificates/index.blade.php ENDPATH**/ ?>