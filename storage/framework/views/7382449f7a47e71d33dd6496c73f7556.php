

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

  
  <section class="grid gap-6 lg:grid-cols-3 items-center mb-10">
    <div class="lg:col-span-2">
      <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md p-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight mb-3">
          Learn for free. Teach for impact.
        </h1>
        <p class="text-gray-600 dark:text-slate-300 mb-6 max-w-2xl">
          Build real projects, join a community, and get verified as a trainer or student.
        </p>

        <div class="flex flex-wrap gap-3">
          <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700 transition">
            Get started
          </a>

          <a href="<?php echo e(route('home')); ?>#explore" class="inline-flex items-center gap-2 px-4 py-2 border rounded hover:bg-gray-50 transition">
            Explore posts
          </a>
        </div>
      </div>

      
      <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition">
          <h4 class="font-semibold">Free courses</h4>
          <p class="text-sm text-gray-500">Practical, project-based modules for web dev.</p>
        </div>
        <div class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition">
          <h4 class="font-semibold">Community posts</h4>
          <p class="text-sm text-gray-500">Ask questions, share answers, and follow threads.</p>
        </div>
      </div>
    </div>

    
    <aside class="hidden lg:block">
      <div class="sticky top-6 space-y-4">
        <div class="p-4 bg-white rounded-lg shadow-sm">
          <h3 class="font-semibold mb-3">Suggested courses</h3>
          <?php if ($__env->exists('partials.suggested-courses', ['courses' => $courses ?? null])) echo $__env->make('partials.suggested-courses', ['courses' => $courses ?? null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="p-4 bg-white rounded-lg shadow-sm text-sm">
          <div class="font-semibold mb-2">Join the community</div>
          <p class="text-gray-500">Create an account to post and follow topics. Trainers get verified profiles.</p>
        </div>
      </div>
    </aside>
  </section>

  
  <section id="explore" class="grid gap-8 lg:grid-cols-3">
    <main class="lg:col-span-2 space-y-6">

      
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold">Latest posts</h2>
        <a href="<?php echo e(route('blogs') ?? '#'); ?>" class="text-sm text-indigo-600 hover:underline">View all</a>
      </div>

      
      <div class="space-y-4">
        <?php echo $__env->make('partials.feed', ['posts' => $posts ?? null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>

    </main>

    
    <aside class="space-y-6">
      <div class="p-4 bg-white rounded-lg shadow-sm">
        <h4 class="font-semibold mb-2">Trending tags</h4>
        <div class="flex flex-wrap gap-2">
          <a href="#" class="inline-block px-3 py-1 text-xs bg-gray-100 rounded hover:bg-gray-200">#laravel</a>
          <a href="#" class="inline-block px-3 py-1 text-xs bg-gray-100 rounded hover:bg-gray-200">#react</a>
          <a href="#" class="inline-block px-3 py-1 text-xs bg-gray-100 rounded hover:bg-gray-200">#tailwind</a>
        </div>
      </div>

      <div class="p-4 bg-white rounded-lg shadow-sm">
        <h4 class="font-semibold mb-2">Top trainers</h4>
        <ul class="space-y-2 text-sm text-gray-700">
          
          <li class="flex items-center justify-between">
            <div>Jane Doe</div>
            <div class="text-xs text-gray-500">12 courses</div>
          </li>
          <li class="flex items-center justify-between">
            <div>John Smith</div>
            <div class="text-xs text-gray-500">8 courses</div>
          </li>
        </ul>
      </div>
    </aside>
  </section>

  
  <section class="mt-12">
    <?php if ($__env->exists('partials.testimonials')) echo $__env->make('partials.testimonials', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </section>

  
  <section class="mt-12 p-6 bg-gradient-to-r from-indigo-50 to-white rounded-lg text-center">
    <h3 class="text-lg font-semibold mb-2">Ready to start learning?</h3>
    <a href="<?php echo e(route('register')); ?>" class="inline-block px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700 transition">
      Create a free account
    </a>
  </section>
</div>


<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const revealEls = document.querySelectorAll('[data-reveal]');
  if (!('IntersectionObserver' in window)) {
    // fallback: reveal all
    revealEls.forEach(el => el.classList.add('opacity-100','translate-y-0'));
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
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/home/guest.blade.php ENDPATH**/ ?>