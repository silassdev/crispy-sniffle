

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


  <section class="relative mb-16 overflow-visible">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="relative z-10" data-reveal>
        <h1 class="text-5xl sm:text-6xl font-extrabold leading-[1.05] mb-6 font-['Poppins'] drop-shadow-sm">
          <span class="bg-gradient-to-r from-indigo-600 via-violet-600 to-emerald-500 text-transparent bg-clip-text">Upskill with industry‑ready programs.</span><br>
          <span class="text-amber-400 italic">Teach &amp; certify to make impact.</span>
        </h1>
        <p class="text-lg sm:text-xl text-slate-700 dark:text-slate-500 mb-8 max-w-xl leading-relaxed font-['Inter']">
          Hands-on micro‑credentials, cohort-based projects, and verified instructor-led programs. Build portfolio-grade work and earn credentials recognized by employers.
        </p>

        <div class="flex flex-wrap gap-4">
          <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center gap-3 px-8 py-4 bg-indigo-600 text-white rounded-full font-semibold shadow-xl shadow-indigo-200 hover:bg-indigo-700 transform hover:-translate-y-1 transition-all duration-300" aria-label="Create free account">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Start learning — free
          </a>

          <a href="<?php echo e(route('courses.index')); ?>" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-slate-200 rounded-full font-semibold hover:bg-slate-50 hover:border-slate-300 transition-all duration-300" aria-label="Explore courses">
            Explore programs
          </a>
        </div>

        <ul class="mt-8 flex flex-wrap gap-4 text-sm text-slate-500">
          <li class="flex items-center gap-2"><span class="inline-block w-2 h-2 rounded-full bg-emerald-400"></span> Free & paid pathways</li>
          <li class="flex items-center gap-2"><span class="inline-block w-2 h-2 rounded-full bg-indigo-400"></span> Verified instructors</li>
          <li class="flex items-center gap-2"><span class="inline-block w-2 h-2 rounded-full bg-yellow-400"></span> Instant credential verification</li>
        </ul>
      </div>

      <div class="relative lg:h-[500px] hidden lg:block" aria-hidden="true">
        <div class="absolute -right-24 top-1/2 -translate-y-1/2 w-[140%] h-[120%] z-0 opacity-12 bg-indigo-600 rounded-full blur-3xl"></div>
        <img src="/img/hero.png"
             alt="Learners collaborating around a laptop"
             class="relative z-10 w-full h-full object-contain drop-shadow-2xl animate-float hero-blend">
      </div>
    </div>
  </section>

  <section class="mb-20">
      <div class="p-8 md:p-12 bg-white dark:bg-slate-600 rounded-3xl shadow-sm border border-slate-100 flex flex-col md:flex-row gap-10 items-center">
        <div class="w-full md:w-1/2">
           <img src="/img/mission.png" alt="Mission: transform careers with education" class="rounded-2xl shadow-lg w-full">
        </div>
        <div class="w-full md:w-1/2">
            <h2 class="text-2xl sm:text-3xl font-bold mb-6 text-slate-900 dark:text-slate-50 leading-tight">We partner with industry to build practical learning pathways that translate to real-world skills.</h2>
            <ul class="space-y-4 text-slate-600 dark:text-slate-300">
                <li class="flex items-start gap-3">
                    <span class="p-1 bg-indigo-50 text-indigo-600 rounded-full mt-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg></span>
                    <span><strong>Expert Instructors:</strong> Industry practitioners and accredited educators.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="p-1 bg-indigo-50 text-indigo-600 rounded-full mt-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg></span>
                    <span><strong>Career-aligned Programs:</strong> Micro-credentials, capstones and portfolio projects.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="p-1 bg-indigo-50 text-indigo-600 rounded-full mt-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg></span>
                    <span><strong>Seamless Experience:</strong> From onboarding to credential issuance.</span>
                </li>
            </ul>
        </div>
      </div>
  </section>

  
  <?php if((isset($publicCourses) && $publicCourses->count() > 0) || (isset($privateCourses) && $privateCourses->count() > 0)): ?>
  <section class="mb-20">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-10 gap-4">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Discover Programs</h2>
            <p class="text-slate-500 mt-2">Self-paced courses, instructor-led cohorts and premium pathways.</p>
        </div>
        <a href="<?php echo e(route('courses.index')); ?>" class="inline-flex items-center gap-2 text-indigo-600 font-semibold hover:gap-3 transition-all group">
            Browse all programs
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
        </a>
    </div>

    
    <?php if(isset($publicCourses) && $publicCourses->count() > 0): ?>
      <div class="mb-12">
        <h3 class="text-xl font-semibold text-slate-800 mb-4 flex items-center gap-2">
          <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
          Open Access
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
          Enrolled / Premium
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

  
  <section class="mb-24 relative overflow-hidden bg-gradient-to-br from-slate-50 to-white rounded-[2rem] py-12 px-6">
    <div class="relative z-10 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
      <div class="space-y-2 p-6 rounded-2xl bg-white shadow-sm hover:shadow-md transition">
        <h3 class="text-4xl md:text-5xl font-extrabold text-yellow-500" data-counter="0" data-target="87">0</h3>
        <p class="text-slate-500 uppercase tracking-widest text-xs font-bold">Programs</p>
      </div>
      <div class="space-y-2 p-6 rounded-2xl bg-white shadow-sm hover:shadow-md transition">
        <h3 class="text-4xl md:text-5xl font-extrabold text-indigo-500" data-counter="0" data-target="160">0</h3>
        <p class="text-slate-500 uppercase tracking-widest text-xs font-bold">Active Learners</p>
      </div>
      <div class="space-y-2 p-6 rounded-2xl bg-white shadow-sm hover:shadow-md transition">
        <h3 class="text-4xl md:text-5xl font-extrabold text-rose-500" data-counter="0" data-target="50">0</h3>
        <p class="text-slate-500 uppercase tracking-widest text-xs font-bold">Verified Instructors</p>
      </div>
      <div class="space-y-2 p-6 rounded-2xl bg-white shadow-sm hover:shadow-md transition">
        <h3 class="text-4xl md:text-5xl font-extrabold text-emerald-500" data-counter="0" data-target="12">0</h3>
        <p class="text-slate-500 uppercase tracking-widest text-xs font-bold">Community Posts</p>
      </div>
    </div>
  </section>

  
  <section id="explore" class="grid gap-12 lg:grid-cols-3">
    <main class="lg:col-span-2 space-y-10">

      
      <div class="flex items-center justify-between border-b border-slate-100 pb-6">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">Latest Insights</h2>
            <p class="text-slate-500 mt-1">Community discussion, tutorials and product updates</p>
        </div>
        <a href="<?php echo e(route('blogs.index') ?? '#'); ?>" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-100 text-slate-700 rounded-full font-bold text-sm hover:bg-indigo-600 hover:text-white transition-all duration-300 group" aria-label="View all posts">
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
          <form method="GET" action="<?php echo e(route('blogs.index')); ?>" role="search" aria-label="Search posts">
              <input name="q" placeholder="Search topics, instructors, content..." 
                     class="w-full px-6 py-4 rounded-2xl bg-white border border-slate-100 shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-300">
              <button class="absolute right-3 top-2.5 p-2 text-slate-400 group-focus-within:text-indigo-600 transition-colors" aria-label="submit search">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
              </button>
          </form>
      </div>

      <!-- Topics -->
      <div class="p-6 bg-white rounded-[1.25rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300">
        <h4 class="text-lg font-extrabold text-slate-900 mb-6 flex items-center gap-2">
            <span class="w-2 h-8 bg-indigo-500 rounded-full"></span>
            Trending Topics
        </h4>
        <div class="flex flex-wrap gap-2">
          <?php $tags = ['laravel', 'react', 'tailwind', 'php', 'javascript', 'vue']; ?>
          <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('blogs.index', ['tag' => $t])); ?>" 
               class="px-4 py-2 text-xs font-semibold text-slate-600 bg-slate-50 rounded-xl hover:bg-indigo-500 hover:text-white hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide">
                #<?php echo e($t); ?>

            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>

      <!-- Top Instructors -->
      <div class="p-6 bg-white rounded-[1.25rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300">
        <h4 class="text-lg font-extrabold text-slate-900 mb-6 flex items-center gap-2">
            <span class="w-2 h-8 bg-yellow-500 rounded-full"></span>
            Top Instructors
        </h4>
        <div class="space-y-6">
          <?php $trainers = [['name' => 'Jane Doe', 'courses' => 12, 'color' => 'indigo'], ['name' => 'John Smith', 'courses' => 8, 'color' => 'emerald']]; ?>
          <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center justify-between group cursor-pointer">
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-<?php echo e($trainer['color']); ?>-100 flex items-center justify-center text-<?php echo e($trainer['color']); ?>-600 font-bold text-lg group-hover:scale-110 transition-transform" aria-hidden="true">
                  <?php echo e(substr($trainer['name'], 0, 1)); ?>

                </div>
                <div>
                    <div class="font-semibold text-slate-900"><?php echo e($trainer['name']); ?></div>
                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest"><?php echo e($trainer['courses']); ?> Programs</div>
                </div>
              </div>
              <svg class="w-5 h-5 text-slate-300 group-hover:text-<?php echo e($trainer['color']); ?>-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="w-full mt-8 py-3 text-sm font-semibold text-indigo-600 bg-indigo-50 rounded-xl hover:bg-indigo-600 hover:text-white transition-all duration-300">
            Explore instructors
        </button>
      </div>
    </aside>
  </section>

  
  <section class="mt-24">
    <?php if ($__env->exists('partials.testimonials')) echo $__env->make('partials.testimonials', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </section>

  
  <section class="mt-24" id="verify-certificate">
    <div class="relative p-10 md:p-16 bg-gradient-to-br from-indigo-50 via-white to-purple-50 rounded-[2.5rem] border border-indigo-100 shadow-sm overflow-hidden">
        
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-indigo-200 rounded-full blur-[80px] opacity-30"></div>
        <div class="absolute -left-12 -bottom-12 w-48 h-48 bg-purple-200 rounded-full blur-[60px] opacity-20"></div>

        <div class="relative z-10 max-w-2xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-xs font-bold uppercase tracking-widest mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Credential Verification
            </div>

            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 leading-tight">
                Verify a <span class="text-indigo-600">Credential</span>
            </h2>
            <p class="text-slate-500 mb-8 max-w-md mx-auto">
                Input a credential ID to confirm issuance, view recipient details and download a verifiable record.
            </p>

            <form id="verify-cert-form" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto" aria-label="Credential verification form">
                <div class="relative flex-1">
                    <label for="cert-verify-input" class="sr-only">Credential ID</label>
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" id="cert-verify-input" name="credential_id"
                           placeholder="e.g. CRED-20260218-ABC123"
                           class="w-full pl-12 pr-4 py-4 bg-white border border-slate-200 rounded-2xl text-sm font-medium focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all duration-300 shadow-sm"
                           required>
                </div>
                <button type="submit"
                        class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-semibold hover:bg-indigo-700 transform hover:-translate-y-0.5 transition-all duration-300 shadow-lg whitespace-nowrap">
                    Verify credential
                </button>
            </form>

            <div id="cert-verify-feedback" class="mt-4 text-sm font-medium hidden" role="status" aria-live="polite"></div>
        </div>
    </div>
  </section>

  
  <section class="mt-24 mb-12 group">
    <div class="relative p-12 md:p-20 bg-slate-900 rounded-[3rem] overflow-hidden">
        <!-- Abstract Decoration -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-indigo-600 rounded-full blur-[100px] opacity-40 group-hover:opacity-60 transition-opacity"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-blue-600 rounded-full blur-[100px] opacity-20"></div>

        <div class="relative z-10 text-center max-w-2xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">
                Ready to accelerate your <br> <span class="text-indigo-400">career progression?</span>
            </h2>
            <p class="text-indigo-100/60 mb-10 text-lg">
                Join thousands of learners and instructors building credentialed skills together.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?php echo e(route('register')); ?>" class="px-8 py-4 bg-white text-slate-900 rounded-full font-extrabold hover:bg-indigo-500 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-2xl">
                    Create free account
                </a>
                <a href="<?php echo e(route('contact.show')); ?>" class="px-8 py-4 border border-white/20 text-white rounded-full font-semibold hover:bg-white/10 transition-all duration-300">
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
        const increment = Math.max(1, Math.ceil(target / 100));

        const updateCounter = () => {
          current += increment;
          if (current >= target) {
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
  }, {threshold: 0.3});

  counters.forEach(counter => counterIo.observe(counter));

  // Credential verification form
  const certForm = document.getElementById('verify-cert-form');
  if (certForm) {
    certForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const input = document.getElementById('cert-verify-input');
      const id = input.value.trim();
      if (id) {
        window.location.href = '/verify/' + encodeURIComponent(id);
      }
    });
  }
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/home/guest.blade.php ENDPATH**/ ?>