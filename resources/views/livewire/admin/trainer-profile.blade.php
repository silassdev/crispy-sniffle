<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
  <div class="flex items-start gap-6">
    <div class="flex-1">
      <h2 class="text-xl font-semibold mb-2">Trainer profile: {{ $name }}</h2>

      <form wire:submit.prevent="save" class="space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm">Name</label>
            <input wire:model.defer="name" class="mt-1 block w-full border rounded px-3 py-2" />
            @error('name') <div class="text-xs text-red-500">{{ $message }}</div> @enderror
          </div>

          <div>
            <label class="block text-sm">Email</label>
            <input wire:model.defer="email" class="mt-1 block w-full border rounded px-3 py-2" />
            @error('email') <div class="text-xs text-red-500">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm">Phone</label>
            <input wire:model.defer="phone" class="mt-1 block w-full border rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm">Skills (comma separated)</label>
            <input wire:model.defer="skills" class="mt-1 block w-full border rounded px-3 py-2" />
          </div>
        </div>

        <div>
          <label class="block text-sm">Bio</label>
          <textarea wire:model.defer="bio" rows="5" class="mt-1 block w-full border rounded px-3 py-2"></textarea>
        </div>

        <div>
          <label class="block text-sm">Avatar</label>
          <div class="flex items-center gap-3 mt-1">
            @if($trainer->avatar)
              <img src="{{ asset('storage/' . $trainer->avatar) }}" alt="avatar" class="w-24 h-24 object-cover rounded">
            @else
              <div class="w-24 h-24 bg-gray-100 rounded flex items-center justify-center text-xl">{{ strtoupper(substr($trainer->name,0,1)) }}</div>
            @endif
            <div>
              <input type="file" wire:model="avatar" />
              @error('avatar') <div class="text-xs text-red-500">{{ $message }}</div> @enderror
              <div wire:loading wire:target="avatar" class="text-xs text-gray-500">Uploading...</div>
            </div>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
          <button type="button" onclick="window.print()" class="px-4 py-2 border rounded">Print / Download</button>
        </div>
      </form>
    </div>

    <aside class="w-64">
      <div class="bg-gray-50 p-4 rounded">
        <div class="text-xs text-gray-500">Joined</div>
        <div class="font-medium mb-3">{{ $joined_at }}</div>

        <div class="text-xs text-gray-500">Total courses</div>
        <div class="font-medium mb-3">{{ $total_courses }}</div>

        <div class="text-xs text-gray-500">Achievements</div>
        @if($achievements && count($achievements))
          <ul class="text-sm list-disc list-inside">
            @foreach($achievements as $a)
              <li>{{ $a }}</li>
            @endforeach
          </ul>
        @else
          <div class="text-sm text-gray-500">None</div>
        @endif
      </div>
    </aside>
  </div>

  {{-- Print styles (paper friendly) --}}
  <style>
    @media print {
      body * { visibility: hidden; }
      .printable, .printable * { visibility: visible; }
      .printable { position: absolute; left: 0; top: 0; width: 100%; }
    }
  </style>

  {{-- Wrap printable area --}}
  <div class="hidden printable">
    {{-- duplicate key info for printable area if needed --}}
  </div>
</div>
