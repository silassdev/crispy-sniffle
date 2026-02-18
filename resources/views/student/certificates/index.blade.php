@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">My Certificates</h1>
        <p class="text-slate-500">View and download your earned certificates.</p>
    </div>

    @if($certs->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-dynamic-component :component="'icons.certificate'" class="w-8 h-8 text-slate-400" />
            </div>
            <h3 class="text-lg font-medium text-slate-900">No certificates yet</h3>
            <p class="text-slate-500 max-w-sm mx-auto mt-2">
                Complete courses to earn certificates. Once you verify your completion, your certificates will appear here.
            </p>
            <a href="{{ route('student.courses.index') }}" class="inline-flex items-center gap-2 mt-6 px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition-colors">
                Browse Courses
            </a>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-700 font-medium uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">Certificate ID</th>
                            <th class="px-6 py-4">Course</th>
                            <th class="px-6 py-4">Issued On</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($certs as $cert)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-mono text-slate-500">
                                    {{ $cert->certificate_number }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-900">{{ $cert->course->title ?? 'Unknown Course' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $cert->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-3">
                                    <a href="{{ route('certificate.public', $cert->certificate_number) }}" target="_blank" class="text-sky-600 hover:underline font-medium">
                                        View
                                    </a>
                                    <span class="text-slate-300">|</span>
                                    <a href="{{ route('certificates.pdf.preview', $cert->id) }}" target="_blank" class="text-slate-500 hover:text-slate-700">
                                        Preview PDF
                                    </a>
                                    <span class="text-slate-300">|</span>
                                    <a href="{{ route('certificates.pdf.download', $cert->id) }}" class="text-slate-500 hover:text-slate-700">
                                        Download PDF
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
