@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Assignments</h1>
            <p class="text-slate-500">Manage assessments, quizzes, and projects.</p>
        </div>
        <a href="{{ route('trainer.assignment.create') }}" class="px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition-colors flex items-center gap-2">
            <x-dynamic-component :component="'icons.plus'" class="w-4 h-4" />
            <span>Create Assignment</span>
        </a>
    </div>

    @if($assignments->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-dynamic-component :component="'icons.assignment'" class="w-8 h-8 text-slate-400" />
            </div>
            <h3 class="text-lg font-medium text-slate-900">No assignments created</h3>
            <p class="text-slate-500 max-w-sm mx-auto mt-2">
                Create your first assignment to start evaluating students.
            </p>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-700 font-medium uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">Title</th>
                            <th class="px-6 py-4">Course</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Due Date</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($assignments as $assignment)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-900">
                                    {{ $assignment->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $assignment->course->title }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700 capitalize">
                                        {{ $assignment->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $assignment->due_at ? \Carbon\Carbon::parse($assignment->due_at)->format('M d, Y') : 'No Due Date' }}
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-3">
                                    <a href="{{ route('trainer.assignment.show', $assignment->id) }}" class="text-sky-600 hover:text-sky-700 font-medium">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">
                {{ $assignments->links() }}
            </div>
        </div>
    @endif
@endsection
