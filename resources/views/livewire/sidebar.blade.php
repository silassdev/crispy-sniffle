@php
    $role = $viewAs
        ?? session('view_as')
        ?? (auth()->user()->role ?? 'student');

    $colors = [
        'admin'   => 'bg-indigo-600 text-white',
        'trainer' => 'bg-emerald-600 text-white',
        'student' => 'bg-sky-600 text-white',
    ];

    $bg = $colors[$role] ?? 'bg-gray-700 text-white';
@endphp

   <aside data-role="{{ $role }}" data-active-section="{{ $activeSection }}" class="w-64 min-h-screen bg-white border-r">
  <div class="p-4 flex flex-col h-full">
    <div class="px-2 mb-4">
      <div class="rounded p-2 {{ $bg }} flex items-center gap-2">
        <div class="w-8 h-8 rounded bg-white/20 flex items-center justify-center text-sm font-bold">A</div>
        <div>
          <div class="font-semibold">{{ strtoupper($role) }} console</div>
          <div class="text-xs opacity-80">Quick actions</div>
        </div>
      </div>
    </div>



    <nav class="space-y-1 flex-1 overflow-auto">


      @if($role === 'admin')
        <button wire:click="showSection('overview')"
             type="button"
                class="dash-item w-full text-left p-2 rounded flex items-center gap-3 {{ $activeSection === 'overview' ? 'dash-active' : '' }}">
              <span class="w-6"> 
              <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H6a4 4 0 01-4-4v-2h5m6 6v-6m0 0V9a4 4 0 00-4-4H6a4 4 0 00-4 4v6h5" />
              </svg>
              </span>
              <span class="dash-label">Overview</span>
        </button>

        <button wire:click="showSection('students')"
          type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Students'">
          <span class="inline-block w-6 flex items-center justify-center">
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H6a4 4 0 01-4-4v-2h5m6 6v-6m0 0V9a4 4 0 00-4-4H6a4 4 0 00-4 4v6h5" />
            </svg>
          </span>
          <span class="dash-label">Students</span>
        </button>

        <button wire:click="showSection('admins')"
         type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Admins'">
          <span class="inline-block w-6 flex items-center justify-center">

            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4zM9 12l2 2 4-4" />
            </svg>
          </span>
          <span class="dash-label">Admins</span>
        </button>

        <button wire:click="showSection('trainers')"
         type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Trainers'">
          <span class="inline-block w-6 flex items-center justify-center">
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l9 5-9 5-9-5 9-5zm0 10v6m-6-8v6a6 6 0 0012 0v-6" />
            </svg>
          </span>
          <span class="dash-label">Trainers</span>
        </button>

        <button wire:click="showSection('community')"
         type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Community'">
          <span class="inline-block w-6 flex items-center justify-center">
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a4 4 0 01-4 4H8l-5 3V6a4 4 0 014-4h10a4 4 0 014 4v9z" />
            </svg>
          </span>
          <span class="dash-label">Community</span>
        </button>

        <button wire:click="showSection('comments')"
          type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Comments'">
          <span class="inline-block w-6 flex items-center justify-center">
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h8M8 13h6M5 20l-3 2V6a3 3 0 013-3h10a3 3 0 013 3v10a3 3 0 01-3 3H5z" />
            </svg>
          </span>
          <span class="dash-label">Comments</span>
        </button>

        <button wire:click="showSection('posts')"
          type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Posts'">
          <span class="inline-block w-6 flex items-center justify-center">
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h6M6 3h8l4 4v13a1 1 0 01-1 1H6a1 1 0 01-1-1V4a1 1 0 011-1z" />
            </svg>
          </span>
          <span class="dash-label">Posts</span>
        </button>

        <button wire:click="showSection('feedback')"
          type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Feedback'">
          <span class="inline-block w-6 flex items-center justify-center">
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a4 4 0 01-4 4H8l-5 3V6a4 4 0 014-4h10a4 4 0 014 4v9z" />
            </svg>
          </span>
          <span class="dash-label">Feedback</span>
        </button>

        <button wire:click="showSection('newsletter')"
          type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Newsletter'">
          <span class="inline-block w-6 flex items-center justify-center">  
        <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
         <rect x="3" y="5" width="18" height="14" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l8.5 5L20 7" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 15h10" />
          </svg>

          </span>
          <span class="dash-label">Newsletter</span>
        </button>

        <button wire:click="showSection('other-actions')"
          type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Other Actions'">
          <span class="inline-block w-6 flex items-center justify-center">
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 0h6v6h-6v-6z" />
            </svg>
          </span>
          <span class="dash-label">Other Actions</span>
        </button>

        <button wire:click="showSection('profile')"
          type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Profile'">
          <span class="inline-block w-6 flex items-center justify-center">
            <!-- profile -->
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 20v-1a6 6 0 0112 0v1" />
          </svg>
          </span>
          <span class="dash-label">Profile</span>
        </button>


      @elseif($role === 'trainer')
        <button wire:click="showSection('courses')"
          type="button"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Courses'">
          <span class="inline-block w-6 flex items-center justify-center">
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12M3 6h7a3 3 0 013 3v9H6a3 3 0 00-3 3V6zm18 0h-7a3 3 0 00-3 3v9h7a3 3 0 013 3V6z" />
            </svg>
          </span>
          <span class="dash-label">Courses</span>
        </button>




      @else
        <button wire:click="showSection('courses')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3"
          :title="open ? '' : 'Courses'">
          <span class="inline-block w-6 flex items-center justify-center">
            {{-- book-open (outline) --}}
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12M3 6h7a3 3 0 013 3v9H6a3 3 0 00-3 3V6zm18 0h-7a3 3 0 00-3 3v9h7a3 3 0 013 3V6z" />
            </svg>
          </span>
          <span class="dash-label">Courses</span>
        </button>
      @endif
    </nav>

    <div class="pt-3 border-t mt-4">
      <div class="flex items-center gap-2">

        <livewire:actions.logout />

        
      </div>
    </div>
  </div>
</aside>
