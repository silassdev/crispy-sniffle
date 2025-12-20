
<div class="p-6 max-w-7xl mx-auto">
  <h1 class="text-2xl font-bold mb-4">Student Dashboard</h1>
  <p class="text-gray-700 mb-6">Welcome, <?php echo e(auth()->user()->name); ?>. This is your student area.</p>

  <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('student.overview', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1447447787-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/partials/sections/student/dashboard.blade.php ENDPATH**/ ?>