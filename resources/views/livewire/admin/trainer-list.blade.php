<div class="relative">
  {{-- loader overlay while component is performing any action or initial load --}}
  <div wire:loading.delay.class="opacity-100" wire:target="approve,reject,delete,view,*" class="absolute inset-0 z-40 flex items-center justify-center bg-white/60 opacity-0 transition-opacity">
    @include('components.donut-loader') {{-- or <x-donut-loader /> --}}
  </div>
  <div wire:loading.remove.delay>
  

 <div class="bg-white rounded shadow p-4">
  <div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-2">
      <input wire:model.debounce.300ms="q" type="search" placeholder="Search name or email" class="border rounded px-3 py-2" />
      <select wire:model="perPage" class="border rounded px-2 py-2">
        <option value="5">5</option><option value="10">10</option><option value="25">25</option>
      </select>
      <button wire:click="$set('q','')" class="text-sm text-gray-500">Clear</button>
    </div>

    <div class="flex items-center gap-2">
      <button wire:click="setSort('name')" class="text-sm px-2 py-1 border rounded">Sort: Name</button>
      <button wire:click="setSort('created_at')" class="text-sm px-2 py-1 border rounded">Sort: Newest</button>
    </div>
  </div>

  <div class="space-y-2">
    @forelse($trainers as $t)
      <div class="flex items-center justify-between p-3 border rounded">

        <div class="flex items-center gap-3">
  @if(!$t->approved && ! $t->rejected_at)
    <button wire:click="approve({{ $t->id }})" wire:loading.attr="disabled" wire:target="approve" class="px-2 py-1 text-sm bg-green-600 text-white rounded" title="Approve">
      <span wire:loading.remove wire:target="approve">Approve</span>
      <span wire:loading wire:target="approve">@include('components.donut-loader-small')</span>
    </button>

    <button wire:click="reject({{ $t->id }})" wire:loading.attr="disabled" wire:target="reject" class="px-2 py-1 text-sm bg-red-600 text-white rounded" title="Reject" onclick="return confirm('Rejecting is irreversible. Continue?')">
      <span wire:loading.remove wire:target="reject">Reject</span>
      <span wire:loading wire:target="reject">@include('components.donut-loader-small')</span>
    </button>
  @endif

  <button wire:click="view({{ $t->id }})" wire:loading.attr="disabled" wire:target="view" class="px-2 py-1 text-sm border rounded" title="View">
    <span wire:loading.remove wire:target="view">View</span>
    <span wire:loading wire:target="view">@include('components.donut-loader-small')</span>
  </button>

  <button wire:click="delete({{ $t->id }})" wire:loading.attr="disabled" wire:target="delete" class="px-2 py-1 text-sm border rounded text-red-600" onclick="return confirm('Delete trainer? This cannot be undone.')">
    <span wire:loading.remove wire:target="delete">Delete</span>
    <span wire:loading wire:target="delete">@include('components.donut-loader-small')</span>
  </button>
</div>


      </div>
    @empty
      <div class="p-4 text-center text-gray-500">No trainers found.</div>
    @endforelse
  </div>

      <div class="mt-4">
    {{ $trainers->links() }}
    </div>
   </div>
  </div>
</div>