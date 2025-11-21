@php
    use Illuminate\Support\Facades\Route;

    $role = $role ?? session('view_as') ?? (auth()->check() ? auth()->user()->role : 'student');

    $colors = [
        'admin'   => 'bg-indigo-600 text-white',
        'trainer' => 'bg-emerald-600 text-white',
        'student' => 'bg-sky-600 text-white',
    ];
    $bg = $colors[$role] ?? 'bg-gray-700 text-white';

    // derive default active from current route name if none provided
    $current = $currentSection ?? null;
    if (!$current) {
        $r = optional(Route::current())->getName();
        $current = 'overview';
        if ($r) {
            if (Str::startsWith($r, 'admin.students')) $current = 'students';
            elseif (Str::startsWith($r, 'admin.trainers')) $current = 'trainers';
            elseif (Str::startsWith($r, 'admin.admins')) $current = 'admins';
            elseif (Str::startsWith($r, 'admin.community')) $current = 'community';
            elseif (Str::startsWith($r, 'admin.comments')) $current = 'comments';
            elseif (Str::startsWith($r, 'admin.posts')) $current = 'posts';
            elseif (Str::startsWith($r, 'admin.feedback')) $current = 'feedback';
            elseif (Str::startsWith($r, 'admin.other-actions')) $current = 'other-actions';
            else $current = 'overview';
        }
    }

    $isActive = function($name) use ($current) { return $current === $name ? 'dash-active' : ''; };
@endphp

