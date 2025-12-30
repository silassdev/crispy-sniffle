<div class="space-y-6">

    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold">Quizzes — {{ $course->title }}</h2>

        <a href="{{ route('trainer.quiz.builder', $course) }}"
           class="btn btn-primary">
            + Create Quiz
        </a>
    </div>

    {{-- Loader --}}
    <div wire:loading class="flex justify-center py-10">
        @include('components.donut-loader')
    </div>

    {{-- Content --}}
    <div wire:loading.remove class="space-y-4">

        @foreach ($course->chapters as $chapter)
            <div class="border rounded p-4">
                <h3 class="font-medium">{{ $chapter->title }}</h3>

                @if ($chapter->quizzes->isEmpty())
                    <p class="text-sm text-gray-500 mt-2">No quizzes</p>
                @else
                    <ul class="mt-2 space-y-1">
                        @foreach ($chapter->quizzes as $quiz)
                            <li class="flex justify-between items-center">
                                <span>{{ $quiz->title }}</span>

                                <span class="text-xs {{ $quiz->published ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $quiz->published ? 'Published' : 'Draft' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach

    </div>
</div>
