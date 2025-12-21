<div class="space-y-4">

  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-lg font-semibold">My Courses</h2>
      <div class="text-sm text-gray-500">Create and manage your courses</div>
    </div>

    <div class="flex items-center gap-2">
      <input wire:model.debounce.300ms="search" placeholder="Search title or excerpt" class="border rounded px-3 py-1" />
      <button wire:click="create" class="px-3 py-1 bg-indigo-600 text-white rounded">New Course</button>
    </div>
  </div>

  <div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-2 text-left">Title</th>
          <th class="p-2 text-left">ID</th>
          <th class="p-2">Students</th>
          <th class="p-2">Visibility</th>
          <th class="p-2 text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($courses as $c)
        <tr class="border-t">
          <td class="p-2">{{ $c->title }}</td>
          <td class="p-2">{{ $c->course_id }}</td>
          <td class="p-2">{{ $c->enrollments()->count() }}</td>
          <td class="p-2">
            @if($c->is_public)
              <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded">Public</span>
            @else
              <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded">Auth only</span>
            @endif
          </td>
          <td class="p-2 text-right">
            <a href="{{ route('trainer.courses.show', $c->id) }}" class="px-2 py-1 border rounded text-xs">View</a>
            <button wire:click="edit({{ $c->id }})" class="px-2 py-1 border rounded text-xs">Edit</button>
            <button wire:click="delete({{ $c->id }})" class="px-2 py-1 border rounded text-xs text-red-600">Delete</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="p-3">
      {{ $courses->links() }}
    </div>
  </div>

  {{-- Form modal (simple non-alpine fallback) --}}
  @if($showForm)
    <div class="fixed inset-0 z-50 flex items-start justify-center pt-16">
      <div class="absolute inset-0 bg-black/40" wire:click="resetForm"></div>
      <div class="relative z-10 w-full max-w-3xl bg-white rounded shadow-lg p-6">
        <h3 class="font-semibold mb-4">{{ $courseId ? 'Edit Course' : 'Create Course' }}</h3>

        <div class="grid grid-cols-1 gap-3">
          <input wire:model.defer="title" type="text" placeholder="Course title" class="border rounded px-3 py-2" />
          @error('title') <div class="text-xs text-red-600">{{ $message }}</div> @enderror

          <input wire:model.defer="excerpt" type="text" placeholder="Short excerpt" class="border rounded px-3 py-2" />

          <label class="text-sm">Markdown body (preview below)</label>
          <textarea wire:model.defer="body" rows="8" class="border rounded px-3 py-2"></textarea>

          <label class="text-sm">Tags (comma separated)</label>
          <input wire:model.defer="tags" type="text" placeholder="e.g. laravel,php,frontend" class="border rounded px-3 py-2" />

          <div class="grid grid-cols-2 gap-2">
            <input wire:model.defer="youtube_url" placeholder="YouTube URL (optional)" class="border rounded px-3 py-2" />
            <input wire:model.defer="zoom_url" placeholder="Zoom meeting URL (optional)" class="border rounded px-3 py-2" />
          </div>

          <div>
            <label class="text-sm">Illustration (image)</label>
            <input type="file" wire:model="illustration" accept="image/*" />
            @error('illustration') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
          </div>

          <div>
            <label class="text-sm">Attachments (PDFs)</label>
            <input type="file" wire:model="attachments" multiple accept="application/pdf" />
            @error('attachments.*') <div class="text-xs text-red-600">{{ $message }}</div> @enderror
          </div>

          <label class="text-sm">Visibility</label>
          <select wire:model.defer="is_public" class="border rounded px-3 py-2">
            <option value="1">Public (anyone can view)</option>
            <option value="0">Authenticated only</option>
          </select>

          <div class="flex justify-end gap-2 pt-3">
            <button wire:click="resetForm" class="px-3 py-1 border rounded">Cancel</button>
            <button wire:click="save" class="px-3 py-1 bg-indigo-600 text-white rounded">Save</button>
          </div>
        </div>

        {{-- markdown preview --}}
        <div class="mt-6">
          <h4 class="font-semibold">Preview</h4>
          <div class="prose max-w-none mt-3 border p-3 rounded bg-gray-50">
            {!! \Parsedown::instance()->text($body ?? '') !!}
          </div>
        </div>
      </div>
    </div>
  @endif

</div>
