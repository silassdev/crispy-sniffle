<div class="space-y-4">
   <header class="flex items-center justify-between">
   <h1 class="text-2xl font-semibold">Trainers</h1>
   <div clas="text-sm text-gray-500">Manage Pending and Approved trainers</div>
   </header>
   <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.trainer-list', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3063003447-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
  </div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/trainers/index.blade.php ENDPATH**/ ?>