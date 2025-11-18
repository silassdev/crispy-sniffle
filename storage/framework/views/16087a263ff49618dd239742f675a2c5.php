<?php
    use Illuminate\Support\Facades\Route;

    $role = $role ?? session('view_as') ?? (auth()->check() ? auth()->user()->role : 'student');

    $colors = [
        'admin'   => 'bg-indigo-600 text-white',
        'trainer' => 'bg-emerald-600 text-white',
        'student' => 'bg-sky-600 text-white',
    ];
    $bg = $colors[$role] ?? 'bg-gray-700 text-white';

    // derive default active from current route name if none provided
    $current = $currentSection ?? null;
    if (!$current) {
        $r = optional(Route::current())->getName();
        $current = 'overview';
        if ($r) {
            if (Str::startsWith($r, 'admin.students')) $current = 'students';
            elseif (Str::startsWith($r, 'admin.trainers')) $current = 'trainers';
            elseif (Str::startsWith($r, 'admin.admins')) $current = 'admins';
            elseif (Str::startsWith($r, 'admin.community')) $current = 'community';
            elseif (Str::startsWith($r, 'admin.comments')) $current = 'comments';
            elseif (Str::startsWith($r, 'admin.posts')) $current = 'posts';
            elseif (Str::startsWith($r, 'admin.feedback')) $current = 'feedback';
            elseif (Str::startsWith($r, 'admin.other-actions')) $current = 'other-actions';
            else $current = 'overview';
        }
    }

    $isActive = function($name) use ($current) { return $current === $name ? 'dash-active' : ''; };
?>

<aside id="admin-sidebar" class="w-64 min-h-screen bg-white border-r" data-role="<?php echo e($role); ?>">
  <div class="p-4 flex flex-col h-full">

  
    <div class="px-2 mb-4">
      <div class="rounded p-2 <?php echo e($bg); ?> flex items-center gap-3">
        <div class="sidebar-label">
          <div class="font-semibold"><?php echo e(strtolower($role)); ?> </div>
        </div>
      </div>
    </div>
   
  <?php switch($role):
  case ('admin'): ?>

    <nav class="space-y-1 flex-1 overflow-auto">
      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('overview')); ?>"
         href="<?php echo e(route('admin.dashboard')); ?>" 
         data-section="overview"
         data-route="<?php echo e(route('admin.dashboard')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginale4fd98848becbb8e38c75047c87c4c23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4fd98848becbb8e38c75047c87c4c23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.community','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.community'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $attributes = $__attributesOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $component = $__componentOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__componentOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Overview</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('students')); ?>"
         href="<?php echo e(route('admin.students.index')); ?>" data-section="students" data-route="<?php echo e(route('admin.students.index')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.students','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.students'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46)): ?>
<?php $attributes = $__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46; ?>
<?php unset($__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46)): ?>
<?php $component = $__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46; ?>
<?php unset($__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Students</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('trainers')); ?>"
         href="<?php echo e(route('admin.trainers.index')); ?>" data-section="trainers" data-route="<?php echo e(route('admin.trainers.index')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal605212d7478d6b3ea488d909a3c3f2e5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.trainers','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.trainers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5)): ?>
<?php $attributes = $__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5; ?>
<?php unset($__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal605212d7478d6b3ea488d909a3c3f2e5)): ?>
<?php $component = $__componentOriginal605212d7478d6b3ea488d909a3c3f2e5; ?>
<?php unset($__componentOriginal605212d7478d6b3ea488d909a3c3f2e5); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Trainers</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('admins')); ?>"
         href="<?php echo e(route('admin.admins.index')); ?>" data-section="admins" data-route="<?php echo e(route('admin.admins.index')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal62ed55c76c49d05f415b555584018ad2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62ed55c76c49d05f415b555584018ad2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.admins','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.admins'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62ed55c76c49d05f415b555584018ad2)): ?>
