@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Certificate Request</h2>
            <p class="text-slate-500">Issue certificates to your students.</p>
        </div>
    
    </div>

    @if($certs->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-dynamic-component :component="'icons.certificate'" class="w-8 h-8 text-slate-400" />
            </div>
            <h3 class="text-lg font-medium text-slate-900">No certificates yet</h3>
            <p class="text-slate-500 max-w-sm mx-auto mt-2">
                Certificates you request or issue will be listed here.
            </p>
        </div>
    @else
        
    @endif
@endsection