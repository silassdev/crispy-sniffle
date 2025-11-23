
<div class="p-6 max-w-4xl mx-auto">
  <h1 class="text-2xl font-bold mb-4">Student dashboard</h1>
  <p class="text-gray-700">Welcome, <?php echo e(auth()->user()->name); ?>. This is your student area.</p>

  <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="p-4 bg-white rounded shadow">Enrolled courses: 0</div>
    <div class="p-4 bg-white rounded shadow">Notes: 0</div>
    <div class="p-4 bg-white rounded shadow">Recent activity</div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/partials/sections/student/dashboard.blade.php ENDPATH**/ ?>