<?php $attributes = $__attributesOriginal62ed55c76c49d05f415b555584018ad2; ?>
<?php unset($__attributesOriginal62ed55c76c49d05f415b555584018ad2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62ed55c76c49d05f415b555584018ad2)): ?>
<?php $component = $__componentOriginal62ed55c76c49d05f415b555584018ad2; ?>
<?php unset($__componentOriginal62ed55c76c49d05f415b555584018ad2); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Admins</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('community')); ?>"
         href="<?php echo e(route('admin.community')); ?>" data-section="community" data-route="<?php echo e(route('admin.community')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginale4fd98848becbb8e38c75047c87c4c23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4fd98848becbb8e38c75047c87c4c23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.community','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.community'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $attributes = $__attributesOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $component = $__componentOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__componentOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Community</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('comments')); ?>"
         href="<?php echo e(route('admin.comments')); ?>" data-section="comments" data-route="<?php echo e(route('admin.comments')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Comments</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Posts</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('feedback')); ?>"
         href="<?php echo e(route('admin.feedback')); ?>" data-section="feedback" data-route="<?php echo e(route('admin.feedback')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal7fa1e688f2400d47a19b7e82dec73169 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fa1e688f2400d47a19b7e82dec73169 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.feedback','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.feedback'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7fa1e688f2400d47a19b7e82dec73169)): ?>
<?php $attributes = $__attributesOriginal7fa1e688f2400d47a19b7e82dec73169; ?>
<?php unset($__attributesOriginal7fa1e688f2400d47a19b7e82dec73169); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7fa1e688f2400d47a19b7e82dec73169)): ?>
<?php $component = $__componentOriginal7fa1e688f2400d47a19b7e82dec73169; ?>
<?php unset($__componentOriginal7fa1e688f2400d47a19b7e82dec73169); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Feedback</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('other-actions')); ?>"
         href="<?php echo e(route('admin.other-actions')); ?>" data-section="other-actions" data-route="<?php echo e(route('admin.other-actions')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.others','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.others'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3)): ?>
<?php $attributes = $__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3; ?>
<?php unset($__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3)): ?>
<?php $component = $__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3; ?>
<?php unset($__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Other Actions</span>
      </a>

      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Certify & Achivement</span>
      </a>
       
        <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Newsletter</span>
      </a>

       <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Profile</span>
      </a>

    <?php break; ?>

     <?php case ('trainer'): ?>
        <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('overview')); ?>"
         href="<?php echo e(route('admin.dashboard')); ?>" data-section="overview" data-route="<?php echo e(route('admin.dashboard')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginale4fd98848becbb8e38c75047c87c4c23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4fd98848becbb8e38c75047c87c4c23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.community','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.community'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $attributes = $__attributesOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $component = $__componentOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__componentOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Overview</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('students')); ?>"
         href="<?php echo e(route('admin.students.index')); ?>" data-section="students" data-route="<?php echo e(route('admin.students.index')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.students','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.students'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46)): ?>
<?php $attributes = $__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46; ?>
<?php unset($__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46)): ?>
<?php $component = $__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46; ?>
<?php unset($__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Students</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('trainers')); ?>"
         href="<?php echo e(route('admin.trainers.index')); ?>" data-section="trainers" data-route="<?php echo e(route('admin.trainers.index')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal605212d7478d6b3ea488d909a3c3f2e5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.trainers','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.trainers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5)): ?>
<?php $attributes = $__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5; ?>
<?php unset($__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal605212d7478d6b3ea488d909a3c3f2e5)): ?>
<?php $component = $__componentOriginal605212d7478d6b3ea488d909a3c3f2e5; ?>
<?php unset($__componentOriginal605212d7478d6b3ea488d909a3c3f2e5); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Trainers</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('admins')); ?>"
         href="<?php echo e(route('admin.admins.index')); ?>" data-section="admins" data-route="<?php echo e(route('admin.admins.index')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal62ed55c76c49d05f415b555584018ad2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62ed55c76c49d05f415b555584018ad2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.admins','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.admins'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62ed55c76c49d05f415b555584018ad2)): ?>
