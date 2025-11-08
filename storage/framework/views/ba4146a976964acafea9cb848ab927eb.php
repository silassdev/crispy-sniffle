

<?php $__env->startSection('title', 'Home — ' . config('app.name')); ?>

<?php $__env->startSection('content'); ?>
<?php
  $studentRegisterUrl = Route::has('register')
    ? route('register', ['role' => 'student'])
    : url('/register?role=student');

  $trainerRegisterUrl = Route::has('register')
    ? route('register', ['role' => 'trainer'])
    : url('/register?role=trainer');

  $loginUrl = Route::has('login') ? route('login') : url('/login');
?>


<section class="pt-8 md:pt-12 lg:pt-16 pb-8 sm:pb-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
      <div class="space-y-4 sm:space-y-6">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-tight tracking-tight">
          Build skills. Teach others. Grow together.
        </h1>

        <p class="text-gray-600 dark:text-gray-300 text-sm sm:text-base lg:text-lg max-w-xl">
          A modern, free LMS built with Laravel, Tailwind and Alpine. Create courses, add notes, schedule sessions, and connect with learners — everything you need to run online education.
        </p>

        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-3 gap-3">
          <a href="<?php echo e($studentRegisterUrl); ?>" class="w-full sm:w-auto text-center inline-flex items-center justify-center px-4 py-3 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm text-sm sm:text-base">
            Get started (Student)
          </a>
          <a href="<?php echo e($trainerRegisterUrl); ?>" class="w-full sm:w-auto text-center inline-flex items-center justify-center px-4 py-3 rounded-md bg-green-600 text-white hover:bg-green-700 shadow-sm text-sm sm:text-base">
            Apply as Trainer
          </a>
          <a href="<?php echo e($loginUrl); ?>" class="w-full sm:w-auto text-center inline-flex items-center justify-center px-4 py-3 rounded-md border hover:bg-gray-50 dark:hover:bg-white/5 text-sm sm:text-base">
            Login
          </a>
        </div>

        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 max-w-md">
          Trainers require admin approval. You will be notified once approved.
        </p>
      </div>

      <div class="space-y-4">
        <div class="rounded-2xl p-4 sm:p-6 shadow bg-white dark:bg-gray-800 border">
          <h3 class="font-semibold text-base sm:text-lg">Quick access</h3>
          <ul class="mt-3 space-y-2 sm:space-y-3">
            <li>
              <a href="<?php echo e($studentRegisterUrl); ?>" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-white/5">
                <div>
                  <div class="font-medium">Register — Student</div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Join and enroll in courses</div>
                </div>
                <svg class="w-5 h-5 text-gray-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
            </li>
            <li>
              <a href="<?php echo e($trainerRegisterUrl); ?>" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-white/5">
                <div>
                  <div class="font-medium">Apply — Trainer</div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Create courses after admin approval</div>
                </div>
                <svg class="w-5 h-5 text-gray-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
            </li>
            <li>
              <a href="<?php echo e($loginUrl); ?>" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-white/5">
                <div>
                  <div class="font-medium">Login</div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Go to your dashboard</div>
                </div>
                <svg class="w-5 h-5 text-gray-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
            </li>
          </ul>
        </div>

        <div class="mt-4 text-sm text-gray-600 dark:text-gray-300">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="text-lg font-semibold">Trusted by</div>
            <div class="flex gap-3 items-center justify-start sm:justify-end">
              <div class="h-8 w-20 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">Logo</div>
              <div class="h-8 w-20 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">Logo</div>
              <div class="h-8 w-20 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">Logo</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="py-10 sm:py-12 md:py-16 bg-transparent">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto">
      <h2 class="text-2xl sm:text-3xl font-semibold">Everything you need to run online learning</h2>
      <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm sm:text-base">Manage courses, students, sessions and content with a clean, focused interface.</p>
    </div>

    <div class="mt-8 sm:mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
      <div class="bg-white dark:bg-gray-800 border rounded-lg p-5 sm:p-6 shadow-sm">
        <div class="h-10 w-10 rounded-md bg-indigo-50 text-indigo-600 flex items-center justify-center font-semibold">A</div>
        <h3 class="mt-4 font-medium">Course Builder</h3>
        <p class="mt-2 text-sm text-gray-500">Create structured lessons with quizzes, resources and attachments.</p>
      </div>

      <div class="bg-white dark:bg-gray-800 border rounded-lg p-5 sm:p-6 shadow-sm">
        <div class="h-10 w-10 rounded-md bg-green-50 text-green-600 flex items-center justify-center font-semibold">T</div>
        <h3 class="mt-4 font-medium">Live Sessions</h3>
        <p class="mt-2 text-sm text-gray-500">Schedule Zoom or streaming sessions and manage attendees.</p>
      </div>

      <div class="bg-white dark:bg-gray-800 border rounded-lg p-5 sm:p-6 shadow-sm">
        <div class="h-10 w-10 rounded-md bg-indigo-50 text-indigo-600 flex items-center justify-center font-semibold">R</div>
        <h3 class="mt-4 font-medium">Reports & Analytics</h3>
        <p class="mt-2 text-sm text-gray-500">Track student progress and course performance with simple dashboards.</p>
      </div>
    </div>
  </div>
