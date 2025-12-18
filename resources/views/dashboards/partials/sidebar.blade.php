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
            ['key' => 'community', 'label' => 'Community', 'icon' => 'admins', 'route_suffix' => 'community'],
            ['key' => 'admins', 'label' =>    'Admins', 'icon' => 'admins', 'route_suffix' => 'admins.index'],
            ['key' => 'Newsletter', 'label' => 'Admins', 'icon' => 'admins', 'route_suffix' => 'admins.index'],
        ],
        'trainer' => [
            ['key' => 'overview', 'label' => 'Overview', 'icon' => 'overview', 'route_suffix' => 'dashboard'],
            ['key' => 'students', 'label' => 'Students', 'icon' => 'students', 'route_suffix' => 'students.index'],
            ['key' => 'certify', 'label' => 'Certificates', 'icon' => 'certify', 'route_suffix' => 'certify'],
        ],
        default => [
            ['key' => 'overview', 'label' => 'Overview', 'icon' => 'overview', 'route_suffix' => 'dashboard'],
            ['key' => 'courses', 'label' => 'Courses', 'icon' => 'courses', 'route_suffix' => 'courses.index'],
        ],
    };
@endphp

<div id="user-grid" class="grid grid-cols-3 gap-4 p-4 bg-white shadow-md rounded-md">
    @foreach($menuItems as $item)
        @php $targetRoute = $role . '.' . $item['route_suffix']; @endphp
        @if(Route::has($targetRoute))
            <a href="{{ route($targetRoute) }}" class="block p-4 rounded-md text-center transition-colors text-slate-500 hover:bg-slate-50">
                <x-dynamic-component :component="'icons.'.$item['icon']" class="w-8 h-8 mx-auto mb-2" />
                <span class="text-sm font-medium">{{ $item['label'] }}</span>
            </a>
        @endif
    @endforeach
</div>