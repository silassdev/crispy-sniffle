<div>
  <div class="flex items-center justify-between mb-4 gap-3">
    <div class="flex items-center gap-2">
      <input wire:model.debounce.300ms="search" type="text" placeholder="Search trainers by name or email" class="px-3 py-2 border rounded w-72" />
      <button wire:click="$refresh" class="px-3 py-2 border rounded">Refresh</button>
    </div>

    <div class="text-sm text-gray-500">
      Pending: <strong>{{ $pending->count() }}</strong> • Approved total: <strong>{{ $approved->total() }}</strong>
    </div>
  </div>

  {{-- Pending trainers panel --}}
  <div class="mb-6">
    <h3 class="text-lg font-semibold mb-2">Pending trainers</h3>

    @if($pending->isEmpty())
      <div class="p-4 rounded border text-sm text-gray-500">No pending trainers.</div>
    @else
      <div class="grid gap-3">
        @foreach($pending as $t)
          <div class="p-3 bg-white rounded border flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-sm font-semibold">
                {{ strtoupper(substr($t->name,0,1)) }}
              </div>
              <div>
                <div class="font-medium">{{ $t->name }}</div>
                <div class="text-xs text-gray-500">{{ $t->email }}</div>
                <div class="text-xs text-gray-400">Registered {{ $t->created_at->diffForHumans() }}</div>
              </div>
            </div>

            <div class="flex items-center gap-2">
              <button wire:click="$set('viewingId', {{ $t->id }})" class="px-2 py-1 text-sm rounded border">View</button>

              <button wire:click="approve({{ $t->id }})"
                      wire:loading.attr="disabled"
                      wire:target="approve({{ $t->id }})"
                      class="px-3 py-1 text-sm rounded bg-emerald-600 text-white hover:bg-emerald-700">
                <span wire:loading wire:target="approve({{ $t->id }})" class="loader inline-block mr-2"></span>
                Approve
              </button>

              <button wire:click="reject({{ $t->id }})"
                      wire:loading.attr="disabled"
                      wire:target="reject({{ $t->id }})"
                      class="px-3 py-1 text-sm rounded bg-yellow-500 text-white hover:bg-yellow-600">
                <span wire:loading wire:target="reject({{ $t->id }})" class="loader inline-block mr-2"></span>
                Reject
              </button>

              <button wire:click="confirmDelete({{ $t->id }})" class="px-3 py-1 text-sm rounded bg-red-600 text-white hover:bg-red-700">
                Delete
              </button>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>

  {{-- Approved trainers (paginated) --}}
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
        @forelse($approved as $t)
          <tr>
            <td class="px-4 py-3">{{ $t->name }}</td>
            <td class="px-4 py-3">{{ $t->email }}</td>
            <td class="px-4 py-3">{{ $t->created_at->toDateString() }}</td>
            <td class="px-4 py-3 text-right">
              <button wire:click="$set('viewingId', {{ $t->id }})" class="inline-block mr-2 text-sm px-3 py-1 border rounded">View</button>

              <a href="{{ route('admin.trainers.show', $t->id) }}" class="inline-block mr-2 text-sm px-3 py-1 border rounded">Profile</a>

              <button wire:click="confirmDelete({{ $t->id }})"
                      wire:loading.attr="disabled"
                      wire:target="destroyConfirmed"
                      class="inline-block text-sm px-3 py-1 bg-red-600 text-white rounded">
                <span wire:loading wire:target="destroyConfirmed" class="loader inline-block mr-2"></span>Delete
              </button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-4 py-6 text-center text-gray-500">No approved trainers yet.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div class="p-4">
      {{ $approved->links() }}
    </div>
  </div>

  {{-- confirm delete modal (Livewire-only) --}}
  @if($confirmDeleteId)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
      <div class="bg-white p-6 rounded shadow">
        <h3 class="font-semibold mb-3">Confirm delete</h3>
        <p class="text-sm text-gray-600 mb-4">This action is permanent. Are you sure?</p>
        <div class="flex gap-2">
          <button wire:click="destroyConfirmed" class="px-4 py-2 bg-red-600 text-white rounded">Yes, delete</button>
          <button wire:click="$set('confirmDeleteId', null)" class="px-4 py-2 border rounded">Cancel</button>
        </div>
      </div>
    </div>
  @endif

  {{-- trainer modal (Livewire-only) --}}
  @if($viewingId && $viewingTrainer)
    <div class="fixed inset-0 z-50 flex items-start sm:items-center justify-center p-4 bg-black/40">
      <div class="bg-white w-full sm:max-w-2xl rounded shadow p-6 overflow-auto max-h-[80vh]">
        <div class="flex gap-6">
          <div class="w-1/3">
            <div class="w-full h-40 bg-gray-100 rounded flex items-center justify-center text-xl font-bold">
              {{ strtoupper(substr($viewingTrainer->name,0,1)) }}
            </div>
            <div class="mt-3 text-sm">
              <div class="font-medium">{{ $viewingTrainer->name }}</div>
              <div class="text-gray-500">{{ $viewingTrainer->email }}</div>
              <div class="text-xs text-gray-400">Joined: {{ $viewingTrainer->created_at->toDayDateTimeString() }}</div>
            </div>
          </div>

          <div class="flex-1">
            <h3 class="text-lg font-semibold mb-2">Profile</h3>
            <div class="grid grid-cols-2 gap-3 text-sm text-gray-700">
              <div><strong>Bio:</strong> {{ $viewingTrainer->bio ?? '—' }}</div>
              <div><strong>Phone:</strong> {{ $viewingTrainer->phone ?? '—' }}</div>
              
              <div><strong>Approved:</strong>
       {{ $viewingTrainer->approved
      ? ($viewingTrainer->approved_at?->toDayDateTimeString() ?? 'Yes')
      : 'No' }}
            </div>

     <div><strong>Rejected:</strong>
       {{ $viewingTrainer->rejected
      ? ($viewingTrainer->rejected_at?->toDayDateTimeString() ?? 'Yes')
      : 'No' }}
             </div>

              <div class="col-span-2 mt-2"><strong>Other info:</strong> {{ $viewingTrainer->additional_info ?? '—' }}</div>
            </div>

            <div class="mt-4 flex gap-2">
              @if(! $viewingTrainer->approved && ! $viewingTrainer->rejected)
                <button wire:click="approve({{ $viewingTrainer->id }})" class="px-3 py-1 bg-emerald-600 text-white rounded">Approve</button>
                <button wire:click="reject({{ $viewingTrainer->id }})" class="px-3 py-1 bg-yellow-500 text-white rounded">Reject</button>
              @endif
              <button wire:click="closeModal()" class="px-3 py-1 border rounded">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

</div>
