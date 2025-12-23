<div class="space-y-4">

  @if(! auth()->check())
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 text-sm">
      <strong>Login required</strong> — you must login as a student to submit this assessment.
    </div>
    @php return; @endphp
  @endif

  @if($blocked)
    <div class="bg-red-50 border-l-4 border-red-400 p-4 text-sm">
      This assessment is not available at the moment.
    </div>
    @php return; @endphp
  @endif

  <div class="bg-white rounded shadow p-4">
    <div class="flex items-start justify-between gap-4">
      <div>
        <h3 class="text-lg font-semibold">{{ $this->assessment->title }}</h3>
        <div class="text-xs text-gray-500">Type: {{ ucfirst($this->assessment->type) }} • Due: {{ optional($this->assessment->due_at)->toDayDateTimeString() ?? 'No due date' }}</div>
        <div class="mt-2 text-sm text-gray-700">{!! nl2br(e($this->assessment->description)) !!}</div>
      </div>

      <div class="text-right">
        @if($existingSubmission)
          <div class="text-sm text-green-600 font-semibold">Submitted</div>
          <div class="text-xs text-gray-500">Status: {{ ucfirst($existingSubmission->status) }}</div>
          @if($existingSubmission->score !== null)
            <div class="mt-1 text-sm">Score: <strong>{{ $existingSubmission->score }}</strong></div>
          @endif
        @else
          <div class="text-sm text-gray-500">Not submitted</div>
        @endif
      </div>
    </div>

    <div class="mt-4">
      @if($this->assessment->type === 'quiz')
        <form wire:submit.prevent="submitQuiz">
          <div class="space-y-4">
            @foreach($questions as $q)
              <div class="p-3 border rounded">
                <div class="font-medium">{{ $q->question_text }}</div>
                <div class="text-xs text-gray-500 mb-2">Score: {{ $q->score }}</div>
                @if($q->options && is_array($q->options))
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2">
                    @foreach($q->options as $key => $opt)
                      <label class="flex items-center gap-2 p-2 border rounded cursor-pointer">
                        <input type="radio" wire:model.defer="answers.{{ $q->id }}" value="{{ $key }}" class="mr-2" />
                        <div><strong>{{ $key }}.</strong> {!! nl2br(e($opt)) !!}</div>
                      </label>
                    @endforeach
                  </div>
                @endif
              </div>
            @endforeach

            <div class="flex items-center gap-2">
              <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded" @disabled($submitting)>
                @if($submitting)
                  <svg class="animate-spin inline-block w-4 h-4 mr-2" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                  Submitting...
                @else
                  Submit Quiz
                @endif
              </button>
            </div>
          </div>
        </form>
      @elseif($this->assessment->type === 'assignment')
        <form wire:submit.prevent="submitAssignment" enctype="multipart/form-data">
          <div class="space-y-4">
            @foreach($questions as $q)
              <div class="p-3 border rounded">
                <div class="font-medium">{{ $q->question_text }}</div>
                <div class="text-xs text-gray-500 mb-2">Score: {{ $q->score }}</div>
                <textarea wire:model.defer="writtenAnswers.{{ $q->id }}" rows="4" class="w-full border rounded p-2" placeholder="Write your answer here..."></textarea>
              </div>
            @endforeach

            <div>
              <label class="block text-sm font-medium">Attach file (optional, PDF or ZIP up to 10MB)</label>
              <input type="file" wire:model="file" accept=".pdf,.zip" />
              @error('file') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex items-center gap-2">
              <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded" @disabled($submitting)>
                @if($submitting)
                  <svg class="animate-spin inline-block w-4 h-4 mr-2" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                  Submitting...
                @else
                  Submit Assignment
                @endif
              </button>
            </div>
          </div>
        </form>
      @elseif($this->assessment->type === 'project')
        <form wire:submit.prevent="submitProject" enctype="multipart/form-data">
          <div class="space-y-4">
            <div class="p-3 border rounded">
              <div class="font-medium">Upload your project file (PDF or ZIP)</div>
              <div class="text-xs text-gray-500 mb-2">Max 15MB</div>
              <input type="file" wire:model="file" accept=".pdf,.zip" />
              @error('file') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex items-center gap-2">
              <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded" @disabled($submitting)>
                @if($submitting)
                  <svg class="animate-spin inline-block w-4 h-4 mr-2" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                  Uploading...
                @else
                  Upload Project
                @endif
              </button>
            </div>
          </div>
        </form>
      @endif
    </div>
  </div>

  @if($existingSubmission)
    <div class="bg-white rounded shadow p-4">
      <h4 class="font-semibold">Your submission</h4>
      <div class="text-sm text-gray-600">Status: {{ ucfirst($existingSubmission->status) }}</div>
      @if($existingSubmission->answers)
        <div class="mt-2">
          <h5 class="font-medium">Answers</h5>
          <pre class="bg-gray-50 p-2 rounded text-xs">{{ json_encode($existingSubmission->answers, JSON_PRETTY_PRINT) }}</pre>
        </div>
      @endif

      @if($existingSubmission->getMedia('submission_files')->count())
        <div class="mt-3">
          <h5 class="font-medium">Files</h5>
          <ul class="list-disc pl-6 mt-2">
            @foreach($existingSubmission->getMedia('submission_files') as $f)
              <li><a href="{{ $f->getUrl() }}" class="text-indigo-600" target="_blank">{{ $f->file_name }}</a></li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
  @endif

</div>
