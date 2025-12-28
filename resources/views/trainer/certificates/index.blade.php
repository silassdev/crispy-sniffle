@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Certificates</h1>
            <p class="text-slate-500">View and issue certificates to your students.</p>
        </div>
        {{-- If we want an explicit create action: 
        <a href="{{ route('trainer.certificates.create') }}" class="...">Issue Certificate</a> 
        --}}
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
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-700 font-medium uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">Certificate ID</th>
                            <th class="px-6 py-4">Student</th>
                            <th class="px-6 py-4">Course</th>
                            <th class="px-6 py-4">Status</th> 
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($certs as $cert)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-mono text-slate-500">
                                    {{ $cert->certificate_number ?? 'Pending' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $cert->student->name ?? 'Unknown' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $cert->course->title ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                     <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                        {{ match($cert->status) {
                                            'approved' => 'bg-emerald-100 text-emerald-700',
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                            default => 'bg-slate-100 text-slate-700'
                                        } }}">
                                        {{ ucfirst($cert->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-3">
                                    @if($cert->status === 'approved')
                                        <a href="{{ route('trainer.certificates.show', $cert->id) }}" class="text-sky-600 hover:text-sky-700 font-medium">
                                            View
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">
                {{ $certs->links() }}
            </div>
        </div>
    @endif
@endsection