<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.overview', ['wire:init' => 'loadCounters','wire:poll.visible.60s' => 'loadCounters']);

$__html = app('livewire')->mount($__name, $__params, 'lw-3353076161-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/overview-fragment.blade.php ENDPATH**/ ?>