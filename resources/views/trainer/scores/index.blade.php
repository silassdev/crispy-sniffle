@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Student Scores</h1>
        <p class="text-slate-500">Overview of student performance across your courses.</p>
    </div>

    @if($courses->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-dynamic-component :component="'icons.scores'" class="w-8 h-8 text-slate-400" />
            </div>
            <h3 class="text-lg font-medium text-slate-900">No courses available</h3>
            <p class="text-slate-500 max-w-sm mx-auto mt-2">
                You need to create courses and assign work before viewing scores.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($courses as $course)
                @php $stat = $stats[$course->id] ?? null; @endphp
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-semibold text-lg text-slate-900 mb-1">{{ $course->title }}</h3>
                    <p class="text-sm text-slate-500 mb-4">{{ $course->students()->count() }} Students Enrolled</p>
                    
                    <div class="flex items-center gap-6 mt-4">
                        <div class="flex-1">
                            <div class="text-3xl font-bold text-slate-800">
                                {{ $stat && $stat['avg_score'] ? number_format($stat['avg_score'], 1) : '-' }}
                            </div>
                            <div class="text-xs font-medium text-slate-500 uppercase tracking-wide mt-1">Avg Score</div>
                        </div>
                        <div class="h-10 w-px bg-slate-100"></div>
                        <div class="flex-1">
                            <div class="text-3xl font-bold text-slate-800">
                                {{ $stat['submission_count'] ?? 0 }}
                            </div>
                            <div class="text-xs font-medium text-slate-500 uppercase tracking-wide mt-1">Submissions</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection