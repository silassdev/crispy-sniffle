@php
  // role color map (tailwind utilities)
  $colors = [
    'admin' => 'bg-indigo-600 text-white',
    'trainer' => 'bg-emerald-600 text-white',
    'student' => 'bg-sky-600 text-white',
  ];
  $bg = $colors[$role] ?? 'bg-gray-700 text-white';
@endphp

<div class="px-2 py-4">
  {{-- section header --}}
  <div class="px-2 mb-4" x-show="open">
    <div class="rounded p-2 {{ $bg }}">
      <div class="flex items-center gap-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3v6h8v-6h3a1 1 0 001-1V7"/>
        </svg>
        <div>
          <div class="font-semibold">{{ ucfirst($role) }} Console</div>
          <div class="text-xs opacity-80">Quick actions & overview</div>
        </div>
      </div>
    </div>
  </div>

  {{-- menu items (for admin populate many items) --}}
  <nav class="space-y-1">
    @if($role === 'admin')
      <x-dash-item href="#" icon="users" label="Students" component="students" />
      <x-dash-item href="#" icon="shield-check" label="Admins" component="admins" />
      <x-dash-item href="#" icon="academic-cap" label="Trainers" component="trainers" />
      <x-dash-item href="#" icon="chat" label="Community" component="community" />
      <x-dash-item href="#" icon="chat-bubble-left-right" label="Comments" component="comments" />
      <x-dash-item href="#" icon="document-text" label="Posts" component="posts" />
      <x-dash-item href="#" icon="chat-alt-2" label="Feedback" component="feedback" />
    @elseif($role === 'trainer')
      <x-dash-item href="#" icon="play" label="My Courses" component="courses" />
      <x-dash-item href="#" icon="users" label="My Students" component="my-students" />
      <x-dash-item href="#" icon="video-camera" label="Videos" component="videos" />
      <x-dash-item href="#" icon="pencil" label="Create Post" component="create-post" />
    @else
      <x-dash-item href="#" icon="home" label="Courses" component="courses" />
      <x-dash-item href="#" icon="book-open" label="My Notes" component="notes" />
      <x-dash-item href="#" icon="chat" label="Community" component="community" />
      <x-dash-item href="#" icon="user" label="Profile" component="profile" />
    @endif
  </nav>
</div>

{{-- small Blade component for menu item --}}
@once
@push('blade-components')
  @php
    // register inline component for dash-item if not using separate file
  @endphp
@endpush
@endonce
