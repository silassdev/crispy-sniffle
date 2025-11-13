@php
    $section = $section ?? 'overview';
    $counters = $counters ?? [
        'students' => 0,
        'trainers' => 0,
        'admins' => 0,
        'posts' => 0,
        'invites' => 10,
    ];
    $recentApprovedTrainers = $recentApprovedTrainers ?? collect();
@endphp
  
  

<div class="space-y-6">
  @if($section === 'overview')
    <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-4">
      <x-stat-card title="Students" :value="$counters['students']" color="indigo" />
      <x-stat-card title="Trainers" :value="$counters['trainers']" color="emerald" />
      <x-stat-card title="Admins" :value="$counters['admins']" color="gray" />
      <x-stat-card title="Posts" :value="$counters['posts']" color="sky" />
      <x-stat-card title="Invites" :value="$counters['invites']" color="amber" />
    </div>

    {{-- recent trainers list --}}
    <div class="mt-6 bg-white rounded shadow p-4">
      <h3 class="font-semibold mb-3">Recent 10 Approved Trainers</h3>
      <div class="space-y-2">
        @foreach($recentApprovedTrainers as $t)
          <div class="flex items-center justify-between p-2 border rounded">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">{{ strtoupper(substr($t->name,0,1)) }}</div>
              <div>
                <div class="font-medium">{{ $t->name }}</div>
                <div class="text-xs text-gray-500">{{ $t->email }}</div>
              </div>
            </div>
            <div class="flex gap-2">
              <a href="{{ route('admin.trainer.view', $t->id) }}" class="text-sm text-blue-600">View</a>
              <a href="{{ route('admin.trainer.edit', $t->id) }}" class="text-sm text-yellow-600">Edit</a>
              <button wire:click="$emit('deleteTrainer', {{ $t->id }})" class="text-sm text-red-600">Delete</button>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @elseif($section === 'trainers')
    <livewire:admin.trainer-list :per-page="$perPage" />
  @elseif($section === 'students')
    <livewire:admin.student-list :per-page="$perPage" />
  @elseif($section === 'admins')
    <livewire:admin.admin-list :per-page="$perPage" />
  @else
    <div class="bg-white rounded shadow p-6">Section: {{ $section }} - add component or content here.</div>
  @endif
</div>
