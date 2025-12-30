@extends('layouts.app')

@section('page-title', 'Quiz Result')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
  <div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-start">
      <div>
        <h1 class="text-xl font-semibold">{{ $attempt->quiz->title }}</h1>
        <div class="text-sm text-gray-500">Course: {{ $attempt->quiz->chapter->course->title ?? '—' }}</div>
        <div class="text-sm text-gray-500">Attempted by: {{ $attempt->user->name }} ({{ $attempt->user->email }})</div>
      </div>

      <div class="text-right">
        <div class="text-sm text-gray-500">Score</div>
        <div class="text-2xl font-bold">{{ $score }}/{{ $max }}</div>
        @if(!is_null($percentage)
        )
          <div class="text-sm text-gray-600">{{ $percentage }}%</div>
        @endif
        <div class="mt-2">
          <span class="inline-block px-2 py-1 rounded text-xs {{ $attempt->passed ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {{ is_null($attempt->passed) ? 'Pending' : ($attempt->passed ? 'Passed' : 'Failed') }}
          </span>
        </div>
      </div>
    </div>
  </div>

  {{-- Questions list --}}
  <div class="bg-white p-6 rounded shadow space-y-4">
    @foreach($attempt->answers as $ans)
      @php
        $q = $ans->question;
        $userAnswer = json_decode($ans->answer, true);
      @endphp

      <div class="border rounded p-4">
        <div class="font-medium">Q{{ $loop->iteration }} — {!! nl2br(e($q->question_text)) !!}</div>

        <div class="mt-3 space-y-2">
          {{-- options / display --}}
          @if(in_array($q->type, ['mcq_single','mcq_multi','true_false']))
            <ul class="space-y-1">
              @foreach($q->options as $opt)
                @php
                  $isSelected = false;
                  if ($q->type === 'mcq_multi' && is_array($userAnswer)) {
                     $isSelected = in_array($opt->id, $userAnswer);
                  } else {
                     $isSelected = (int)$userAnswer === (int)$opt->id;
                  }
                @endphp

                <li class="flex items-start gap-2">
                  <div class="w-3 mt-1">
                    @if($opt->is_correct)
                      <svg class="w-4 h-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 13l4 4L19 7" stroke-width="2" stroke-linecap="round"/></svg>
                    @else
                      <div class="w-4 h-4"></div>
                    @endif
                  </div>

                  <div class="{{ $isSelected ? 'font-semibold' : '' }}">
                    {{ $opt->text }}
                    @if($isSelected) <span class="text-xs text-gray-500"> — selected</span> @endif
                    @if($opt->is_correct) <span class="text-xs text-green-600"> — correct</span> @endif
                  </div>
                </li>
              @endforeach
            </ul>
          @else
            <div class="text-sm text-gray-700">
              <strong>Answer:</strong>
              <div class="mt-1 whitespace-pre-wrap">{{ is_string($userAnswer) ? $userAnswer : json_encode($userAnswer) }}</div>
            </div>
          @endif
        </div>

        <div class="mt-3 flex items-center justify-between text-sm">
          <div>
            <span>Score:</span>
            @if(is_null($ans->score))
              <span class="text-orange-600">Pending manual grading</span>
            @else
              <span class="font-medium">{{ $ans->score }} pts</span>
            @endif
          </div>

          {{-- If current viewer can grade, show quick link to grader --}}
          @if($isTrainer || $isAdmin)
            <div>
              <button class="px-3 py-1 border rounded text-sm" onclick="Livewire.emit('openManualGrader', {{ $attempt->id }})">Manual Grade</button>
            </div>
          @endif
        </div>
      </div>
    @endforeach
  </div>

  {{-- include the manual grader Livewire component (it will open only for trainers/admins) --}}
  @if($isTrainer || $isAdmin)
    <livewire:trainer.manual-grader :attemptId="$attempt->id" />
  @endif
</div>
@endsection
