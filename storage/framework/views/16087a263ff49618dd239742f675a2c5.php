<?php
    $user = auth()->user();
    $role = strtolower($role ?? ($user->role ?? 'student'));
    $colors = [
        'admin'   => 'bg-indigo-600 text-white',
        'trainer' => 'bg-emerald-600 text-white',
        'student' => 'bg-sky-600 text-white',
    ];
    $themeClass = $colors[$role] ?? 'bg-gray-700 text-white';
    $currentRoute = Route::currentRouteName();
    $activeSection = $section ?? request('section') ?? 'overview';
    
    $isActive = fn($key, $route) => ($activeSection === $key || $currentRoute === $route) ? $themeClass : 'text-slate-500 hover:bg-slate-50';
    
    $menuItems = match($role) {
        'admin' => [
            ['key' => 'students', 'label' => 'Students', 'icon' => 'students', 'route_suffix' => 'students.index'],
            ['key' => 'trainers', 'label' => 'Trainers', 'icon' => 'trainers', 'route_suffix' => 'trainers.index'],
            ['key' => 'admins', 'label' =>   'Admins', 'icon' => 'admins', 'route_suffix' => 'admins.index'],
            ['key' => 'community', 'label' => 'Community', 'icon' => 'community', 'route_suffix' => 'community'],
            ['key' => 'courses', 'label' =>    'Courses', 'icon' => 'courses', 'route_suffix' => 'courses'],
            ['key' => 'jobs', 'label' => 'Jobs', 'icon' => 'jobs', 'route_suffix' => 'jobs'],
            ['key' => 'feedback', 'label' => 'Feedback', 'icon' => 'feedback', 'route_suffix' => 'feedback.index'],
            ['key' => 'certificate', 'label' => 'Certificate', 'icon' => 'certificate', 'route_suffix' => 'certificates.index'],
            ['key' => 'newsletter', 'label' => 'Newsletter', 'icon' => 'newsletter', 'route_suffix' => 'newsletter'],
        ],  
        'trainer' => [
            ['key' => 'assignment', 'label' => 'Assessment', 'icon' => 'assignment', 'route_suffix' => 'assignment'],
            ['key' => 'scores', 'label' => 'Scores', 'icon' => 'scores', 'route_suffix' => 'scores'],
            ['key' => 'course', 'label' => 'Courses', 'icon' => 'course', 'route_suffix' => 'courses.index'],
            ['key' => 'students', 'label' => 'Students', 'icon' => 'students', 'route_suffix' => 'students'],
            ['key' => 'certificate', 'label' => 'Certificate', 'icon' => 'certificate', 'route_suffix' => 'certificates.index'],
        ],
        default => [
            ['key' => 'courses', 'label' => 'Courses', 'icon' => 'courses', 'route_suffix' => 'courses.index'],
            ['key' => 'scores', 'label' => 'Scores', 'icon' => 'scores', 'route_suffix' => 'scores'],
            ['key' => 'certificate', 'label' => 'Certificate', 'icon' => 'certificate', 'route_suffix' => 'certificates'],
            ['key' => 'assignment', 'label' => 'Assessment', 'icon' => 'assignment', 'route_suffix' => 'assessments'],
        ],
    };
?>

<div class="p-4">
    
    <div class="mb-4 px-3 py-2 rounded-md <?php echo e($themeClass); ?>">
        <div class="text-xs font-semibold uppercase tracking-wider opacity-75"><?php echo e($role); ?></div>
        <div class="text-sm font-medium truncate"><?php echo e($user->name ?? 'User'); ?></div>
    </div>

    
    <nav class="space-y-1">
        <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $targetRoute = $role . '.' . $item['route_suffix']; ?>
            <?php if(Route::has($targetRoute)): ?>
                <a href="<?php echo e(route($targetRoute)); ?>" 
                   data-route="<?php echo e(route($targetRoute)); ?>"
                   data-section="<?php echo e($item['key']); ?>"
                   class="ajax-link group flex items-center gap-3 px-3 py-2.5 rounded-md transition-all duration-200 <?php echo e($isActive($item['key'], $targetRoute)); ?>">
                    <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'icons.'.$item['icon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 flex-shrink-0']); ?>
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
                    <span class="text-sm font-medium"><?php echo e($item['label']); ?></span>
                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/partials/sidebar.blade.php ENDPATH**/ ?>