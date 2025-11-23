<div class="space-y-4">
  {{-- header --}}
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-semibold">{{ $user->name }}</h1>
      <div class="text-sm text-gray-500">{{ $user->email }} • {{ ucfirst($user->role) }}</div>
    </div>

    <div class="flex items-center gap-2">
      @if($user->role === \App\Models\User::ROLE_ADMIN)
        <button wire:click="sendPasswordReset" class="px-3 py-2 border rounded">Send reset</button>
      @endif

      @if($user->role === \App\Models\User::ROLE_TRAINER && ! $user->approved)
        <button wire:click="approveTrainer" class="px-3 py-2 bg-emerald-600 text-white rounded">Approve</button>
        <button wire:click="rejectTrainer" class="px-3 py-2 bg-yellow-500 text-white rounded">Reject</button>
      @endif

      <button wire:click="exportJson" class="px-3 py-2 border rounded">Export JSON</button>
      <button wire:click="printProfile" class="px-3 py-2 border rounded">Print</button>
      <button wire:click="confirmDelete" class="px-3 py-2 bg-red-600 text-white rounded">Delete</button>
    </div>
  </div>

  {{-- editable form / printable area --}}
  <div id="printable" class="bg-white rounded shadow p-4">
    <div class="grid grid-cols-3 gap-6">
      <div class="col-span-1">
        <div class="w-full h-44 bg-gray-100 rounded flex items-center justify-center text-3xl font-bold">
          {{ strtoupper(substr($user->name,0,1)) }}
        </div>
        <div class="mt-3 text-sm text-gray-600">
          <div><strong>Joined:</strong> {{ $user->created_at->toDayDateTimeString() }}</div>
          <div><strong>Last active:</strong> {{ $user->last_active_at ?? '—' }}</div>
          <div><strong>ID:</strong> {{ $user->id }}</div>
        </div>
      </div>

      <div class="col-span-2">
        <form wire:submit.prevent="save" class="space-y-3">
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="text-sm font-medium">Full name</label>
              <input wire:model.defer="name" type="text" class="w-full px-3 py-2 border rounded" />
              @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
              <label class="text-sm font-medium">Email</label>
              <input wire:model.defer="email" type="email" class="w-full px-3 py-2 border rounded" />
              @error('email') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="text-sm font-medium">Phone</label>
              <input wire:model.defer="phone" class="w-full px-3 py-2 border rounded" />
            </div>

            <div>
              <label class="text-sm font-medium">Location</label>
              <input wire:model.defer="location" class="w-full px-3 py-2 border rounded" />
            </div>
          </div>

          <div>
            <label class="text-sm font-medium">Bio</label>
            <textarea wire:model.defer="bio" class="w-full px-3 py-2 border rounded" rows="3"></textarea>
          </div>

          <div>
            <label class="text-sm font-medium">Badges (comma separated)</label>
            <input wire:model.defer="badges" class="w-full px-3 py-2 border rounded" />
          </div>

          <div>
            <label class="text-sm font-medium">Other info (JSON/string)</label>
            <textarea wire:model.defer="additional_info" class="w-full px-3 py-2 border rounded" rows="2"></textarea>
          </div>

          <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded" wire:loading.attr="disabled">Save</button>
            <button type="button" wire:click="loadUser" class="px-4 py-2 border rounded">Revert</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- confirm delete modal (livewire-only) --}}
  @if($confirmDeleteId)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
      <div class="bg-white p-6 rounded shadow">
        <h3 class="font-semibold mb-2">Confirm delete</h3>
        <p class="text-sm text-gray-600 mb-4">This will permanently remove the account.</p>
        <div class="flex gap-2">
          <button wire:click="destroyConfirmed" class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
          <button wire:click="$set('confirmDeleteId', null)" class="px-4 py-2 border rounded">Cancel</button>
        </div>
      </div>
    </div>
  @endif
</div>

@push('scripts')
<script>
  // download JSON emitted by Livewire
  window.addEventListener('download-user-json', e => {
    const filename = e.detail.filename || 'user.json';
    const data = e.detail.data || '{}';
    const blob = new Blob([data], {type: 'application/json'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url; a.download = filename; document.body.appendChild(a); a.click();
    setTimeout(()=>{ URL.revokeObjectURL(url); a.remove(); }, 500);
  });

  // print: open printable area in new window and print
  window.addEventListener('print-user', () => {
    const el = document.getElementById('printable');
    if (!el) return window.print();
    const html = `
      <html><head>
        <title>Print user</title>
        <link href="${location.origin}/css/app.css" rel="stylesheet">
        <style>
          body{font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;}
          .print-area{padding:24px;}
        </style>
      </head><body>
      <div class="print-area">${el.innerHTML}</div>
      <script>window.onload=function(){window.print(); setTimeout(()=>window.close(),750);}</script>
      </body></html>
    `;
    const w = window.open('', '_blank', 'width=900,height=700');
    w.document.open();
    w.document.write(html);
    w.document.close();
  });
</script>
@endpush
