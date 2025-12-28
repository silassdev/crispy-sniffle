

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


  
  <section class="relative mb-16 overflow-visible">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="relative z-10">
        <h1 class="text-5xl sm:text-6xl font-black leading-[1.1] mb-6 font-['Playfair_Display'] text-slate-900 dark:text-gray-500">
          Learn for <span class="text-indigo-600 underline decoration-indigo-200 decoration-8 underline-offset-4">free</span>.<br>
          Teach for <span class="italic text-yellow-500">impact</span>.
        </h1>
        <p class="text-xl text-gray-600 dark:text-slate-400 mb-8 max-w-xl leading-relaxed">
          Build real projects, join a community, and get verified as a trainer or student. Your journey to excellence starts here.
        </p>

        <div class="flex flex-wrap gap-4">
          <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center gap-2 px-8 py-4 bg-indigo-600 text-white rounded-full font-bold shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-300">
            Get started now
          </a>

          <a href="<?php echo e(route('home')); ?>#explore" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-slate-200 rounded-full font-bold hover:bg-slate-50 hover:border-slate-300 transition-all duration-300">
            Explore posts
          </a>
        </div>
      </div>

      <div class="relative lg:h-[500px] hidden lg:block">
        <div class="absolute -right-24 top-1/2 -translate-y-1/2 w-[140%] h-[120%] z-0 opacity-10 bg-indigo-600 rounded-full blur-3xl"></div>
        <img src="/img/hero.png"
             alt="Hero Illustration"
             class="relative z-10 w-full h-full object-contain drop-shadow-2xl animate-float hero-blend">
      </div>
    </div>
  </section>

  
  <section class="mb-20">
      <div class="p-8 md:p-12 bg-white dark:bg-slate-100 rounded-3xl shadow-sm border border-slate-100 flex flex-col md:flex-row gap-10 items-center">
        <div class="w-full md:w-1/2">
           <img src="/img/mission.png" alt="Our Mission" class="rounded-2xl shadow-lg w-full">
        </div>
        <div class="w-full md:w-1/2">
            <h2 class="text-3xl font-bold mb-6 text-slate-900 dark:text-slate-800 leading-tight">We are dedicated to revolutionizing the digital world through cutting-edge web and app solutions.</h2>
            <ul class="space-y-4 text-slate-600 dark:text-slate-400">
                <li class="flex items-start gap-3">
                    <span class="p-1 bg-green-100 text-green-600 rounded-full mt-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg></span>
                    <span><strong>Expert Team:</strong> Skilled professionals with years of experience.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="p-1 bg-green-100 text-green-600 rounded-full mt-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg></span>
                    <span><strong>Tailored Solutions:</strong> Strategies that align with your goals.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="p-1 bg-green-100 text-green-600 rounded-full mt-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg></span>
                    <span><strong>Seamless Experience:</strong> From consultation to launch.</span>
                </li>
            </ul>
        </div>
      </div>
  </section>

  
  <?php if((isset($publicCourses) && $publicCourses->count() > 0) || (isset($privateCourses) && $privateCourses->count() > 0)): ?>
  <section class="mb-20">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-10 gap-4">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Explore Courses</h2>
            <p class="text-slate-500 mt-2">Free courses and premium content for your learning journey</p>
        </div>
        <a href="<?php echo e(route('courses.index')); ?>" class="inline-flex items-center gap-2 text-indigo-600 font-semibold hover:gap-3 transition-all group">
            View all courses
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
        </a>
    </div>

    
    <?php if(isset($publicCourses) && $publicCourses->count() > 0): ?>
      <div class="mb-12">
        <h3 class="text-xl font-semibold text-slate-800 mb-4 flex items-center gap-2">
          <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
          No Login Required
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php $__currentLoopData = $publicCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if (isset($component)) { $__componentOriginal0a1b9827ce04f2b2ad6eeae95024b702 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a1b9827ce04f2b2ad6eeae95024b702 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.course-card','data' => ['course' => $course,'showLock' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('course-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['course' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($course),'showLock' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
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
      </div>
    <?php endif; ?>

    
    <?php if(isset($privateCourses) && $privateCourses->count() > 0): ?>
      <div>
        <h3 class="text-xl font-semibold text-slate-800 mb-4 flex items-center gap-2">
          <span class="w-2 h-6 bg-amber-500 rounded-full"></span>
          Login Required
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php $__currentLoopData = $privateCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if (isset($component)) { $__componentOriginal0a1b9827ce04f2b2ad6eeae95024b702 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a1b9827ce04f2b2ad6eeae95024b702 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.course-card','data' => ['course' => $course,'showLock' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('course-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['course' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($course),'showLock' => true]); ?>
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
      </div>
    <?php endif; ?>
  </section>
  <?php endif; ?>

  
  <section class="mb-24 relative overflow-hidden bg-slate-100 rounded-[3rem] py-16 px-8">
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
        </svg>
    </div>
    <div class="relative z-10 grid grid-cols-2 md:grid-cols-4 gap-12 text-center text-white">
      <div class="space-y-2 p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition">
        <h3 class="text-5xl font-black text-yellow-400 font-['Playfair_Display']" data-counter="0" data-target="187">0</h3>
        <p class="text-slate-400 uppercase tracking-widest text-xs font-bold">Courses Offered</p>
      </div>
      <div class="space-y-2 p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition">
        <h3 class="text-5xl font-black text-indigo-400 font-['Playfair_Display']" data-counter="0" data-target="450">0</h3>
        <p class="text-slate-400 uppercase tracking-widest text-xs font-bold">Active Students</p>
      </div>
      <div class="space-y-2 p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition">
        <h3 class="text-5xl font-black text-rose-400 font-['Playfair_Display']" data-counter="0" data-target="1042">0</h3>
        <p class="text-slate-400 uppercase tracking-widest text-xs font-bold">Verified Trainers</p>
      </div>
      <div class="space-y-2 p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition">
        <h3 class="text-5xl font-black text-emerald-400 font-['Playfair_Display']" data-counter="0" data-target="32">0</h3>
        <p class="text-slate-400 uppercase tracking-widest text-xs font-bold">Community Posts</p>
      </div>
    </div>
  </section>

  
  <section id="explore" class="grid gap-12 lg:grid-cols-3">
    <main class="lg:col-span-2 space-y-10">

      
      <div class="flex items-center justify-between border-b border-slate-100 pb-6">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">Latest Insights</h2>
            <p class="text-slate-500 mt-1">Freshly baked thoughts from our community</p>
        </div>
        <a href="<?php echo e(route('blogs.index') ?? '#'); ?>" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-100 text-slate-700 rounded-full font-bold text-sm hover:bg-indigo-600 hover:text-white transition-all duration-300 group">
          View all posts
          <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
        </a>
      </div>

      <div class="animate-fade-in-up">
        <?php echo $__env->make('partials.feed', ['posts' => $posts ?? null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>

    </main>

    
    <aside class="space-y-8">
      <!-- Search Component (Desktop) -->
      <div class="relative group hidden lg:block">
          <form method="GET" action="<?php echo e(route('blogs.index')); ?>">
              <input name="q" placeholder="Global search..." 
                     class="w-full px-6 py-4 rounded-2xl bg-white border border-slate-100 shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-300">
              <button class="absolute right-3 top-2.5 p-2 text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
              </button>
          </form>
      </div>

      <!-- Trending Tags -->
      <div class="p-8 bg-white rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300">
        <h4 class="text-lg font-extrabold text-slate-900 mb-6 flex items-center gap-2">
            <span class="w-2 h-8 bg-indigo-500 rounded-full"></span>
            Trending Tags
        </h4>
        <div class="flex flex-wrap gap-2">
          <?php $tags = ['laravel', 'react', 'tailwind', 'php', 'javascript', 'vue']; ?>
          <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('blogs.index', ['tag' => $t])); ?>" 
               class="px-4 py-2 text-xs font-bold text-slate-500 bg-slate-50 rounded-xl hover:bg-indigo-500 hover:text-white hover:-translate-y-1 transition-all duration-300 uppercase tracking-widest">
                #<?php echo e($t); ?>

            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>

      <!-- Top Trainers -->
      <div class="p-8 bg-white rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300">
        <h4 class="text-lg font-extrabold text-slate-900 mb-6 flex items-center gap-2">
            <span class="w-2 h-8 bg-yellow-500 rounded-full"></span>
            Top Trainers
        </h4>
        <div class="space-y-6">
          <?php $trainers = [['name' => 'Jane Doe', 'courses' => 12, 'color' => 'indigo'], ['name' => 'John Smith', 'courses' => 8, 'color' => 'emerald']]; ?>
          <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center justify-between group cursor-pointer">
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-<?php echo e($trainer['color']); ?>-100 flex items-center justify-center text-<?php echo e($trainer['color']); ?>-600 font-black text-lg group-hover:scale-110 transition-transform">
                  <?php echo e(substr($trainer['name'], 0, 1)); ?>

                </div>
                <div>
                    <div class="font-bold text-slate-900"><?php echo e($trainer['name']); ?></div>
                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest"><?php echo e($trainer['courses']); ?> Courses</div>
                </div>
              </div>
              <svg class="w-5 h-5 text-slate-300 group-hover:text-<?php echo e($trainer['color']); ?>-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="w-full mt-8 py-3 text-sm font-bold text-indigo-600 bg-indigo-50 rounded-xl hover:bg-indigo-600 hover:text-white transition-all duration-300">
            View All Trainers
        </button>
      </div>
    </aside>
  </section>

  
  <section class="mt-24">
    <?php if ($__env->exists('partials.testimonials')) echo $__env->make('partials.testimonials', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </section>

  
  <section class="mt-24 mb-12 group">
    <div class="relative p-12 md:p-20 bg-slate-900 rounded-[3rem] overflow-hidden">
        <!-- Abstract Decoration -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-indigo-600 rounded-full blur-[100px] opacity-40 group-hover:opacity-60 transition-opacity"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-blue-600 rounded-full blur-[100px] opacity-20"></div>

        <div class="relative z-10 text-center max-w-2xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">
                Ready to elevate your <br> <span class="text-indigo-400">learning journey?</span>
            </h2>
            <p class="text-indigo-100/60 mb-10 text-lg">
                Join thousands of students and trainers building the future of technology together.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?php echo e(route('register')); ?>" class="px-8 py-4 bg-white text-slate-900 rounded-full font-black hover:bg-indigo-500 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-2xl">
                    Create free account
                </a>
                <a href="<?php echo e(route('contact.show')); ?>" class="px-8 py-4 border border-white/20 text-white rounded-full font-bold hover:bg-white/10 transition-all duration-300">
                    Contact sales
                </a>
            </div>
        </div>
    </div>
  </section>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const revealEls = document.querySelectorAll('[data-reveal]');
  const counters = document.querySelectorAll('[data-counter]');

  if (!('IntersectionObserver' in window)) {
    revealEls.forEach(el => el.classList.add('opacity-100','translate-y-0'));
    counters.forEach(counter => counter.textContent = counter.dataset.target);
    return;
  }

  const io = new IntersectionObserver((entries, ob) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.remove('opacity-0','translate-y-6');
        e.target.classList.add('opacity-100','translate-y-0','transition','duration-700','ease-out');
        ob.unobserve(e.target);
      }
    });
  }, {threshold: 0.12});

  revealEls.forEach(el => {
    el.classList.add('opacity-0','translate-y-6');
    io.observe(el);
  });

  const counterIo = new IntersectionObserver((entries, ob) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const counter = e.target;
        const target = +counter.dataset.target;
        let current = 0;
        const increment = Math.ceil(target / 100);

        const updateCounter = () => {
          current += increment;
          if (current > target) {
            counter.textContent = target;
          } else {
            counter.textContent = current;
            requestAnimationFrame(updateCounter);
          }
        };

        updateCounter();
        ob.unobserve(counter);
      }
    });
  });

  counters.forEach(counter => counterIo.observe(counter));
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/home/guest.blade.php ENDPATH**/ ?>