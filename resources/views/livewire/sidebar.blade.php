@include('dashboards.partials.sidebar', ['role' => $role, 'open' => $open])

<div class="px-2 py-4">
  @php
    $role = $viewAs ?? (auth()->check() ? auth()->user()->role : 'student');
    $colors = [
      'admin' => 'bg-indigo-600 text-white',
      'trainer' => 'bg-emerald-600 text-white',
      'student' => 'bg-sky-600 text-white',
    ];
    $bg = $colors[$role] ?? 'bg-gray-700 text-white';
  @endphp

  <div class="px-2 mb-4">
    <div class="rounded p-2 {{ $bg }}">
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 rounded bg-white/20 flex items-center justify-center text-sm font-bold">A</div>
        <div>
          <div class="font-semibold">{{ strtoupper($role) }} console</div>
          <div class="text-xs opacity-80">Quick actions</div>
        </div>
      </div>
    </div>
  </div>

  <nav class="space-y-1">
    {{-- admin items --}}
    @if($role === 'admin')
      <button wire:click="showSection('students')" class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"><span class="inline-block">{!! svg('users') !!}</span><span class="dash-label">Students</span></button>
      <button wire:click="showSection('admins')" class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"><span class="inline-block">{!! svg('shield-check') !!}</span><span class="dash-label">Admins</span></button>
      <button wire:click="showSection('trainers')" class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"><span class="inline-block">{!! svg('academic-cap') !!}</span><span class="dash-label">Trainers</span></button>
      <button wire:click="showSection('community')" class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"><span class="inline-block">{!! svg('chat') !!}</span><span class="dash-label">Community</span></button>
      <button wire:click="showSection('comments')" class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"><span class="inline-block">{!! svg('chat-bubble-left-right') !!}</span><span class="dash-label">Comments</span></button>
      <button wire:click="showSection('posts')" class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"><span class="inline-block">{!! svg('document-text') !!}</span><span class="dash-label">Posts</span></button>
      <button wire:click="showSection('feedback')" class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"><span class="inline-block">{!! svg('chat') !!}</span><span class="dash-label">Feedback</span></button>
      <button wire:click="showSection('other-actions')" class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"><span class="inline-block">{!! svg('view-grid') !!}</span><span class="dash-label">Other Actions</span></button>
    @elseif($role === 'trainer')
      <button wire:click="showSection('courses')" class="dash-item ...">...courses</button>
      {{-- add trainer items --}}
    @else
      <button wire:click="showSection('courses')" class="dash-item ...">...courses</button>
    @endif
  </nav>
</div>
