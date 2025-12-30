<div>
  {{-- Hidden until event fires; use JS to open modal on 'open-manual-grader' browser event --}}
  <div x-data="{ open:false }" x-init="
      window.addEventListener('open-manual-grader', () => { open = true })
      window.addEventListener('close-manual-grader', () => { open = false })
    " x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="bg-white w-full max-w-3xl p-4 rounded z-10">
      <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold">Manual Grader — Attempt #{{ $attempt->id ?? '' }}</h3>
        <button @click="open=false" class="text-gray-500">✕</button>
      </div>

      <div class="space-y-3 max-h-[60vh] overflow-auto">
        @forelse($attempt->answers->where('score', null) as $ans)
          <div class="border rounded p-3 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div class="flex-1">
              <div class="font-medium">{!! nl2br(e($ans->question->question_text)) !!}</div>
              <div class="text-sm text-gray-600 mt-2">Student answer: <div class="mt-1 whitespace-pre-wrap">{{ json_decode($ans->answer) }}</div></div>
            </div>
            <div class="w-48">
              <label class="block text-xs text-gray-500">Assign score</label>
              <input type="number" min="0" max="{{ $ans->question->points ?? 10 }}" class="w-full border rounded px-2 py-1"
                     wire:model.defer="ungraded.{{ $ans->id }}.score" />
            </div>
          </div>
        @empty
          <div class="p-4 text-center text-gray-500">No ungraded answers</div>
        @endforelse
      </div>

      <div class="flex justify-end gap-2 mt-4">
        <button @click="open=false" class="px-3 py-2 border rounded">Close</button>
        <button wire:click="save" class="px-3 py-2 bg-indigo-600 text-white rounded">Save Grades</button>
      </div>
    </div>
  </div>
</div>
