

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

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
  
  <div class="space-y-4">
    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-tight tracking-tight">
      Build skills. Teach others. Grow together.
    </h1>

    <p class="text-gray-600 dark:text-gray-300 text-sm sm:text-base lg:text-lg">
      Free LMS built with Laravel, Tailwind and Alpine — create courses, add notes, schedule Zoom sessions and join the community.
    </p>

    <div class="flex flex-wrap gap-3">
      <a href="<?php echo e($studentRegisterUrl); ?>" class="px-4 py-2 sm:px-5 sm:py-3 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 text-sm sm:text-base">
        Get started (Student)
      </a>
      <a href="<?php echo e($trainerRegisterUrl); ?>" class="px-4 py-2 sm:px-5 sm:py-3 rounded-md bg-green-600 text-white hover:bg-green-700 text-sm sm:text-base">
        Apply as Trainer
      </a>
      <a href="<?php echo e($loginUrl); ?>" class="px-4 py-2 sm:px-5 sm:py-3 rounded-md border hover:bg-gray-50 dark:hover:bg-white/5 text-sm sm:text-base">
        Login
      </a>
    </div>

    <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
      Trainers require admin approval. You will be notified once approved.
    </div>
  </div>

  
  <div>
    <div class="rounded-2xl p-5 sm:p-6 shadow bg-white dark:bg-gray-800 border">
      <h3 class="font-semibold text-base sm:text-lg">Quick access</h3>
      <ul class="mt-3 space-y-2 sm:space-y-3">
        <li>
          <a href="<?php echo e($studentRegisterUrl); ?>" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-white/5">
            <div>
              <div class="font-medium">Register — Student</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Join and enroll in courses</div>
            </div>
            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </li>
        <li>
          <a href="<?php echo e($trainerRegisterUrl); ?>" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg_WHITE/5">
            <div>
              <div class="font-medium">Apply — Trainer</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Create courses after admin approval</div>
            </div>
            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </li>
        <li>
          <a href="<?php echo e($loginUrl); ?>" class="flex justify-between items-center px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg_WHITE/5">
            <div>
              <div class="font-medium">Login</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Go to your dashboard</div>
            </div>
            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/home.blade.php ENDPATH**/ ?>