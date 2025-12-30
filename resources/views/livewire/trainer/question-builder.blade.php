<div class="grid grid-cols-2 gap-6">
    <div>
        <input wire:model.debounce.300ms="search"
               placeholder="Search question bank..."
               class="input mb-3"/>

        <div class="space-y-2">
            @foreach ($bank as $question)
                <div class="border p-2 flex justify-between">
                    <span>{{ Str::limit($question->question_text, 60) }}</span>

                    <button wire:click="attachQuestion({{ $question->id }})"
                            class="btn-sm btn-primary">
                        Add
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Quiz Questions --}}
    <div>
        <h4 class="font-semibold mb-2">Quiz Questions</h4>

        @forelse ($quiz->questions as $question)
            <div class="border p-2 flex justify-between">
                <span>{{ Str::limit($question->question_text, 60) }}</span>

                <button wire:click="removeQuestion({{ $question->id }})"
                        class="btn-sm btn-danger">
                    Remove
                </button>
            </div>
        @empty
            <p class="text-sm text-gray-500">No questions attached</p>
        @endforelse
    </div>

</div>
