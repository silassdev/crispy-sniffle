protected $middlewareAliases = [
    'role' => \App\Http\Middleware\EnsureRole::class,
    'auth' => \App\Http\Middleware\Authenticate::class,
    'validate.token'=> \App\Http\Middleware\ValidateToken::class,
    'is_admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
];