@php
    $user = auth()->user();
    // Default to student if role is missing, strictly lowercase for route matching
    $role = strtolower($role ?? ($user->role ?? 'student')); 
    
    $colors = [
        'admin'   => 'bg-indigo-600 text-white',
        'trainer' => 'bg-emerald-600 text-white',
        'student' => 'bg-sky-600 text-white',
    ];
    $themeClass = $colors[$role] ?? 'bg-gray-700 text-white';
    
    $currentRoute = Route::currentRouteName();
    $activeSection = request('section') ?? 'overview';
    
    $isActive = fn($key, $route) => 
        ($activeSection === $key || $currentRoute === $route) 
        ? $themeClass 
        : 'text-slate-500 hover:bg-slate-50';

  if ($role === 'admin') {
    $menuItems = [
        ['key' => 'overview',      'label' => 'Overview',             'icon' => 'overview',      'route_suffix' => 'dashboard'],
        ['key' => 'students',      'label' => 'Students',             'icon' => 'students',      'route_suffix' => 'students.index'],
        ['key' => 'trainers',      'label' => 'Trainers',             'icon' => 'trainers',      'route_suffix' => 'trainers.index'],
        ['key' => 'admins',        'label' => 'Admins',               'icon' => 'admins',        'route_suffix' => 'admins.index'],
        ['key' => 'community',     'label' => 'Community',            'icon' => 'community',     'route_suffix' => 'community'],
        ['key' => 'comments',      'label' => 'Comments',             'icon' => 'comments',      'route_suffix' => 'comments'],
        ['key' => 'posts',         'label' => 'Posts',                'icon' => 'comments',      'route_suffix' => 'posts'],
        ['key' => 'feedback',      'label' => 'Feedback',             'icon' => 'feedback',      'route_suffix' => 'feedback'],
        ['key' => 'other-actions', 'label' => 'Other Actions',        'icon' => 'others',        'route_suffix' => 'other-actions'],
        ['key' => 'certify',       'label' => 'Certificates',         'icon' => 'comments',      'route_suffix' => 'certify'], 
    ];
    } elseif ($role === 'trainer') {
     $menuItems = [
        ['key' => 'overview',      'label' => 'Overview',             'icon' => 'overview',      'route_suffix' => 'dashboard'],
        ['key' => 'students',      'label' => 'Students',             'icon' => 'students',      'route_suffix' => 'students.index'],
        ['key' => 'trainers',      'label' => 'Trainers',             'icon' => 'trainers',      'route_suffix' => 'trainers.index'],
        ['key' => 'admins',        'label' => 'Admins',               'icon' => 'admins',        'route_suffix' => 'admins.index'],
        ['key' => 'community',     'label' => 'Community',            'icon' => 'community',     'route_suffix' => 'community'],
        ['key' => 'comments',      'label' => 'Comments',             'icon' => 'comments',      'route_suffix' => 'comments'],
        ['key' => 'posts',         'label' => 'Posts',                'icon' => 'comments',      'route_suffix' => 'posts'],
        ['key' => 'feedback',      'label' => 'Feedback',             'icon' => 'feedback',      'route_suffix' => 'feedback'],
        ['key' => 'other-actions', 'label' => 'Other Actions',        'icon' => 'others',        'route_suffix' => 'other-actions'],
        ['key' => 'certify',       'label' => 'Certificates',         'icon' => 'comments',      'route_suffix' => 'certify'],
    ];
    } elseif ($role === 'student') {
    $menuItems = [
        ['key' => 'overview',      'label' => 'Overview',             'icon' => 'overview',      'route_suffix' => 'dashboard'],
        ['key' => 'courses',       'label' => 'Courses',              'icon' => 'courses',       'route_suffix' => 'courses.index'],
        ['key' => 'trainers',      'label' => 'Trainers',             'icon' => 'trainers',      'route_suffix' => 'trainers.index'],
        ['key' => 'admins',        'label' => 'Admins',               'icon' => 'admins',        'route_suffix' => 'admins.index'],
        ['key' => 'community',     'label' => 'Community',            'icon' => 'community',     'route_suffix' => 'community'],
        ['key' => 'comments',      'label' => 'Comments',             'icon' => 'comments',      'route_suffix' => 'comments'],
        ['key' => 'posts',         'label' => 'Posts',                'icon' => 'comments',      'route_suffix' => 'posts'],
        ['key' => 'feedback',      'label' => 'Feedback',             'icon' => 'feedback',      'route_suffix' => 'feedback'],
        ['key' => 'other-actions', 'label' => 'Other Actions',        'icon' => 'others',        'route_suffix' => 'other-actions'],
        ['key' => 'certify',       'label' => 'Certificate',          'icon' => 'comments',      'route_suffix' => 'certify'],
    ];
 }
@endphp

<aside id="admin-sidebar" class="w-64 min-h-screen bg-white border-r transition-all duration-300" data-role="{{ $role }}">
    <div class="p-4 flex flex-col h-full">

        {{-- Header / Role Label --}}
        <div class="px-2 mb-4">
            <div class="rounded p-2 {{ $themeClass }} flex items-center gap-3 shadow-sm">
                <div class="sidebar-label font-semibold capitalize">{{ $role }} Console</div>
            </div>
        </div>

        {{-- Dynamic Navigation --}}
        <nav class="space-y-1 flex-1 overflow-auto">
            @foreach($menuItems as $item)
                @php

                    $targetRoute = $role . '.' . $item['route_suffix'];
                @endphp

                {{-- CRITICAL: Only render if the route actually exists in web.php --}}
                @if(Route::has($targetRoute))
                    <a class="ajax-link block p-2 rounded flex items-center gap-3 transition-colors {{ $isActive($item['key'], $targetRoute) }}"
                       href="{{ route($targetRoute) }}"
                       data-section="{{ $item['key'] }}"
                       data-route="{{ route($targetRoute) }}">
                        
                        {{-- Icon Wrapper --}}
                        <span class="w-6 {{ $activeSection === $item['key'] ? 'text-white' : 'text-slate-500' }}">
                            {{-- Requires components like <x-icons.overview /> --}}
                            <x-dynamic-component :component="'icons.'.$item['icon']" class="w-5 h-5" />
                        </span>
                        
                        <span class="sidebar-label">{{ $item['label'] }}</span>
                    </a>
                @endif
            @endforeach
        </nav>

        {{-- Footer Toggle --}}
        <div class="pt-3 border-t mt-4">
            <button id="sidebar-toggle" aria-expanded="true" aria-controls="admin-sidebar" class="flex items-center gap-2 text-sm px-2 py-1 border rounded w-full hover:bg-gray-50 text-slate-500">
                <span id="toggle-open"><x-icons.toggle-open class="w-5 h-5" /></span>
                <span id="toggle-close" class="hidden"><x-icons.toggle-close class="w-5 h-5" /></span>
                <span class="sidebar-label">Hide sidebar</span>
            </button>
        </div>

    </div>
</aside>