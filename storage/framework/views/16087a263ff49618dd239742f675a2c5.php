<?php
    $user = auth()->user();
    // Default to student if role is missing, strictly lowercase for route matching
    $role = strtolower($role ?? ($user->role ?? 'student')); 
    
    $colors = [
        'admin'   => 'bg-indigo-600 text-white',
        'trainer' => 'bg-emerald-600 text-white',
        'student' => 'bg-sky-600 text-white',
    ];
    $themeClass = $colors[$role] ?? 'bg-gray-700 text-white';
    
    $currentRoute = Route::currentRouteName();
    $activeSection = request('section') ?? 'overview';
    
    $isActive = fn($key, $route) => 
        ($activeSection === $key || $currentRoute === $route) 
        ? $themeClass 
        : 'text-slate-500 hover:bg-slate-50';

  if ($role === 'admin') {
    $menuItems = [
        ['key' => 'overview',      'label' => 'Overview',             'icon' => 'overview',      'route_suffix' => 'dashboard'],
        ['key' => 'students',      'label' => 'Students',             'icon' => 'students',      'route_suffix' => 'students.index'],
        ['key' => 'trainers',      'label' => 'Trainers',             'icon' => 'trainers',      'route_suffix' => 'trainers.index'],
        ['key' => 'admins',        'label' => 'Admins',               'icon' => 'admins',        'route_suffix' => 'admins.index'],
        ['key' => 'community',     'label' => 'Community',            'icon' => 'community',     'route_suffix' => 'community'],
        ['key' => 'comments',      'label' => 'Comments',             'icon' => 'comments',      'route_suffix' => 'comments'],
        ['key' => 'posts',         'label' => 'Posts',                'icon' => 'comments',      'route_suffix' => 'posts'],
        ['key' => 'feedback',      'label' => 'Feedback',             'icon' => 'feedback',      'route_suffix' => 'feedback'],
        ['key' => 'other-actions', 'label' => 'Other Actions',        'icon' => 'others',        'route_suffix' => 'other-actions'],
        ['key' => 'certify',       'label' => 'Certify & Achievement','icon' => 'comments',      'route_suffix' => 'certify'], // Example
    ];
    } elseif ($role === 'trainer') {
     $menuItems = [
        ['key' => 'overview',      'label' => 'Overview',             'icon' => 'overview',      'route_suffix' => 'dashboard'],
        ['key' => 'students',      'label' => 'Students',             'icon' => 'students',      'route_suffix' => 'students.index'],
        ['key' => 'trainers',      'label' => 'Trainers',             'icon' => 'trainers',      'route_suffix' => 'trainers.index'],
        ['key' => 'admins',        'label' => 'Admins',               'icon' => 'admins',        'route_suffix' => 'admins.index'],
        ['key' => 'community',     'label' => 'Community',            'icon' => 'community',     'route_suffix' => 'community'],
        ['key' => 'comments',      'label' => 'Comments',             'icon' => 'comments',      'route_suffix' => 'comments'],
        ['key' => 'posts',         'label' => 'Posts',                'icon' => 'comments',      'route_suffix' => 'posts'],
        ['key' => 'feedback',      'label' => 'Feedback',             'icon' => 'feedback',      'route_suffix' => 'feedback'],
        ['key' => 'other-actions', 'label' => 'Other Actions',        'icon' => 'others',        'route_suffix' => 'other-actions'],
        ['key' => 'certify',       'label' => 'Certify & Achievement','icon' => 'comments',      'route_suffix' => 'certify'], // Example
    ];
    } elseif ($role === 'student') {
    $menuItems = [
        ['key' => 'overview',      'label' => 'Overview',             'icon' => 'overview',      'route_suffix' => 'dashboard'],
        ['key' => 'courses',       'label' => 'Courses',              'icon' => 'courses',       'route_suffix' => 'courses.index'],
        ['key' => 'trainers',      'label' => 'Trainers',             'icon' => 'trainers',      'route_suffix' => 'trainers.index'],
        ['key' => 'admins',        'label' => 'Admins',               'icon' => 'admins',        'route_suffix' => 'admins.index'],
        ['key' => 'community',     'label' => 'Community',            'icon' => 'community',     'route_suffix' => 'community'],
        ['key' => 'comments',      'label' => 'Comments',             'icon' => 'comments',      'route_suffix' => 'comments'],
        ['key' => 'posts',         'label' => 'Posts',                'icon' => 'comments',      'route_suffix' => 'posts'],
        ['key' => 'feedback',      'label' => 'Feedback',             'icon' => 'feedback',      'route_suffix' => 'feedback'],
        ['key' => 'other-actions', 'label' => 'Other Actions',        'icon' => 'others',        'route_suffix' => 'other-actions'],
        ['key' => 'certify',       'label' => 'Certify & Achievement','icon' => 'comments',      'route_suffix' => 'certify'], // Example
    ];
 }
