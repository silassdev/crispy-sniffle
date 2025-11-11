<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>"> <!-- Adjust if you have custom CSS -->
</head>
<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center">
            <h1 class="text-5xl font-bold text-red-500">404</h1>
            <p class="mt-4 text-xl font-semibold text-gray-700">Oops! The page you're looking for doesn't exist.</p>
            <p class="mt-2 text-md text-gray-600">It might have been removed, or you might have the wrong URL.</p>
            <a href="<?php echo e(url('/')); ?>" class="mt-6 inline-block px-6 py-3 bg-indigo-600 text-white text-lg font-medium rounded-lg hover:bg-indigo-700">
                Go Back to Home
            </a>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/errors/404.blade.php ENDPATH**/ ?>