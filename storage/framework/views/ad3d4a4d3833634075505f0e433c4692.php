

<?php $__env->startSection('header'); ?>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <?php echo e(__('Courses Management')); ?>

    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center py-20">
                    <div class="mb-4">
                        <?php if (isset($component)) { $__componentOriginal28c8bc29b72db04c11749ccfa96d43c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal28c8bc29b72db04c11749ccfa96d43c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.courses','data' => ['class' => 'w-16 h-16 mx-auto text-indigo-500 opacity-20']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.courses'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-16 h-16 mx-auto text-indigo-500 opacity-20']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal28c8bc29b72db04c11749ccfa96d43c5)): ?>
<?php $attributes = $__attributesOriginal28c8bc29b72db04c11749ccfa96d43c5; ?>
<?php unset($__attributesOriginal28c8bc29b72db04c11749ccfa96d43c5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal28c8bc29b72db04c11749ccfa96d43c5)): ?>
<?php $component = $__componentOriginal28c8bc29b72db04c11749ccfa96d43c5; ?>
<?php unset($__componentOriginal28c8bc29b72db04c11749ccfa96d43c5); ?>
<?php endif; ?>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700">Courses Management</h3>
                    <p class="text-gray-500 mt-2">This module is currently being developed. Check back soon!</p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/courses.blade.php ENDPATH**/ ?>