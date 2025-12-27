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
    $activeSection = $section ?? request('section') ?? 'overview';
    
    $isActive = fn($key, $route) => ($activeSection === $key || $currentRoute === $route) ? $themeClass : 'text-slate-500 hover:bg-slate-50';
    
    $menuItems = match($role) {
        'admin' => [
            ['key' => 'students', 'label' => 'Students', 'icon' => 'students', 'route_suffix' => 'students.index'],
            ['key' => 'trainers', 'label' => 'Trainers', 'icon' => 'trainers', 'route_suffix' => 'trainers.index'],
            ['key' => 'admins', 'label' =>   'Admins', 'icon' => 'admins', 'route_suffix' => 'admins.index'],
            ['key' => 'community', 'label' => 'Community', 'icon' => 'community', 'route_suffix' => 'community'],
            ['key' => 'courses', 'label' =>    'Courses', 'icon' => 'courses', 'route_suffix' => 'courses'],
            ['key' => 'jobs', 'label' => 'Jobs', 'icon' => 'jobs', 'route_suffix' => 'jobs'],
            ['key' => 'feedback', 'label' => 'Feedback', 'icon' => 'feedback', 'route_suffix' => 'feedback.index'],
            ['key' => 'community', 'label' => 'Certificate', 'icon' => 'community', 'route_suffix' => 'community'],
            ['key' => 'newsletter', 'label' => 'Newsletter', 'icon' => 'newsletter', 'route_suffix' => 'newsletter'],
        ],  
        'trainer' => [
            ['key' => 'assignment', 'label' => 'Assignment', 'icon' => 'assignment', 'route_suffix' => 'assignment'],
            ['key' => 'scores', 'label' => 'Scores', 'icon' => 'scores', 'route_suffix' => 'scores'],
            ['key' => 'course', 'label' => 'Courses', 'icon' => 'course', 'route_suffix' => 'courses.index'],
            ['key' => 'students', 'label' => 'Students', 'icon' => 'students', 'route_suffix' => 'students'],
            ['key' => 'certificate', 'label' => 'Certificate', 'icon' => 'community', 'route_suffix' => 'scores'],
        ],
        default => [
            ['key' => 'courses', 'label' => 'Courses', 'icon' => 'courses', 'route_suffix' => 'courses.index'],
            ['key' => 'scores', 'label' => 'Scores', 'icon' => 'scores', 'route_suffix' => 'scores'],
            ['key' => 'community', 'label' => 'Community', 'icon' => 'community', 'route_suffix' => 'community'],
            ['key' => 'assignment', 'label' => 'Assignment', 'icon' => 'assignment', 'route_suffix' => 'assignment'],
            ['key' => 'community', 'label' => 'Certificate', 'icon' => 'community', 'route_suffix' => 'community'],
        ],
    };
@endphp

<div class="p-4">
    {{-- Role Badge --}}
    <div class="mb-4 px-3 py-2 rounded-md {{ $themeClass }}">
        <div class="text-xs font-semibold uppercase tracking-wider opacity-75">{{ $role }}</div>
        <div class="text-sm font-medium truncate">{{ $user->name ?? 'User' }}</div>
    </div>

    {{-- Compact Vertical Menu --}}
    <nav class="space-y-1">
        @foreach($menuItems as $item)
            @php $targetRoute = $role . '.' . $item['route_suffix']; @endphp
            @if(Route::has($targetRoute))
                <a href="{{ route($targetRoute) }}" 
                   data-route="{{ route($targetRoute) }}"
                   data-section="{{ $item['key'] }}"
                   class="ajax-link group flex items-center gap-3 px-3 py-2.5 rounded-md transition-all duration-200 {{ $isActive($item['key'], $targetRoute) }}">
                    <x-dynamic-component :component="'icons.'.$item['icon']" class="w-5 h-5 flex-shrink-0" />
                    <span class="text-sm font-medium">{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>
</div>