<aside id="admin-sidebar" class="w-64 min-h-screen bg-white border-r" data-role="{{ $role }}">
  <div class="p-4 flex flex-col h-full">

  
    <div class="px-2 mb-4">
      <div class="rounded p-2 {{ $bg }} flex items-center gap-3">
        <div class="sidebar-label">
          <div class="font-semibold">{{ strtolower($role) }} </div>
        </div>
      </div>
    </div>
   
  @switch($role)
  @case('admin')

    <nav class="space-y-1 flex-1 overflow-auto">
      {{-- Overview --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('overview') }}"
         href="{{ route('admin.dashboard') }}"
         data-section="overview"
         data-route="{{ route('admin.dashboard') }}">
          <span class="w-6 text-slate-500"><x-icons.overview class="w-5 h-5" /></span>
          <span class="sidebar-label">Overview</span>
      </a>

      {{-- Students --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('students') }}"
         href="{{ route('admin.students.index') }}" data-section="students" data-route="{{ route('admin.students.index') }}">
          <span class="w-6 text-slate-500"><x-icons.students class="w-5 h-5" /></span>
          <span class="sidebar-label">Students</span>
      </a>

      {{-- Trainers --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('trainers') }}"
         href="{{ route('admin.trainers.index') }}" data-section="trainers" data-route="{{ route('admin.trainers.index') }}">
          <span class="w-6 text-slate-500"><x-icons.trainers class="w-5 h-5" /></span>
          <span class="sidebar-label">Trainers</span>
      </a>

      {{-- Admins --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('admins') }}"
         href="{{ route('admin.admins.index') }}" data-section="admins" data-route="{{ route('admin.admins.index') }}">
          <span class="w-6 text-slate-500"><x-icons.admins class="w-5 h-5" /></span>
          <span class="sidebar-label">Admins</span>
      </a>

      {{-- Community --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('community') }}"
         href="{{ route('admin.community') }}" data-section="community" data-route="{{ route('admin.community') }}">
          <span class="w-6 text-slate-500"><x-icons.community class="w-5 h-5" /></span>
          <span class="sidebar-label">Community</span>
      </a>

      {{-- Comments --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('comments') }}"
         href="{{ route('admin.comments') }}" data-section="comments" data-route="{{ route('admin.comments') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Comments</span>
      </a>

      {{-- Posts --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Posts</span>
      </a>

      {{-- Feedback --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('feedback') }}"
         href="{{ route('admin.feedback') }}" data-section="feedback" data-route="{{ route('admin.feedback') }}">
          <span class="w-6 text-slate-500"><x-icons.feedback class="w-5 h-5" /></span>
          <span class="sidebar-label">Feedback</span>
      </a>

      {{-- Other Actions --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('other-actions') }}"
         href="{{ route('admin.other-actions') }}" data-section="other-actions" data-route="{{ route('admin.other-actions') }}">
          <span class="w-6 text-slate-500"><x-icons.others class="w-5 h-5" /></span>
          <span class="sidebar-label">Other Actions</span>
      </a>

      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Certify & Achivement</span>
      </a>
       
        <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Newsletter</span>
      </a>

       <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Profile</span>
      </a>

    @break

     @case('trainer')
        <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('overview') }}"
         href="{{ route('admin.dashboard') }}" data-section="overview" data-route="{{ route('admin.dashboard') }}">
          <span class="w-6 text-slate-500"><x-icons.community class="w-5 h-5" /></span>
          <span class="sidebar-label">Overview</span>
      </a>

      {{-- Students --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('students') }}"
         href="{{ route('admin.students.index') }}" data-section="students" data-route="{{ route('admin.students.index') }}">
          <span class="w-6 text-slate-500"><x-icons.students class="w-5 h-5" /></span>
          <span class="sidebar-label">Students</span>
      </a>

      {{-- Trainers --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('trainers') }}"
         href="{{ route('admin.trainers.index') }}" data-section="trainers" data-route="{{ route('admin.trainers.index') }}">
          <span class="w-6 text-slate-500"><x-icons.trainers class="w-5 h-5" /></span>
          <span class="sidebar-label">Trainers</span>
      </a>

      {{-- Admins --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('admins') }}"
         href="{{ route('admin.admins.index') }}" data-section="admins" data-route="{{ route('admin.admins.index') }}">
          <span class="w-6 text-slate-500"><x-icons.admins class="w-5 h-5" /></span>
          <span class="sidebar-label">Admins</span>
      </a>

      {{-- Community --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('community') }}"
         href="{{ route('admin.community') }}" data-section="community" data-route="{{ route('admin.community') }}">
          <span class="w-6 text-slate-500"><x-icons.community class="w-5 h-5" /></span>
          <span class="sidebar-label">Community</span>
      </a>

      {{-- Comments --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('comments') }}"
         href="{{ route('admin.comments') }}" data-section="comments" data-route="{{ route('admin.comments') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Comments</span>
      </a>

      {{-- Posts --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Posts</span>
      </a>

      {{-- Feedback --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('feedback') }}"
         href="{{ route('admin.feedback') }}" data-section="feedback" data-route="{{ route('admin.feedback') }}">
          <span class="w-6 text-slate-500"><x-icons.feedback class="w-5 h-5" /></span>
          <span class="sidebar-label">Feedback</span>
      </a>

      {{-- Other Actions --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('other-actions') }}"
         href="{{ route('admin.other-actions') }}" data-section="other-actions" data-route="{{ route('admin.other-actions') }}">
          <span class="w-6 text-slate-500"><x-icons.others class="w-5 h-5" /></span>
          <span class="sidebar-label">Other Actions</span>
      </a>

      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Certify & Achivement</span>
      </a>
       
        <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Newsletter</span>
      </a>

       <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Profile</span>
      </a>

  @break

     @default
   

        <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('overview') }}"
         href="{{ route('admin.dashboard') }}" data-section="overview" data-route="{{ route('admin.dashboard') }}">
          <span class="w-6 text-slate-500"><x-icons.community class="w-5 h-5" /></span>
          <span class="sidebar-label">Overview</span>
      </a>

      {{-- Students --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('students') }}"
         href="{{ route('admin.students.index') }}" data-section="students" data-route="{{ route('admin.students.index') }}">
          <span class="w-6 text-slate-500"><x-icons.students class="w-5 h-5" /></span>
          <span class="sidebar-label">Students</span>
      </a>

      {{-- Trainers --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('trainers') }}"
         href="{{ route('admin.trainers.index') }}" data-section="trainers" data-route="{{ route('admin.trainers.index') }}">
          <span class="w-6 text-slate-500"><x-icons.trainers class="w-5 h-5" /></span>
          <span class="sidebar-label">Trainers</span>
      </a>

      {{-- Admins --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('admins') }}"
         href="{{ route('admin.admins.index') }}" data-section="admins" data-route="{{ route('admin.admins.index') }}">
          <span class="w-6 text-slate-500"><x-icons.admins class="w-5 h-5" /></span>
          <span class="sidebar-label">Admins</span>
      </a>

      {{-- Community --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('community') }}"
         href="{{ route('admin.community') }}" data-section="community" data-route="{{ route('admin.community') }}">
          <span class="w-6 text-slate-500"><x-icons.community class="w-5 h-5" /></span>
          <span class="sidebar-label">Community</span>
      </a>

      {{-- Comments --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('comments') }}"
         href="{{ route('admin.comments') }}" data-section="comments" data-route="{{ route('admin.comments') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Comments</span>
      </a>

      {{-- Posts --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Posts</span>
      </a>

      {{-- Feedback --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('feedback') }}"
         href="{{ route('admin.feedback') }}" data-section="feedback" data-route="{{ route('admin.feedback') }}">
          <span class="w-6 text-slate-500"><x-icons.feedback class="w-5 h-5" /></span>
          <span class="sidebar-label">Feedback</span>
      </a>

      {{-- Other Actions --}}
      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('other-actions') }}"
         href="{{ route('admin.other-actions') }}" data-section="other-actions" data-route="{{ route('admin.other-actions') }}">
          <span class="w-6 text-slate-500"><x-icons.others class="w-5 h-5" /></span>
          <span class="sidebar-label">Other Actions</span>
      </a>

      <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Certify & Achivement</span>
      </a>
       
        <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Newsletter</span>
      </a>

       <a class="ajax-link block p-2 rounded flex items-center gap-3 {{ $isActive('posts') }}"
         href="{{ route('admin.posts') }}" data-section="posts" data-route="{{ route('admin.posts') }}">
          <span class="w-6 text-slate-500"><x-icons.comments class="w-5 h-5" /></span>
          <span class="sidebar-label">Profile</span>
      </a>

  @break
@endswitch

    </nav>

    <div class="pt-3 border-t mt-4">
      <div class="flex items-center gap-2 justify-between">
        <!-- toggle -->
       <button id="sidebar-toggle" aria-expanded="true" aria-controls="admin-sidebar" class="flex items-center gap-2 text-sm px-2 py-1 border rounded">
       <span id="toggle-open"><x-icons.toggle-open class="w-5 h-5" /></span>
       <span id="toggle-close" class="hidden"><x-icons.toggle-close class="w-5 h-5" /></span>
       <span class="sidebar-label">Hide sidebar</span>
       </button>
      </div>
    </div>
  </div>
</aside>
