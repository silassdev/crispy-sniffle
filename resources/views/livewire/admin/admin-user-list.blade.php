<div>
  <div class="flex items-center justify-between mb-4">
    <div class="flex gap-2">
      <input wire:model.debounce.300ms="search" placeholder="Search admins" class="px-3 py-2 border rounded w-72" />
      <button wire:click="$refresh" class="px-3 py-2 border rounded">Refresh</button>
    </div>

    <div class="flex items-center gap-2">
      <input wire:model="inviteEmail" type="email" placeholder="Invite admin email" class="px-3 py-2 border rounded" />
      <button wire:click="inviteAdmin" class="px-3 py-2 bg-indigo-600 text-white rounded">Invite</button>
    </div>
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
        @forelse($admins as $a)
          <tr>
            <td class="px-4 py-3">{{ $a->name }}</td>
            <td class="px-4 py-3">{{ $a->email }}</td>
            <td class="px-4 py-3">{{ $a->created_at->toDateString() }}</td>
            <td class="px-4 py-3 text-right">
              <button wire:click="$set('viewingId', {{ $a->id }})" class="inline-block mr-2 text-sm px-3 py-1 border rounded">View</button>
              <button wire:click="sendReset({{ $a->id }})" class="inline-block mr-2 text-sm px-3 py-1 border rounded">Send Reset</button>
              <button wire:click="confirmDelete({{ $a->id }})" class="inline-block text-sm px-3 py-1 bg-red-600 text-white rounded">Delete</button>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">No admins found.</td></tr>
        @endforelse
      </tbody>
    </table>

    <div class="p-4">{{ $admins->links() }}</div>
  </div>

  {{-- confirm delete --}}
  @if($confirmDeleteId)
    <div class="fixed inset-0 z-40 flex items-center justify-center bg-black/40">
      <div class="bg-white p-6 rounded shadow">
        <h3 class="font-semibold mb-2">Confirm delete</h3>
        <p class="text-sm text-gray-600 mb-4">This will permanently remove the admin.</p>
        <div class="flex gap-2">
          <button wire:click="destroyConfirmed" class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
          <button wire:click="$set('confirmDeleteId', null)" class="px-4 py-2 border rounded">Cancel</button>
        </div>
      </div>
    </div>
  @endif

  {{-- admin modal --}}
  @if($viewingId && $viewingAdmin)
    <div class="fixed inset-0 z-50 flex items-start sm:items-center justify-center p-4 bg-black/40">
      <div class="bg-white w-full sm:max-w-2xl rounded shadow p-6 overflow-auto max-h-[80vh]">
        <div class="flex gap-6">
          <div class="w-1/3">
            <div class="w-full h-40 bg-gray-100 rounded flex items-center justify-center text-xl font-bold">
              {{ strtoupper(substr($viewingAdmin->name,0,1)) }}
            </div>
            <div class="mt-3 text-sm">
              <div class="font-medium">{{ $viewingAdmin->name }}</div>
              <div class="text-gray-500">{{ $viewingAdmin->email }}</div>
              <div class="text-xs text-gray-400">Joined: {{ $viewingAdmin->created_at->toDayDateTimeString() }}</div>
            </div>
          </div>

          <div class="flex-1">
            <h3 class="text-lg font-semibold mb-2">Admin details</h3>
            <div class="grid grid-cols-2 gap-3 text-sm text-gray-700">
              <div><strong>Phone:</strong> {{ $viewingAdmin->phone ?? '—' }}</div>
              <div><strong>Last active:</strong> {{ $viewingAdmin->last_active_at ?? '—' }}</div>
              <div class="col-span-2"><strong>Notes:</strong> {{ $viewingAdmin->notes ?? '—' }}</div>
            </div>

            <div class="mt-4 flex gap-2">
              <button wire:click="$set('viewingId', null)" class="px-3 py-1 border rounded">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
