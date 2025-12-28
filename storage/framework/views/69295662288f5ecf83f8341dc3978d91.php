

<?php $__env->startSection('dashboard-content'); ?>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Certificates</h1>
            <p class="text-slate-500">View and issue certificates to your students.</p>
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
                                    <?php echo e($cert->student->name ?? 'Unknown'); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <?php echo e($cert->course->title ?? '-'); ?>

                                </td>
                                <td class="px-6 py-4">
                                     <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                        <?php echo e(match($cert->status) {
                                            'approved' => 'bg-emerald-100 text-emerald-700',
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                            default => 'bg-slate-100 text-slate-700'
                                        }); ?>">
                                        <?php echo e(ucfirst($cert->status)); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-3">
                                    <?php if($cert->status === 'approved'): ?>
                                        <a href="<?php echo e(route('trainer.certificates.show', $cert->id)); ?>" class="text-sky-600 hover:text-sky-700 font-medium">
                                            View
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">
                <?php echo e($certs->links()); ?>

            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(request()->ajax() ? 'layouts.plain' : 'dashboards.shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/trainer/certificates/index.blade.php ENDPATH**/ ?>