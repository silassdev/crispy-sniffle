@php
    $role = $role 
        ?? session('view_as') 
        ?? (auth()->user()->role ?? 'student');
@endphp

<livewire:sidebar :role="$role" />