<?php $attributes = $__attributesOriginal62ed55c76c49d05f415b555584018ad2; ?>
<?php unset($__attributesOriginal62ed55c76c49d05f415b555584018ad2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62ed55c76c49d05f415b555584018ad2)): ?>
<?php $component = $__componentOriginal62ed55c76c49d05f415b555584018ad2; ?>
<?php unset($__componentOriginal62ed55c76c49d05f415b555584018ad2); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Admins</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('community')); ?>"
         href="<?php echo e(route('admin.community')); ?>" data-section="community" data-route="<?php echo e(route('admin.community')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginale4fd98848becbb8e38c75047c87c4c23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4fd98848becbb8e38c75047c87c4c23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.community','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.community'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $attributes = $__attributesOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $component = $__componentOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__componentOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Community</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('comments')); ?>"
         href="<?php echo e(route('admin.comments')); ?>" data-section="comments" data-route="<?php echo e(route('admin.comments')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Comments</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Posts</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('feedback')); ?>"
         href="<?php echo e(route('admin.feedback')); ?>" data-section="feedback" data-route="<?php echo e(route('admin.feedback')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal7fa1e688f2400d47a19b7e82dec73169 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fa1e688f2400d47a19b7e82dec73169 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.feedback','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.feedback'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7fa1e688f2400d47a19b7e82dec73169)): ?>
<?php $attributes = $__attributesOriginal7fa1e688f2400d47a19b7e82dec73169; ?>
<?php unset($__attributesOriginal7fa1e688f2400d47a19b7e82dec73169); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7fa1e688f2400d47a19b7e82dec73169)): ?>
<?php $component = $__componentOriginal7fa1e688f2400d47a19b7e82dec73169; ?>
<?php unset($__componentOriginal7fa1e688f2400d47a19b7e82dec73169); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Feedback</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('other-actions')); ?>"
         href="<?php echo e(route('admin.other-actions')); ?>" data-section="other-actions" data-route="<?php echo e(route('admin.other-actions')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.others','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.others'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3)): ?>
<?php $attributes = $__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3; ?>
<?php unset($__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3)): ?>
<?php $component = $__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3; ?>
<?php unset($__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Other Actions</span>
      </a>

      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Certify & Achivement</span>
      </a>
       
        <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Newsletter</span>
      </a>

       <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Profile</span>
      </a>

  <?php break; ?>

     <?php default: ?>
   

        <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('overview')); ?>"
         href="<?php echo e(route('admin.dashboard')); ?>" data-section="overview" data-route="<?php echo e(route('admin.dashboard')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginale4fd98848becbb8e38c75047c87c4c23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4fd98848becbb8e38c75047c87c4c23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.community','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.community'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $attributes = $__attributesOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $component = $__componentOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__componentOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Overview</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('students')); ?>"
         href="<?php echo e(route('admin.students.index')); ?>" data-section="students" data-route="<?php echo e(route('admin.students.index')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.students','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.students'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46)): ?>
<?php $attributes = $__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46; ?>
<?php unset($__attributesOriginal1bd1bd2f122ac890e4b76754a4bb6e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46)): ?>
<?php $component = $__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46; ?>
<?php unset($__componentOriginal1bd1bd2f122ac890e4b76754a4bb6e46); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Students</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('trainers')); ?>"
         href="<?php echo e(route('admin.trainers.index')); ?>" data-section="trainers" data-route="<?php echo e(route('admin.trainers.index')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal605212d7478d6b3ea488d909a3c3f2e5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.trainers','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.trainers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5)): ?>
<?php $attributes = $__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5; ?>
<?php unset($__attributesOriginal605212d7478d6b3ea488d909a3c3f2e5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal605212d7478d6b3ea488d909a3c3f2e5)): ?>
<?php $component = $__componentOriginal605212d7478d6b3ea488d909a3c3f2e5; ?>
<?php unset($__componentOriginal605212d7478d6b3ea488d909a3c3f2e5); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Trainers</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('admins')); ?>"
         href="<?php echo e(route('admin.admins.index')); ?>" data-section="admins" data-route="<?php echo e(route('admin.admins.index')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal62ed55c76c49d05f415b555584018ad2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62ed55c76c49d05f415b555584018ad2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.admins','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.admins'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62ed55c76c49d05f415b555584018ad2)): ?>
