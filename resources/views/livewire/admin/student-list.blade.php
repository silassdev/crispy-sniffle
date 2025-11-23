<div>
  <div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-2">
      <input wire:model.debounce.300ms="search" placeholder="Search students by name or email" class="px-3 py-2 border rounded w-72" />
      <button wire:click="$refresh" class="px-3 py-2 border rounded">Refresh</button>
    </div>
    <div class="text-sm text-gray-500">Showing {{ $students->total() }} students</div>
  </div>

  <div class="bg-white rounded shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left">Name</th>
          <th class="px-4 py-2 text-left">Email</th>
          <th class="px-4 py-2 text-left">Joined</th>
          <th class="px-4 py-2 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100">
        @forelse($students as $s)
          <tr>
            <td class="px-4 py-3">{{ $s->name }}</td>
            <td class="px-4 py-3">{{ $s->email }}</td>
            <td class="px-4 py-3">{{ $s->created_at->toDateString() }}</td>
            <td class="px-4 py-3 text-right">
              <button wire:click="$set('viewingId', {{ $s->id }})" class="inline-block mr-2 text-sm px-3 py-1 border rounded">View</button>

              <button wire:click="confirmDelete({{ $s->id }})" class="inline-block text-sm px-3 py-1 bg-red-600 text-white rounded">
                Delete
              </button>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">No students found.</td></tr>
        @endforelse
      </tbody>
    </table>

    <div class="p-4">
      {{ $students->links() }}
    </div>
  </div>

  {{-- confirm delete --}}
  @if($confirmDeleteId)
    <div class="fixed inset-0 z-40 flex items-center justify-center bg-black/40">
      <div class="bg-white p-6 rounded shadow">
        <h3 class="font-semibold mb-2">Confirm delete</h3>
        <p class="text-sm text-gray-600 mb-4">This will permanently remove the student.</p>
        <div class="flex gap-2">
          <button wire:click="destroyConfirmed" class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
          <button wire:click="$set('confirmDeleteId', null)" class="px-4 py-2 border rounded">Cancel</button>
        </div>
      </div>
    </div>
  @endif

  {{-- student modal --}}
  @if($viewingId && $viewingStudent)
    <div class="fixed inset-0 z-50 flex items-start sm:items-center justify-center p-4 bg-black/40">
      <div class="bg-white w-full sm:max-w-2xl rounded shadow p-6 overflow-auto max-h-[80vh]">
        <div class="flex gap-6">
          <div class="w-1/3">
            <div class="w-full h-40 bg-gray-100 rounded flex items-center justify-center text-xl font-bold">
              {{ strtoupper(substr($viewingStudent->name,0,1)) }}
            </div>
            <div class="mt-3 text-sm">
              <div class="font-medium">{{ $viewingStudent->name }}</div>
              <div class="text-gray-500">{{ $viewingStudent->email }}</div>
              <div class="text-xs text-gray-400">Joined: {{ $viewingStudent->created_at->toDayDateTimeString() }}</div>
            </div>
          </div>

          <div class="flex-1">
            <h3 class="text-lg font-semibold mb-2">Profile & stats</h3>
            <div class="grid grid-cols-2 gap-3 text-sm text-gray-700">
              {{-- placeholders: add/replace fields from your user model --}}
              <div><strong>Phone:</strong> {{ $viewingStudent->phone ?? '—' }}</div>
              <div><strong>Location:</strong> {{ $viewingStudent->location ?? '—' }}</div>
              <div><strong>Courses enrolled:</strong> {{ $viewingStudent->courses_count ?? '0' }}</div>
              <div><strong>Completed:</strong> {{ $viewingStudent->completed_courses ?? '0' }}</div>
              <div><strong>Total score:</strong> {{ $viewingStudent->total_score ?? '0' }}</div>
              <div><strong>Badges:</strong> {{ implode(', ', $viewingStudent->badges ?? []) ?: '—' }}</div>
              <div class="col-span-2"><strong>Bio:</strong> {{ $viewingStudent->bio ?? '—' }}</div>
              <div class="col-span-2"><strong>Preferences:</strong> {{ $viewingStudent->preferences ?? '—' }}</div>
              <div class="col-span-2"><strong>Certificates / Links:</strong> {{-- example list --}}
                @if(!empty($viewingStudent->certificates))
                  <ul class="list-disc ml-4 text-sm">
                    @foreach($viewingStudent->certificates as $c)
                      <li><a href="{{ $c['url'] }}" target="_blank" class="text-blue-600 hover:underline">{{ $c['title'] ?? 'certificate' }}</a></li>
                    @endforeach
                  </ul>
                @else
                  — 
                @endif
              </div>
            </div>

            <div class="mt-4 flex gap-2">
              <a href="{{ route('admin.students.show', $viewingStudent->id) }}" class="px-3 py-1 border rounded">Full profile</a>
              <button wire:click="closeModal()" class="px-3 py-1 border rounded">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

  <style>.loader{width:14px;height:14px;border:2px solid rgba(0,0,0,0.08);border-top-color:#111;border-radius:50%;animation:spin .9s linear infinite}@keyframes spin{to{transform:rotate(360deg)}}</style>
</div>
