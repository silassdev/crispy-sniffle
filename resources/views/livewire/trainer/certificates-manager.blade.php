<div class="space-y-3">
  <div class="flex items-center justify-between">
    <h4 class="text-lg font-semibold">Certificates</h4>
    <a href="{{ route('trainer.certificates.create') }}" class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">Request certificate</a>
  </div>

  <div class="flex gap-2">
    <input wire:model.debounce.300ms="q" placeholder="search student" class="border rounded px-2 py-1" />
    <select wire:model="status" class="border rounded px-2 py-1 text-sm">
      <option value="all">All</option>
      <option value="pending">Pending</option>
      <option value="approved">Approved</option>
      <option value="rejected">Rejected</option>
    </select>
    <select wire:model="type" class="border rounded px-2 py-1 text-sm">
      <option value="all">All types</option>
      <option value="course_completion">Course completion</option>
      <option value="graduation">Graduation</option>
      <!-- add others -->
    </select>
  </div>

  <div class="bg-white rounded shadow">
    <table class="w-full text-sm">
      <thead class="bg-gray-50">
        <tr><th class="p-2">Student</th><th class="p-2">Type</th><th class="p-2">Course</th><th class="p-2">Status</th><th class="p-2 text-right">Actions</th></tr>
      </thead>
      <tbody>
        @foreach($certs as $c)
        <tr class="border-t">
          <td class="p-2">{{ $c->student->name }} <div class="text-xs text-gray-500">{{ $c->student->email }}</div></td>
          <td class="p-2">{{ $c->type }}</td>
          <td class="p-2">{{ optional($c->course)->title ?? '-' }}</td>
          <td class="p-2">
            <span class="text-xs px-2 py-1 rounded {{ $c->status==='approved'?'bg-emerald-100 text-emerald-700' : ($c->status==='rejected'?'bg-red-100 text-red-700':'bg-yellow-100 text-yellow-700') }}">{{ ucfirst($c->status) }}</span>
          </td>
          <td class="p-2 text-right">
            <a href="{{ route('trainer.certificates.show', $c->id) }}" class="text-xs px-2 py-1 border rounded">View</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="p-3">{{ $certs->links() }}</div>
  </div>
</div>