</section>


<section class="py-8 sm:py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 items-stretch text-center">
      <div class="bg-white dark:bg-gray-800 border rounded-lg p-6 flex flex-col justify-center">
        <div class="text-3xl sm:text-4xl font-extrabold">10k+</div>
        <div class="text-sm text-gray-500">Students</div>
      </div>
      <div class="bg-white dark:bg-gray-800 border rounded-lg p-6 flex flex-col justify-center">
        <div class="text-3xl sm:text-4xl font-extrabold">2k+</div>
        <div class="text-sm text-gray-500">Courses</div>
      </div>
      <div class="bg-white dark:bg-gray-800 border rounded-lg p-6 flex flex-col justify-center">
        <div class="text-3xl sm:text-4xl font-extrabold">4.9</div>
        <div class="text-sm text-gray-500">Avg. rating</div>
      </div>
    </div>
  </div>
</section>


<section class="py-8 sm:py-12 bg-transparent">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto text-center">
      <h3 class="text-xl sm:text-2xl font-semibold">What our community says</h3>
      <p class="mt-2 text-gray-600 dark:text-gray-300">Real stories from learners and instructors using the platform.</p>

      <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <blockquote class="bg-white dark:bg-gray-800 border rounded-lg p-4 shadow-sm">
          <p class="text-sm text-gray-700 dark:text-gray-200">"Great platform — I launched my first course in weeks."</p>
          <footer class="mt-3 text-xs text-gray-500">— Alex, Instructor</footer>
        </blockquote>

        <blockquote class="bg-white dark:bg-gray-800 border rounded-lg p-4 shadow-sm">
          <p class="text-sm text-gray-700 dark:text-gray-200">"Students love the simple interface and progress tracking."</p>
          <footer class="mt-3 text-xs text-gray-500">— Maria, Student</footer>
        </blockquote>

        <blockquote class="bg-white dark:bg-gray-800 border rounded-lg p-4 shadow-sm">
          <p class="text-sm text-gray-700 dark:text-gray-200">"Reliable and lightweight — exactly what we needed."</p>
          <footer class="mt-3 text-xs text-gray-500">— Noah, Trainer</footer>
        </blockquote>
      </div>
    </div>
  </div>
</section>


<section class="py-8 sm:py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="rounded-2xl bg-indigo-600 text-white p-6 sm:p-10 shadow-lg flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="text-center sm:text-left">
        <h4 class="text-lg sm:text-xl font-semibold">Ready to start teaching or learning?</h4>
        <p class="mt-2 text-sm sm:text-base text-indigo-100 max-w-xl mx-auto sm:mx-0">Create your account and join the community — it's free to get started.</p>
      </div>
      <div class="flex w-full sm:w-auto gap-3 mt-3 sm:mt-0">
        <a href="<?php echo e($studentRegisterUrl); ?>" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 rounded-md bg-white text-indigo-600 hover:opacity-95 shadow-sm">Get started</a>
        <a href="<?php echo e($trainerRegisterUrl); ?>" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 rounded-md border border-white/30 text-white hover:bg-white/10">Apply</a>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/home.blade.php ENDPATH**/ ?>