?>

<aside id="admin-sidebar" class="w-64 min-h-screen bg-white border-r transition-all duration-300" data-role="<?php echo e($role); ?>">
    <div class="p-4 flex flex-col h-full">

        
        <div class="px-2 mb-4">
            <div class="rounded p-2 <?php echo e($themeClass); ?> flex items-center gap-3 shadow-sm">
                <div class="sidebar-label font-semibold capitalize"><?php echo e($role); ?> Console</div>
            </div>
        </div>

        
        <nav class="space-y-1 flex-1 overflow-auto">
            <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    // Construct the expected route name: e.g., "admin.students.index"
                    $targetRoute = $role . '.' . $item['route_suffix'];
                ?>

                
                <?php if(Route::has($targetRoute)): ?>
                    <a class="ajax-link block p-2 rounded flex items-center gap-3 transition-colors <?php echo e($isActive($item['key'], $targetRoute)); ?>"
                       href="<?php echo e(route($targetRoute)); ?>"
                       data-section="<?php echo e($item['key']); ?>"
                       data-route="<?php echo e(route($targetRoute)); ?>">
                        
                        
                        <span class="w-6 <?php echo e($activeSection === $item['key'] ? 'text-white' : 'text-slate-500'); ?>">
                            
                            <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'icons.'.$item['icon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
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
                        </span>
                        
                        <span class="sidebar-label"><?php echo e($item['label']); ?></span>
                    </a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>

        
        <div class="pt-3 border-t mt-4">
            <button id="sidebar-toggle" aria-expanded="true" aria-controls="admin-sidebar" class="flex items-center gap-2 text-sm px-2 py-1 border rounded w-full hover:bg-gray-50 text-slate-500">
                <span id="toggle-open"><?php if (isset($component)) { $__componentOriginala1ed8373373e3ebea26d3e71e9b293e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala1ed8373373e3ebea26d3e71e9b293e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.toggle-open','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.toggle-open'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala1ed8373373e3ebea26d3e71e9b293e9)): ?>
<?php $attributes = $__attributesOriginala1ed8373373e3ebea26d3e71e9b293e9; ?>
<?php unset($__attributesOriginala1ed8373373e3ebea26d3e71e9b293e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala1ed8373373e3ebea26d3e71e9b293e9)): ?>
<?php $component = $__componentOriginala1ed8373373e3ebea26d3e71e9b293e9; ?>
<?php unset($__componentOriginala1ed8373373e3ebea26d3e71e9b293e9); ?>
<?php endif; ?></span>
                <span id="toggle-close" class="hidden"><?php if (isset($component)) { $__componentOriginal22a939631f6d02c23ceb65e5d7cc3563 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22a939631f6d02c23ceb65e5d7cc3563 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.toggle-close','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.toggle-close'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22a939631f6d02c23ceb65e5d7cc3563)): ?>
<?php $attributes = $__attributesOriginal22a939631f6d02c23ceb65e5d7cc3563; ?>
<?php unset($__attributesOriginal22a939631f6d02c23ceb65e5d7cc3563); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22a939631f6d02c23ceb65e5d7cc3563)): ?>
<?php $component = $__componentOriginal22a939631f6d02c23ceb65e5d7cc3563; ?>
<?php unset($__componentOriginal22a939631f6d02c23ceb65e5d7cc3563); ?>
<?php endif; ?></span>
                <span class="sidebar-label">Hide sidebar</span>
            </button>
        </div>

    </div>
</aside><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/partials/sidebar.blade.php ENDPATH**/ ?>