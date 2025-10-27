protected $routeMiddleware = [
    // ...
    'role' => \App\Http\Middleware\RoleMiddleware::class,
    'approved.trainer' => \App\Http\Middleware\EnsureTrainerApproved::class,
];
