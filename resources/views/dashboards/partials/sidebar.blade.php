@php
    $user = auth()->user();
    $role = strtolower($role ?? ($user->role ?? 'student'));
    $colors = [
        'admin'   => 'bg-indigo-600 text-white',
        'trainer' => 'bg-emerald-600 text-white',
        'student' => 'bg-sky-600 text-white',
    ];
    $themeClass = $colors[$role] ?? 'bg-gray-700 text-white';
    $currentRoute = Route::currentRouteName();
    $activeSection = request('section') ?? 'overview';
    $isActive = fn($key, $route) => ($activeSection === $key || $currentRoute === $route) ? $themeClass : 'text-slate-500 hover:bg-slate-50';
    $menuItems = match($role) {
        'admin' => [
            ['key' => 'students', 'label' => 'Students', 'icon' => 'students', 'route_suffix' => 'students.index'],
            ['key' => 'trainers', 'label' => 'Trainers', 'icon' => 'trainers', 'route_suffix' => 'trainers.index'],
            ['key' => 'admins', 'label' =>   'Admins', 'icon' => 'admins', 'route_suffix' => 'admins.index'],
            ['key' => 'community', 'label' => 'Community', 'icon' => 'community', 'route_suffix' => 'community'],
            ['key' => 'courses', 'label' =>    'Courses', 'icon' => 'courses', 'route_suffix' => 'courses'],
            ['key' => 'jobs', 'label' => 'Jobs', 'icon' => 'jobs', 'route_suffix' => 'jobs'],
            ['key' => 'feedback', 'label' => 'Feedback', 'icon' => 'feedback', 'route_suffix' => 'feedback'],
            ['key' => 'newsletter', 'label' => 'Newsletter', 'icon' => 'newsletter', 'route_suffix' => 'newsletter'],
        ],  
        'trainer' => [
            ['key' => 'overview', 'label' => 'Overview', 'icon' => 'overview', 'route_suffix' => 'dashboard'],
            ['key' => 'assignment', 'label' => 'Assignment', 'icon' => 'assignment', 'route_suffix' => 'assignment'],
            ['key' => 'scores', 'label' => 'Scores', 'icon' => 'scores', 'route_suffix' => 'scores'],
            ['key' => 'course', 'label' => 'Courses', 'icon' => 'course', 'route_suffix' => 'course'],
            ['key' => 'students', 'label' => 'Students', 'icon' => 'students', 'route_suffix' => 'students'],
            ['key' => 'community', 'label' => 'Community', 'icon' => 'community', 'route_suffix' => 'community'],
        ],
        default => [
            ['key' => 'overview', 'label' => 'Overview', 'icon' => 'overview', 'route_suffix' => 'dashboard'],
            ['key' => 'courses', 'label' => 'Courses', 'icon' => 'courses', 'route_suffix' => 'courses.index'],
            ['key' => 'scores', 'label' => 'Scores', 'icon' => 'scores', 'route_suffix' => 'scores'],
            ['key' => 'community', 'label' => 'Community', 'icon' => 'community', 'route_suffix' => 'community'],
            ['key' => 'assignment', 'label' => 'Assignment', 'icon' => 'assignment', 'route_suffix' => 'assignment'],
        ],
    };
@endphp

<div id="user-grid" class="grid grid-cols-3 gap-4 p-4 bg-white shadow-md rounded-md">
    @foreach($menuItems as $item)
        @php $targetRoute = $role . '.' . $item['route_suffix']; @endphp
        @if(Route::has($targetRoute))
            <a href="{{ route($targetRoute) }}" class="group block p-4 rounded-md text-center transition-colors text-slate-500 hover:bg-slate-50">
                <x-dynamic-component :component="'icons.'.$item['icon']" class="w-8 h-8 mx-auto mb-2" />
                <span class="text-sm font-medium">{{ $item['label'] }}</span>
            </a>
        @endif

    @endforeach
</div>