<div class="max-w-3xl space-y-6">

    <h2 class="text-xl font-semibold">Create Quiz</h2>

    <div wire:loading class="py-10 flex justify-center">
        @include('components.donut-loader')
    </div>

    {{-- Form --}}
    <form wire:submit.prevent="save" wire:loading.remove class="space-y-4">

        <div>
            <label class="block text-sm">Chapter</label>
            <select wire:model="chapter_id" class="input">
                @foreach ($chapters as $chapter)
                    <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                @endforeach
            </select>
            @error('chapter_id') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm">Quiz Title</label>
            <input wire:model="title" class="input" />
            @error('title') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm">Duration (minutes)</label>
            <input type="number" wire:model="duration_minutes" class="input" />
        </div>

        <button class="btn btn-primary">
            Save Quiz
        </button>

        @if (session('success'))
            <p class="text-green-600">{{ session('success') }}</p>
        @endif
    </form>

    {{-- Placeholder for Question Builder --}}
    @if ($quiz)
        <div class="border-t pt-6">
            <p class="text-sm text-gray-500">
                Question builder loads here (step 2).
            </p>
        </div>
    @endif

</div>
