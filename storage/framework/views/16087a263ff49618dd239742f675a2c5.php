<?php
  // role color map (tailwind utilities)
  $colors = [
    'admin' => 'bg-indigo-600 text-white',
    'trainer' => 'bg-emerald-600 text-white',
    'student' => 'bg-sky-600 text-white',
  ];
  $bg = $colors[$role] ?? 'bg-gray-700 text-white';
?>

<div class="px-2 py-4">
  
  <div class="px-2 mb-4" x-show="open">
    <div class="rounded p-2 <?php echo e($bg); ?>">
      <div class="flex items-center gap-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3v6h8v-6h3a1 1 0 001-1V7"/>
        </svg>
        <div>
          <div class="font-semibold"><?php echo e(ucfirst($role)); ?> Console</div>
          <div class="text-xs opacity-80">Quick actions & overview</div>
        </div>
      </div>
    </div>
  </div>

  
  <nav class="space-y-1">
    <?php if($role === 'admin'): ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'users','label' => 'Students','component' => 'students'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'shield-check','label' => 'Admins','component' => 'admins'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'academic-cap','label' => 'Trainers','component' => 'trainers'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'chat','label' => 'Community','component' => 'community'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'chat-bubble-left-right','label' => 'Comments','component' => 'comments'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'document-text','label' => 'Posts','component' => 'posts'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'chat-alt-2','label' => 'Feedback','component' => 'feedback'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
    <?php elseif($role === 'trainer'): ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'play','label' => 'My Courses','component' => 'courses'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'users','label' => 'My Students','component' => 'my-students'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'video-camera','label' => 'Videos','component' => 'videos'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'pencil','label' => 'Create Post','component' => 'create-post'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
    <?php else: ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'home','label' => 'Courses','component' => 'courses'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'book-open','label' => 'My Notes','component' => 'notes'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'chat','label' => 'Community','component' => 'community'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginal40ce25a7edbcba81f7beb65aae204006 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40ce25a7edbcba81f7beb65aae204006 = $attributes; } ?>
<?php $component = App\View\Components\DashItem::resolve(['href' => '#','icon' => 'user','label' => 'Profile','component' => 'profile'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dash-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $attributes = $__attributesOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__attributesOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40ce25a7edbcba81f7beb65aae204006)): ?>
<?php $component = $__componentOriginal40ce25a7edbcba81f7beb65aae204006; ?>
<?php unset($__componentOriginal40ce25a7edbcba81f7beb65aae204006); ?>
<?php endif; ?>
    <?php endif; ?>
  </nav>
</div>


<?php if (! $__env->hasRenderedOnce('3ee5eb28-b284-40d4-8a31-8b7b768dd61b')): $__env->markAsRenderedOnce('3ee5eb28-b284-40d4-8a31-8b7b768dd61b'); ?>
<?php $__env->startPush('blade-components'); ?>
  <?php
    // register inline component for dash-item if not using separate file
  ?>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/partials/sidebar.blade.php ENDPATH**/ ?>