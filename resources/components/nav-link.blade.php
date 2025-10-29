@props(['href','#','activePattern'=>null])
@php
  $isActive = $activePattern ? request()->routeIs($activePattern) : request()->url() === url($href);
@endphp

<a href="{{ $href }}" {{ $attributes->class([
     'px-3 py-2 rounded inline-flex items-center gap-3 transition-colors duration-200',
     'text-white font-semibold' => $isActive,
     'text-slate-600 hover:text-white' => ! $isActive
]) }}>
  {{ $slot }}
</a>
