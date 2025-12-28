

<?php $__env->startSection('dashboard-content'); ?>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Student Scores</h1>
        <p class="text-slate-500">Overview of student performance across your courses.</p>
    </div>

    <?php if($courses->isEmpty()): ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'icons.scores'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            <h3 class="text-lg font-medium text-slate-900">No courses available</h3>
            <p class="text-slate-500 max-w-sm mx-auto mt-2">
                You need to create courses and assign work before viewing scores.
            </p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $stat = $stats[$course->id] ?? null; ?>
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-semibold text-lg text-slate-900 mb-1"><?php echo e($course->title); ?></h3>
                    <p class="text-sm text-slate-500 mb-4"><?php echo e($course->students()->count()); ?> Students Enrolled</p>
                    
                    <div class="flex items-center gap-6 mt-4">
                        <div class="flex-1">
                            <div class="text-3xl font-bold text-slate-800">
                                <?php echo e($stat && $stat['avg_score'] ? number_format($stat['avg_score'], 1) : '-'); ?>

                            </div>
                            <div class="text-xs font-medium text-slate-500 uppercase tracking-wide mt-1">Avg Score</div>
                        </div>
                        <div class="h-10 w-px bg-slate-100"></div>
                        <div class="flex-1">
                            <div class="text-3xl font-bold text-slate-800">
                                <?php echo e($stat['submission_count'] ?? 0); ?>

                            </div>
                            <div class="text-xs font-medium text-slate-500 uppercase tracking-wide mt-1">Submissions</div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(request()->ajax() ? 'layouts.plain' : 'dashboards.shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/trainer/scores/index.blade.php ENDPATH**/ ?>