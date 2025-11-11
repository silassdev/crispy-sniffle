@props(['href','#','icon'=>'','label'=>'','component'=>null])
<a href="{{ $href }}" class="flex items-center gap-3 p-2 rounded hover:bg-gray-100" wire:click.prevent="$emit('showSection','{{ $component }}')">
  {{-- simple heroicon mapping (replace with inline SVGs or heroicon components) --}}
  <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path d="M4 6h16M4 12h8m-8 6h16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
  </svg>
  <span class="text-sm">{{ $label }}</span>
</a>