<?php $attributes = $__attributesOriginal62ed55c76c49d05f415b555584018ad2; ?>
<?php unset($__attributesOriginal62ed55c76c49d05f415b555584018ad2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62ed55c76c49d05f415b555584018ad2)): ?>
<?php $component = $__componentOriginal62ed55c76c49d05f415b555584018ad2; ?>
<?php unset($__componentOriginal62ed55c76c49d05f415b555584018ad2); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Admins</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('community')); ?>"
         href="<?php echo e(route('admin.community')); ?>" data-section="community" data-route="<?php echo e(route('admin.community')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginale4fd98848becbb8e38c75047c87c4c23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4fd98848becbb8e38c75047c87c4c23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.community','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.community'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $attributes = $__attributesOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__attributesOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4fd98848becbb8e38c75047c87c4c23)): ?>
<?php $component = $__componentOriginale4fd98848becbb8e38c75047c87c4c23; ?>
<?php unset($__componentOriginale4fd98848becbb8e38c75047c87c4c23); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Community</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('comments')); ?>"
         href="<?php echo e(route('admin.comments')); ?>" data-section="comments" data-route="<?php echo e(route('admin.comments')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Comments</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Posts</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('feedback')); ?>"
         href="<?php echo e(route('admin.feedback')); ?>" data-section="feedback" data-route="<?php echo e(route('admin.feedback')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal7fa1e688f2400d47a19b7e82dec73169 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7fa1e688f2400d47a19b7e82dec73169 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.feedback','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.feedback'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7fa1e688f2400d47a19b7e82dec73169)): ?>
<?php $attributes = $__attributesOriginal7fa1e688f2400d47a19b7e82dec73169; ?>
<?php unset($__attributesOriginal7fa1e688f2400d47a19b7e82dec73169); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7fa1e688f2400d47a19b7e82dec73169)): ?>
<?php $component = $__componentOriginal7fa1e688f2400d47a19b7e82dec73169; ?>
<?php unset($__componentOriginal7fa1e688f2400d47a19b7e82dec73169); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Feedback</span>
      </a>

      
      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('other-actions')); ?>"
         href="<?php echo e(route('admin.other-actions')); ?>" data-section="other-actions" data-route="<?php echo e(route('admin.other-actions')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.others','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.others'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3)): ?>
<?php $attributes = $__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3; ?>
<?php unset($__attributesOriginal76e20cab24676ed481eb4c2ffc6c0cb3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3)): ?>
<?php $component = $__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3; ?>
<?php unset($__componentOriginal76e20cab24676ed481eb4c2ffc6c0cb3); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Other Actions</span>
      </a>

      <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Certify & Achivement</span>
      </a>
       
        <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Newsletter</span>
      </a>

       <a class="ajax-link block p-2 rounded flex items-center gap-3 <?php echo e($isActive('posts')); ?>"
         href="<?php echo e(route('admin.posts')); ?>" data-section="posts" data-route="<?php echo e(route('admin.posts')); ?>">
          <span class="w-6 text-slate-500"><?php if (isset($component)) { $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.comments','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $attributes = $__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__attributesOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26)): ?>
<?php $component = $__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26; ?>
<?php unset($__componentOriginal6d11fcfb9fdedbf0d4c5ddf5f4d0aa26); ?>
<?php endif; ?></span>
          <span class="sidebar-label">Profile</span>
      </a>

  <?php break; ?>
<?php endswitch; ?>

    </nav>

    <div class="pt-3 border-t mt-4">
      <div class="flex items-center gap-2 justify-between">
        <!-- toggle -->
       <button id="sidebar-toggle" aria-expanded="true" aria-controls="admin-sidebar" class="flex items-center gap-2 text-sm px-2 py-1 border rounded">
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
  </div>
</aside>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/partials/sidebar.blade.php ENDPATH**/ ?>