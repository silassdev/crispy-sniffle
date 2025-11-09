protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    
    'role' => \App\Http\Middleware\EnsureRole::class,
    'validate.token'=> \App\Http\Middleware\ValidateToken::class,
    'is_admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
    'trainer.pending' => \App\Http\Middleware\EnsureTrainerIsPending::class,
];
