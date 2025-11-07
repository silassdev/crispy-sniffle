protected $routeMiddleware = [
    'role' => \App\Http\Middleware\EnsureRole::class,
    'validate.token'=> \App\Http\Middleware\ValidateToken::class,
    'is_admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,

];
