{{-- resources/views/components/auth-hero.blade.php --}}
@php
  $title = $title ?? 'Welcome';
  $subtitle = $subtitle ?? '';
@endphp

<div class="text-center mb-6">
  {{-- Icons row --}}
  <div class="flex items-center justify-center gap-3 mb-3" aria-hidden="true">
    {{-- Rocket --}}
    <div class="p-2 rounded-full bg-slate-800/60 text-indigo-400 shadow-sm transform motion-safe:transition-transform motion-safe:duration-500 hover:-translate-y-1">
      <svg class="w-6 h-6 motion-safe:animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M14 2s-1 2-3 2-3-2-3-2-1 2-1 4 1 4 1 4-3 1-4 4c0 0 3 1 6 1s6-1 6-1 1-3-1-4 1-4 1-4-1-2-3-2z"></path>
        <path d="M9 21s.5-2 3-2 3 2 3 2"></path>
      </svg>
    </div>

    {{-- Confetti/star --}}
    <div class="p-2 rounded-full bg-slate-800/60 text-amber-400 shadow-sm transform motion-safe:transition-transform motion-safe:duration-500 hover:scale-105">
      <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
        <path d="M12 2l1.9 4.2L18.5 8l-3.4 2 1 4.3L12 12.7 7.9 14.3 8.9 10 5.5 8l4.6-1.8L12 2z"/>
      </svg>
    </div>

    {{-- Smile / badge --}}
    <div class="p-2 rounded-full bg-slate-800/60 text-pink-400 shadow-sm transform motion-safe:transition-transform motion-safe:duration-500 hover:rotate-6">
      <svg class="w-6 h-6 motion-safe:animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <circle cx="12" cy="12" r="9"></circle>
        <path d="M8 13s1.5 2 4 2 4-2 4-2"></path>
        <path d="M9 9h.01M15 9h.01"></path>
      </svg>
    </div>
  </div>

  {{-- Headline --}}
  <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
  {{ $title }}
</h2>

  {{-- Subtitle --}}
  @if($subtitle)
    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300 max-w-xs mx-auto">
  {{ $subtitle }}
</p>
  @endif
</div>
