<?php
    $role = $role 
        ?? session('view_as') 
        ?? (auth()->user()->role ?? 'student');
?>

<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('sidebar', ['role' => $role]);

$__html = app('livewire')->mount($__name, $__params, 'lw-182849030-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/partials/sidebar.blade.php ENDPATH**/ ?>