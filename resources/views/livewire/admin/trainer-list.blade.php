<div>
  <div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-2">
      <input type="text" wire:model.debounce.300ms="search" placeholder="Search by name or email"
             class="px-3 py-2 border rounded w-64" />
      <button wire:click="$refresh" class="px-3 py-2 border rounded">Refresh</button>
    </div>
    <div>
      <span class="text-sm text-gray-500">Showing {{ $trainers->total() }} trainers</span>
    </div>
  </div>

  <div class="bg-white rounded shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left">Name</th>
          <th class="px-4 py-2 text-left">Email</th>
          <th class="px-4 py-2 text-left">Status</th>
          <th class="px-4 py-2 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100">
        @forelse($trainers as $t)
          <tr>
            <td class="px-4 py-3">{{ $t->name }}</td>
            <td class="px-4 py-3">{{ $t->email }}</td>
            <td class="px-4 py-3">
              @if($t->isApproved())
                <span class="px-2 py-1 rounded text-xs bg-emerald-100 text-emerald-800">Approved</span>
              @elseif($t->rejected)
                <span class="px-2 py-1 rounded text-xs bg-red-100 text-red-800">Rejected</span>
              @else
                <span class="px-2 py-1 rounded text-xs bg-yellow-100 text-yellow-800">Pending</span>
              @endif
            </td>
            <td class="px-4 py-3 text-right">
              <a href="{{ route('admin.trainers.show', $t->id) }}" class="inline-block mr-2 text-sm">View</a>

              @if(! $t->isApproved() && ! $t->rejected)
                <button wire:click="approve({{ $t->id }})"
                        wire:loading.attr="disabled"
                        wire:target="approve({{ $t->id }})"
                        class="inline-flex items-center px-3 py-1 text-sm rounded bg-emerald-600 text-white hover:bg-emerald-700 mr-2">
                  <span wire:loading wire:target="approve({{ $t->id }})" class="loader mr-2"></span>Approve
                </button>

                <button wire:click="reject({{ $t->id }})"
                        wire:loading.attr="disabled"
                        wire:target="reject({{ $t->id }})"
                        class="inline-flex items-center px-3 py-1 text-sm rounded bg-yellow-500 text-white hover:bg-yellow-600 mr-2">
                  <span wire:loading wire:target="reject({{ $t->id }})" class="loader mr-2"></span>Reject
                </button>
              @endif

              <button wire:click="destroy({{ $t->id }})"
                      wire:loading.attr="disabled"
                      wire:target="destroy({{ $t->id }})"
                      class="inline-flex items-center px-3 py-1 text-sm rounded bg-red-600 text-white hover:bg-red-700">
                <span wire:loading wire:target="destroy({{ $t->id }})" class="loader mr-2"></span>Delete
              </button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-4 py-6 text-center text-gray-500">No trainers found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="p-4">
      {{ $trainers->links() }}
    </div>
  </div>
</div>

{{-- small CSS loader (or reuse your donut component) --}}
<style>
.loader {
  width: 14px;
  height: 14px;
  border: 2px solid rgba(255,255,255,0.3);
  border-top-color: rgba(255,255,255,1);
  border-radius: 50%;
  display: inline-block;
  animation: spin 0.9s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }
</style>
