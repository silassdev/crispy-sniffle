<div class="space-y-3">
  <div class="flex items-center justify-between">
    <h4 class="font-semibold">Certificate Requests</h4>
    <div>
      <input wire:model.debounce.300ms="q" placeholder="search student" class="border rounded px-2 py-1" />
      <select wire:model="status" class="border rounded px-2 py-1 text-sm">
        <option value="pending">Pending</option>
        <option value="approved">Approved</option>
        <option value="rejected">Rejected</option>
        <option value="all">All</option>
      </select>
    </div>
  </div>

  <div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50"><tr><th class="p-2">Student</th><th class="p-2">Trainer</th><th class="p-2">Type</th><th class="p-2">Status</th><th class="p-2 text-right">Actions</th></tr></thead>
      <tbody>
        @foreach($certs as $c)
        <tr class="border-t">
          <td class="p-2">{{ $c->student->name }} <div class="text-xs text-gray-500">{{ $c->student->email }}</div></td>
          <td class="p-2">{{ $c->trainer->name }}</td>
          <td class="p-2">{{ $c->type }}</td>
          <td class="p-2">
            <span class="text-xs px-2 py-1 rounded {{ $c->status==='approved'?'bg-emerald-100 text-emerald-700' : ($c->status==='rejected'?'bg-red-100 text-red-700':'bg-yellow-100 text-yellow-700') }}">{{ ucfirst($c->status) }}</span>
          </td>
          <td class="p-2 text-right">
            @if($c->status === 'pending')
              <button wire:click="approve({{ $c->id }})" class="px-2 py-1 bg-emerald-600 text-white rounded text-xs">Approve</button>
              <button onclick="return showRejectModal({{ $c->id }})" class="px-2 py-1 border rounded text-xs">Reject</button>
            @else
              <a href="{{ route('certificates.public', $c->certificate_number) }}" class="text-xs text-indigo-600">View</a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="p-3">{{ $certs->links() }}</div>
  </div>
</div>

<script>
  function showRejectModal(id) {
    const note = prompt('Enter rejection note (optional)');
    if(note === null) return;
    Livewire.emit('reject', id, note);
  }
</script>
