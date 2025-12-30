<div class="max-w-3xl mx-auto space-y-6">

  <h2 class="text-xl font-semibold">{{ $quiz->title }}</h2>

  {{-- start button --}}
  @unless($attempt)
    <div>
      <button wire:click="start" class="px-4 py-2 bg-indigo-600 text-white rounded">Start Attempt</button>
    </div>
  @endunless

  {{-- questions area --}}
  @if($attempt)
    <div class="space-y-6">
      <div class="text-sm text-gray-500">Attempt started at: {{ $attempt->started_at ? $attempt->started_at->toDayDateTimeString() : '' }}</div>

      {{-- Questions --}}
      @foreach($quiz->questions as $question)
        <div class="border rounded p-4">
          <div class="font-medium">Q{{ $loop->iteration }}. {!! nl2br(e($question->question_text)) !!}</div>
          <div class="mt-3 space-y-2">
            @if($question->type === 'mcq_single')
              @foreach($question->options as $opt)
                <label class="flex items-center gap-2">
                  <input type="radio" name="q{{ $question->id }}" wire:click="setAnswer({{ $question->id }}, {{ $opt->id }})" />
                  <span>{{ $opt->text }}</span>
                </label>
              @endforeach

            @elseif($question->type === 'mcq_multi')
              @foreach($question->options as $opt)
                <label class="flex items-center gap-2">
                  <input type="checkbox" wire:click="$toggle('answers.{{$question->id}}', {{ $opt->id }})" />
                  <span>{{ $opt->text }}</span>
                </label>
              @endforeach

            @elseif($question->type === 'true_false')
              @foreach($question->options as $opt)
                <label class="flex items-center gap-2">
                  <input type="radio" name="q{{ $question->id }}" wire:click="setAnswer({{ $question->id }}, {{ $opt->id }})" />
                  <span>{{ $opt->text }}</span>
                </label>
              @endforeach

            @else {{-- short answer --}}
              <textarea wire:model.defer="answers.{{ $question->id }}" rows="3" class="block w-full border rounded p-2"></textarea>
            @endif
          </div>
        </div>
      @endforeach

      <div class="flex gap-3">
        <button
          onclick="if(confirm('Submit attempt?')) Livewire.emit('confirmSubmit')"
          class="px-4 py-2 bg-green-600 text-white rounded"
          @if($submitting) disabled @endif>
          <span wire:loading.remove wire:target="submit">Submit</span>
          <span wire:loading wire:target="submit">@include('components.donut-loader-small')</span>
        </button>

        <a href="{{ route('student.quizzes.index') }}" class="px-4 py-2 border rounded">Cancel</a>
      </div>
    </div>
  @endif
</div>
