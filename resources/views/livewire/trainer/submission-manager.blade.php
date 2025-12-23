<div class="space-y-4">
  <div class="flex items-center justify-between">
    <h4 class="font-semibold">Submissions for: {{ $assessment->title }}</h4>
    <div>
      <select wire:model="filter" class="border rounded px-2 py-1">
        <option value="all">All</option>
        <option value="submitted">Submitted</option>
        <option value="graded">Graded</option>
      </select>
    </div>
  </div>

  <div class="bg-white rounded shadow divide-y">
    @forelse($subs as $s)
      <div class="p-3 flex items-start gap-3">
        <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center">
          {{ $s->user ? strtoupper(substr($s->user->name,0,1)) : 'G' }}
        </div>

        <div class="flex-1">
          <div class="flex justify-between">
            <div>
              <div class="font-medium">{{ $s->user?->name ?? ('Guest - '.$s->guest_email) }}</div>
              <div class="text-xs text-gray-500">{{ optional($s->submitted_at)->toDayDateTimeString() }}</div>
            </div>

            <div class="text-right">
              <div class="text-sm">Score: <strong>{{ $s->score ?? '-' }}</strong></div>
              <div class="text-xs text-gray-400">{{ ucfirst($s->status) }}</div>
            </div>
          </div>

          <div class="mt-2 text-sm">
            @if($s->answers)
              <pre class="bg-gray-50 p-2 rounded text-xs">{{ json_encode($s->answers, JSON_PRETTY_PRINT) }}</pre>
            @endif

            @if($s->getMedia('submission_files')->count())
              <div class="mt-2">
                Files:
                @foreach($s->getMedia('submission_files') as $file)
                  <a href="{{ $file->getUrl() }}" target="_blank" class="text-indigo-600 underline text-sm">{{ $file->file_name }}</a>
                @endforeach
              </div>
            @endif

            <div class="mt-2 flex items-center gap-2">
              <input type="number" id="score-{{ $s->id }}" placeholder="score" class="border rounded px-2 py-1 w-24" />
              <button onclick="window.Livewire.emit('markGrade', {{ $s->id }}, document.getElementById('score-{{ $s->id }}').value)" class="px-2 py-1 bg-emerald-600 text-white rounded text-sm">Save</button>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="p-4 text-center text-gray-500">No submissions yet.</div>
    @endforelse
  </div>

  <div class="p-3">{{ $subs->links() }}</div>
</div>

<script>
  // wire up markGrade listener
  Livewire.on('markGrade', (id, score) => {
    Livewire.emit('markGrade', id, score);
  });
</script>
