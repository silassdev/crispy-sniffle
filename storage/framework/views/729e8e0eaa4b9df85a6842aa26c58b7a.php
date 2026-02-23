
<?php $__env->startSection('title','Courses'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <div class="mb-10">
    <h1 class="text-4xl font-bold text-slate-900 mb-2">Courses</h1>
    <p class="text-slate-600">Explore our collection of free courses and start learning today</p>
  </div>

  
  <div class="mb-8 space-y-4">
    
    <form method="GET" action="<?php echo e(route('courses.index')); ?>" class="relative">
      <input 
        type="text" 
        name="q" 
        value="<?php echo e(request('q')); ?>" 
        placeholder="Search courses by title, description, or tags..." 
        class="w-full px-6 py-4 pl-12 rounded-2xl bg-white border border-slate-200 shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-300"
      >
      <svg class="absolute left-4 top-4 w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
      <?php if(request('filter')): ?>
        <input type="hidden" name="filter" value="<?php echo e(request('filter')); ?>">
      <?php endif; ?>
    </form>

    
    <div class="flex flex-wrap gap-3">
      <a href="<?php echo e(route('courses.index')); ?>" 
         class="px-4 py-2 rounded-lg font-semibold text-sm transition-all <?php echo e(!request('filter') && !request('q') ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'); ?>">
        All Courses
      </a>
      <a href="<?php echo e(route('courses.index', ['filter' => 'public'] + request()->only('q'))); ?>" 
         class="px-4 py-2 rounded-lg font-semibold text-sm transition-all <?php echo e(request('filter') == 'public' ? 'bg-emerald-600 text-white' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'); ?>">
        🔓 Free Courses
      </a>
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('courses.index', ['filter' => 'private'] + request()->only('q'))); ?>" 
           class="px-4 py-2 rounded-lg font-semibold text-sm transition-all <?php echo e(request('filter') == 'private' ? 'bg-amber-600 text-white' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'); ?>">
          🔒 Premium Courses
        </a>
      <?php endif; ?>
      <a href="<?php echo e(route('courses.index', ['filter' => 'recent'] + request()->only('q'))); ?>" 
         class="px-4 py-2 rounded-lg font-semibold text-sm transition-all <?php echo e(request('filter') == 'recent' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'); ?>">
        🆕 Recently Added
      </a>
    </div>
  </div>

  <?php if($courses->count() > 0): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginal0a1b9827ce04f2b2ad6eeae95024b702 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a1b9827ce04f2b2ad6eeae95024b702 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.course-card','data' => ['course' => $course]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('course-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['course' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($course)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a1b9827ce04f2b2ad6eeae95024b702)): ?>
<?php $attributes = $__attributesOriginal0a1b9827ce04f2b2ad6eeae95024b702; ?>
<?php unset($__attributesOriginal0a1b9827ce04f2b2ad6eeae95024b702); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a1b9827ce04f2b2ad6eeae95024b702)): ?>
<?php $component = $__componentOriginal0a1b9827ce04f2b2ad6eeae95024b702; ?>
<?php unset($__componentOriginal0a1b9827ce04f2b2ad6eeae95024b702); ?>
<?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-10">
      <?php echo e($courses->links()); ?>

    </div>
  <?php else: ?>
    <div class="text-center py-16">
      <div class="w-24 h-24 mx-auto bg-slate-100 rounded-full flex items-center justify-center mb-4">
        <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>
      </div>
      <h3 class="text-lg font-semibold text-slate-900 mb-2">No courses available yet</h3>
      <p class="text-slate-600">Check back soon for new courses!</p>
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/courses/index.blade.php ENDPATH**/ ?>