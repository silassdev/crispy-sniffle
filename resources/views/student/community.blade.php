@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Community</h1>
        <p class="text-slate-500">Connect with other learners and instructors.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <x-dynamic-component :component="'icons.community'" class="w-8 h-8 text-slate-400" />
        </div>
        <h3 class="text-lg font-medium text-slate-900">Community Feature Coming Soon</h3>
        <p class="text-slate-500 max-w-sm mx-auto mt-2">
            Forums, discussions, and group collaboration tools will be available here.
        </p>
    </div>
@endsection
