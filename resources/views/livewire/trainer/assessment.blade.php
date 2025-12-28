
<div>
  <div class="flex items-center justify-between mb-4">
    <h3 class="font-semibold">Assessments</h3>
    <div>
      <button wire:click="$emit('openAssessmentEditor', {course_id: {{ $courseId ?? 'null' }} })" class="px-3 py-1 bg-indigo-600 text-white rounded">New Assessment</button>
    </div>
  </div>

  <div class="bg-white rounded shadow">
    <table class="w-full text-sm">
      <thead class="bg-gray-50">
        <tr><th class="p-2">Title</th><th class="p-2">Type</th><th class="p-2">Course</th><th class="p-2">Due</th><th class="p-2 text-right">Actions</th></tr>
      </thead>
      <tbody>
        @foreach($assessments as $a)
        <tr class="border-t">
          <td class="p-2">{{ $a->title }}</td>
          <td class="p-2">{{ ucfirst($a->type) }}</td>
          <td class="p-2">{{ $a->course->title ?? '-' }}</td>
          <td class="p-2">{{ optional($a->due_at)->toDayDateTimeString() ?? '-' }}</td>
          <td class="p-2 text-right">
            <button wire:click="$emit('openAssessmentEditor', {{ $a->id }})" class="px-2 py-1 border rounded text-xs">Edit</button>
            <a href="{{ route('trainer.assessments.submissions', $a->id) }}" class="px-2 py-1 border rounded text-xs">Submissions</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="p-3">{{ $assessments->links() }}</div>
  </div>

  <livewire:trainer.assessment-editor />
</div>
