<div class="mt-6 bg-white rounded shadow p-4">
  <div class="flex items-center justify-between mb-2">
    <h4 class="font-semibold">{{ $editingId ? 'Edit Assessment' : 'New Assessment' }}</h4>
  </div>

  <div class="grid grid-cols-1 gap-3">
    <div class="grid grid-cols-3 gap-2">
      <input wire:model.defer="title" placeholder="Title" class="col-span-2 border rounded px-2 py-1" />
      <select wire:model.defer="type" class="border rounded px-2 py-1">
        <option value="quiz">Quiz</option>
        <option value="assignment">Assignment</option>
        <option value="project">Project</option>
      </select>
    </div>

    <textarea wire:model.defer="description" rows="3" placeholder="Description" class="border rounded px-2 py-1"></textarea>

    <div class="grid grid-cols-3 gap-2">
      <input wire:model.defer="total_score" type="number" min="1" placeholder="Total score" class="border rounded px-2 py-1" />
      <input wire:model.defer="due_at" type="datetime-local" class="border rounded px-2 py-1" />
      <label class="flex items-center gap-2"><input type="checkbox" wire:model.defer="is_published" /> Published</label>
    </div>

    <div class="flex gap-2 justify-end">
      <button wire:click="saveAssessment" class="px-3 py-1 bg-indigo-600 text-white rounded">Save assessment</button>
      <button wire:click="resetForm" class="px-3 py-1 border rounded">Clear</button>
    </div>

    {{-- question builder (only for quiz/assignment where relevant) --}}
    @if($editingId && $type === 'quiz')
      <div class="mt-4 border-t pt-4">
        <h5 class="font-semibold mb-2">Add MCQ Question</h5>
        <textarea wire:model.defer="q_text" rows="3" placeholder="Question text" class="border rounded px-2 py-1"></textarea>
        <div class="grid grid-cols-2 gap-2 mt-2">
          <input wire:model.defer="q_options.A" placeholder="Option A" class="border rounded px-2 py-1" />
          <input wire:model.defer="q_options.B" placeholder="Option B" class="border rounded px-2 py-1" />
          <input wire:model.defer="q_options.C" placeholder="Option C" class="border rounded px-2 py-1" />
          <input wire:model.defer="q_options.D" placeholder="Option D" class="border rounded px-2 py-1" />
        </div>

        <div class="flex items-center gap-2 mt-2">
          <label class="text-sm">Correct</label>
          <select wire:model.defer="q_correct" class="border rounded px-2 py-1">
            <option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option>
          </select>
          <input wire:model.defer="q_score" type="number" min="1" class="border rounded px-2 py-1 w-24" />
        </div>

        <div class="mt-3">
          <button wire:click="addQuestion" class="px-3 py-1 bg-emerald-600 text-white rounded">Add question</button>
        </div>
      </div>
    @endif

    @if($editingId && $type === 'assignment')
      <div class="mt-4 border-t pt-4">
        <h5 class="font-semibold mb-2">Add Written Question</h5>
        <textarea wire:model.defer="q_text" rows="3" placeholder="Question (students will submit written answer + pdf)" class="border rounded px-2 py-1"></textarea>
        <div class="mt-2">
          <input wire:model.defer="q_score" type="number" min="1" class="border rounded px-2 py-1 w-24" />
          <button wire:click="addQuestion" class="px-3 py-1 bg-emerald-600 text-white rounded ml-2">Add question</button>
        </div>
      </div>
    @endif

    {{-- List questions --}}
    @if($questions->count())
      <div class="mt-4 border-t pt-3">
        <h5 class="font-semibold">Questions</h5>
        <ul class="mt-2 space-y-2">
          @foreach($questions as $q)
            <li class="border rounded p-2">
              <div class="flex justify-between items-start">
                <div>
                  <div class="font-medium">{{ $q->question_text }}</div>
                  <div class="text-xs text-gray-500">Type: {{ $q->type }} • Score: {{ $q->score }}</div>
                  @if($q->type === 'mcq')
                    <div class="mt-2 text-sm">
                      @foreach($q->options as $k => $v)
                        <div><strong>{{ $k }}.</strong> {{ $v }} @if($q->correct_option === $k) <span class="text-emerald-600"> (correct)</span>@endif</div>
                      @endforeach
                    </div>
                  @endif
                </div>
                <div>
                  <button wire:click="deleteQuestion({{ $q->id }})" class="text-xs text-red-600">Delete</button>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    @endif

  </div>
</div>
