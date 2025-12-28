@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Students</h1>
        <p class="text-slate-500">List of students enrolled in your courses.</p>
    </div>

    @if($students->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-dynamic-component :component="'icons.students'" class="w-8 h-8 text-slate-400" />
            </div>
            <h3 class="text-lg font-medium text-slate-900">No students found</h3>
            <p class="text-slate-500 max-w-sm mx-auto mt-2">
                Students will appear here once they enroll in your courses.
            </p>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-700 font-medium uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Enrolled On</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($students as $student)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-900">
                                    {{ $student->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $student->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($student->enrolled_at)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-3">
                                    <a href="{{ route('trainer.students.show', $student->id) }}" class="text-sky-600 hover:text-sky-700 font-medium">
                                        View Profile
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">
                {{ $students->links() }}
            </div>
        </div>
    @endif
@endsection