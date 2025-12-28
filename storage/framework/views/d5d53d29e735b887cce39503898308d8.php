

<?php $__env->startSection('dashboard-content'); ?>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">My Certificates</h1>
        <p class="text-slate-500">View and download your earned certificates.</p>
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
                Complete courses to earn certificates. Once you verify your completion, your certificates will appear here.
            </p>
            <a href="<?php echo e(route('student.courses.index')); ?>" class="inline-flex items-center gap-2 mt-6 px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition-colors">
                Browse Courses
            </a>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-700 font-medium uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">Certificate ID</th>
                            <th class="px-6 py-4">Course</th>
                            <th class="px-6 py-4">Issued On</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-mono text-slate-500">
                                    <?php echo e($cert->certificate_number); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-900"><?php echo e($cert->course->title ?? 'Unknown Course'); ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo e($cert->created_at->format('M d, Y')); ?>

                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-3">
                                    <a href="<?php echo e(route('certificates.public', $cert->certificate_number)); ?>" target="_blank" class="text-sky-600 hover:underline font-medium">
                                        View
                                    </a>
                                    <span class="text-slate-300">|</span>
                                    <a href="<?php echo e(route('certificates.pdf.download', $cert->id)); ?>" class="text-slate-500 hover:text-slate-700">
                                        Download PDF
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(request()->ajax() ? 'layouts.plain' : 'dashboards.shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/student/certificates/index.blade.php ENDPATH**/ ?>