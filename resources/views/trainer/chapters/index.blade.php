@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                    <a href="{{ route('trainer.courses.index') }}" class="hover:text-slate-700">Courses</a>
                    <span>/</span>
                    <a href="{{ route('trainer.courses.show', $course->slug) }}" class="hover:text-slate-700">{{ $course->title }}</a>
                    <span>/</span>
                    <span>Curriculum</span>
                </div>
                <h1 class="text-2xl font-bold text-slate-800">Course Curriculum</h1>
            </div>
            <button onclick="document.getElementById('add-chapter-modal').classList.remove('hidden')" class="px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition-colors flex items-center gap-2">
                <x-dynamic-component :component="'icons.plus'" class="w-4 h-4" />
                <span>Add Chapter</span>
            </button>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-600 p-4 rounded-lg mb-6 text-sm">
                 {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            @if($chapters->isEmpty())
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <x-dynamic-component :component="'icons.course'" class="w-8 h-8 text-slate-400" />
                    </div>
                    <h3 class="text-lg font-medium text-slate-900">No chapters yet</h3>
                    <p class="text-slate-500 max-w-sm mx-auto mt-2">
                        Start building your course structure by adding chapters.
                    </p>
                </div>
            @else
                <ul class="divide-y divide-slate-100">
                    @foreach($chapters as $chapter)
                        <li class="p-4 hover:bg-slate-50 flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-medium text-sm">
                                    {{ $chapter->order }}
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-900">{{ $chapter->title }}</h4>
                                    @if($chapter->description)
                                        <p class="text-xs text-slate-500">{{ Str::limit($chapter->description, 60) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <form action="{{ route('trainer.chapters.destroy', [$course->slug, $chapter->id]) }}" method="POST" onsubmit="return confirm('Delete this chapter?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors">
                                        <x-dynamic-component :component="'icons.trash'" class="w-4 h-4" />
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Simple Add Chapter Modal (Hidden by default) --}}
    <div id="add-chapter-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-lg w-full p-6 max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Add New Chapter</h3>
            <form action="{{ route('trainer.chapters.store', $course->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
                    <input type="text" name="chapters[0][title]" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Description (Optional)</label>
                    <textarea name="chapters[0][description]" rows="3" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">PDF Document (Optional)</label>
                    <input type="file" name="chapters[0][pdf]" accept=".pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                    <p class="mt-1 text-xs text-slate-500">Max 10MB</p>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Video (Optional)</label>
                    <input type="file" name="chapters[0][video]" accept=".mp4,.mpeg,.mov,.avi" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                    <p class="mt-1 text-xs text-slate-500">Max 100MB (mp4, mpeg, mov, avi)</p>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-chapter-modal').classList.add('hidden')" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-md">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700">Add Chapter</button>
                </div>
            </form>
        </div>
    </div>
@endsection
