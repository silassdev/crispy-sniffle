<div class="space-y-4">
  <div class="flex items-center justify-between">
    <h3 class="text-lg font-semibold">Feedback</h3>
    <div>
      <input wire:model.debounce.300ms="q" placeholder="search name/email/message" class="border rounded px-3 py-1"/>
    </div>
  </div>

  <div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50">
        <tr><th class="p-2 text-left">Name</th><th class="p-2">Email</th><th class="p-2">Country</th><th class="p-2">Type</th><th class="p-2">Date</th><th class="p-2 text-right">Action</th></tr>
      </thead>
      <tbody>
      @foreach($items as $f)
        <tr class="border-t">
          <td class="p-2">{{ $f->name }}</td>
          <td class="p-2">{{ $f->email }}</td>
          <td class="p-2">{{ $f->country }}</td>
          <td class="p-2">{{ $f->type }}</td>
          <td class="p-2">{{ $f->created_at->diffForHumans() }}</td>
          <td class="p-2 text-right">
            <button wire:click="view({{ $f->id }})" class="px-2 py-1 border rounded text-xs">View</button>
            <button wire:click="markResolved({{ $f->id }})" class="px-2 py-1 border rounded text-xs">Resolve</button>
            <button wire:click="delete({{ $f->id }})" class="px-2 py-1 border rounded text-xs text-red-600">Delete</button>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

    <div class="p-3">{{ $items->links() }}</div>
  </div>

  {{-- view modal --}}
  @if($viewItem)
    <div class="fixed inset-0 z-50 flex items-start justify-center pt-20">
      <div class="absolute inset-0 bg-black/40" wire:click="$set('viewing', null)"></div>
      <div class="relative z-10 w-full max-w-2xl bg-white rounded shadow-lg p-6">
        <div class="flex justify-between items-start">
          <div>
            <h4 class="font-semibold">{{ $viewItem->name ?: 'Unknown' }}</h4>
            <div class="text-xs text-gray-500">{{ $viewItem->email }} • {{ $viewItem->country }}</div>
          </div>
          <div>
            <button wire:click="$set('viewing', null)" class="px-2 py-1 border rounded text-sm">Close</button>
          </div>
        </div>

        <div class="mt-4 prose max-w-none">{!! nl2br(e($viewItem->message)) !!}</div>

        <div class="mt-4 flex gap-2">
          @if(!$viewItem->resolved)
            <button wire:click="markResolved({{ $viewItem->id }})" class="px-3 py-1 bg-emerald-600 text-white rounded">Mark resolved</button>
          @endif
          <button wire:click="delete({{ $viewItem->id }})" class="px-3 py-1 border rounded text-red-600">Delete</button>
        </div>
      </div>
    </div>
  @endif

</div>
