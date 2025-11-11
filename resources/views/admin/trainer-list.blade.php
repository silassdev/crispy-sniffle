<div class="bg-white rounded shadow p-4">
  <div class="flex gap-2 mb-4">
    <input wire:model.debounce.300ms="q" class="border rounded px-3 py-2" placeholder="Search by name or email">
    <select wire:model="perPage" class="border rounded px-2 py-2">
      <option value="5">5</option><option value="10">10</option><option value="25">25</option>
    </select>
    <select wire:model="sort" class="border rounded px-2 py-2">
      <option value="created_at">Newest</option>
      <option value="name">Name</option>
      <option value="email">Email</option>
    </select>
    <button wire:click="$set('dir', dir === 'desc' ? 'asc' : 'desc')" class="px-3 py-2 border rounded">Toggle dir</button>
  </div>

  <div class="space-y-2">
    @foreach($trainers as $t)
      <div class="flex items-center justify-between p-2 border rounded">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">{{ strtoupper(substr($t->name,0,1)) }}</div>
          <div>
            <div class="font-medium">{{ $t->name }}</div>
            <div class="text-xs text-gray-500">{{ $t->email }}</div>
            <div class="text-xs text-gray-400">Status: {{ $t->approved ? 'Approved' : 'Pending' }}</div>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <a href="{{ route('admin.trainer.view', $t->id) }}" class="text-sm text-blue-600">View</a>
          <a href="{{ route('admin.trainer.edit', $t->id) }}" class="text-sm text-yellow-600">Edit</a>
          <button wire:click="delete({{ $t->id }})" class="text-sm text-red-600">Delete</button>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-4">
    {{ $trainers->links() }}
  </div>
</div>
