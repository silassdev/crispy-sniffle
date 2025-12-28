@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">My Courses</h1>
        <p class="text-slate-500">Continue learning where you left off.</p>
    </div>

    @if($courses->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-dynamic-component :component="'icons.courses'" class="w-8 h-8 text-slate-400" />
            </div>
            <h3 class="text-lg font-medium text-slate-900">You are not enrolled in any courses</h3>
            <p class="text-slate-500 max-w-sm mx-auto mt-2">
                Browse our catalog and start learning today!
            </p>
            <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 mt-6 px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition-colors">
                Browse Catalog
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col group hover:shadow-md transition-shadow">
                    <div class="relative h-40 bg-slate-100">
                        @if($course->hasMedia('illustration'))
                            <img src="{{ $course->getFirstMediaUrl('illustration', 'thumb') }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-sky-50 text-sky-200">
                                <x-dynamic-component :component="'icons.courses'" class="w-16 h-16" />
                            </div>
                        @endif
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="mb-auto">
                            <h3 class="font-semibold text-lg text-slate-900 group-hover:text-sky-600 transition-colors line-clamp-2">
                                <a href="{{ route('courses.show', $course->slug) }}">
                                    {{ $course->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-slate-500 mt-2 line-clamp-2">
                                {{ $course->excerpt }}
                            </p>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                             {{-- Placeholder for progress if available in pivot --}}
                            <span class="text-xs font-medium px-2 py-1 bg-emerald-50 text-emerald-700 rounded-full">
                                Enrolled since {{ $course->pivot->created_at->format('M Y') }}
                            </span>
                            
                            <a href="{{ route('courses.show', $course->slug) }}" class="text-sm font-medium text-sky-600 hover:text-sky-700">
                                Continue &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
