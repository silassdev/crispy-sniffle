@extends('dashboards.shell')
@section('content')
<div class="max-w-2xl mx-auto">
  <h1 class="text-xl font-semibold mb-4">Request Certificate</h1>

  <form method="POST" action="{{ route('trainer.certificates.store') }}">
    @csrf
    <div class="space-y-3 bg-white rounded shadow p-4">
      <div>
        <label class="text-sm">Student (email or select)</label>
        <input name="student_email" type="email" placeholder="student email" class="w-full border rounded px-3 py-2" />
        <div class="text-xs text-gray-500 mt-1">If student is registered use email. Registered student will be located automatically.</div>
      </div>

      <div>
        <label class="text-sm">Course (optional)</label>
        <select name="course_id" class="w-full border rounded px-3 py-2">
          <option value="">-- none --</option>
          @foreach($courses as $c)
            <option value="{{ $c->id }}">{{ $c->title }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="text-sm">Certificate type</label>
        <select name="type" required class="w-full border rounded px-3 py-2">
          <option value="course_completion">Course completion</option>
          <option value="graduation">Graduation</option>
        </select>
      </div>

      <div>
        <label class="text-sm">Notes</label>
        <textarea name="notes" class="w-full border rounded px-3 py-2"></textarea>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="px-3 py-2 bg-indigo-600 text-white rounded">Request</button>
      </div>
    </div>
  </form>
</div>
@endsection
