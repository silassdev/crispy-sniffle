

<?php $__env->startSection('dashboard-content'); ?>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">My Courses</h1>
        <p class="text-slate-500">Continue learning where you left off.</p>
    </div>

    <?php if($courses->isEmpty()): ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'icons.courses'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            <h3 class="text-lg font-medium text-slate-900">You are not enrolled in any courses</h3>
            <p class="text-slate-500 max-w-sm mx-auto mt-2">
                Browse our catalog and start learning today!
            </p>
            <a href="<?php echo e(route('courses.index')); ?>" class="inline-flex items-center gap-2 mt-6 px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition-colors">
                Browse Catalog
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col group hover:shadow-md transition-shadow">
                    <div class="relative h-40 bg-slate-100">
                        <?php if($course->hasMedia('illustration')): ?>
                            <img src="<?php echo e($course->getFirstMediaUrl('illustration', 'thumb')); ?>" alt="<?php echo e($course->title); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-sky-50 text-sky-200">
                                <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'icons.courses'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-16 h-16']); ?>
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
                        <?php endif; ?>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="mb-auto">
                            <h3 class="font-semibold text-lg text-slate-900 group-hover:text-sky-600 transition-colors line-clamp-2">
                                <a href="<?php echo e(route('courses.show', $course->slug)); ?>">
                                    <?php echo e($course->title); ?>

                                </a>
                            </h3>
                            <p class="text-sm text-slate-500 mt-2 line-clamp-2">
                                <?php echo e($course->excerpt); ?>

                            </p>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                             
                            <span class="text-xs font-medium px-2 py-1 bg-emerald-50 text-emerald-700 rounded-full">
                                Enrolled since <?php echo e($course->pivot->created_at->format('M Y')); ?>

                            </span>
                            
                            <a href="<?php echo e(route('courses.show', $course->slug)); ?>" class="text-sm font-medium text-sky-600 hover:text-sky-700">
                                Continue &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(request()->ajax() ? 'layouts.plain' : 'dashboards.shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/student/courses/index.blade.php ENDPATH**/ ?>