@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Create New Course</h1>
            <p class="text-slate-500">Share your knowledge with the world.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="{{ route('trainer.courses.store') }}" method="POST">
                @csrf
                
                {{-- Title --}}
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-2">Course Title</label>
                    <input type="text" name="title" id="title" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" placeholder="e.g. Introduction to Web Development" required>
                    @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Slug --}}
                <div class="mb-6">
                    <label for="slug" class="block text-sm font-medium text-slate-700 mb-2">Slug (Optional)</label>
                    <input type="text" name="slug" id="slug" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" placeholder="introduction-to-web-development">
                    <p class="mt-1 text-xs text-slate-500">Leave blank to auto-generate from title.</p>
                    @error('slug') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Short Description --}}
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Short Description</label>
                    <textarea name="description" id="description" rows="2" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" placeholder="Brief summary for course cards..."></textarea>
                    @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Full Body (Markdown) --}}
                <div class="mb-6">
                    <label for="body" class="block text-sm font-medium text-slate-700 mb-2">Detailed Content (Markdown Supported)</label>
                    <textarea name="body" id="body" rows="8" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 font-mono text-sm" placeholder="# Course Overview\n\nWrite your detailed course description here..."></textarea>
                    @error('body') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    {{-- Zoom URL --}}
                    <div>
                        <label for="zoom_url" class="block text-sm font-medium text-slate-700 mb-2">Zoom Meeting URL</label>
                        <input type="url" name="zoom_url" id="zoom_url" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" placeholder="https://zoom.us/j/...">
                        @error('zoom_url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- YouTube URL --}}
                    <div>
                        <label for="youtube_url" class="block text-sm font-medium text-slate-700 mb-2">YouTube Preview URL</label>
                        <input type="url" name="youtube_url" id="youtube_url" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" placeholder="https://youtube.com/watch?v=...">
                        @error('youtube_url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Tags --}}
                <div class="mb-6">
                    <label for="tags" class="block text-sm font-medium text-slate-700 mb-2">Tags</label>
                    <input type="text" name="tags" id="tags" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" placeholder="web development, php, laravel">
                    <p class="mt-1 text-xs text-slate-500">Comma separated keywords.</p>
                    @error('tags') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Visibility --}}
                <div class="mb-6">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_public" value="1" class="rounded border-slate-300 text-sky-600 shadow-sm focus:ring-sky-500">
                        <span class="text-sm font-medium text-slate-700">Make this course public immediately</span>
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('trainer.courses.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 rounded-md transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition-colors font-medium">
                        Create Course
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
