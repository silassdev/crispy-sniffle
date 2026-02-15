@extends('dashboards.shell')

@section('dashboard-content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Certificate Details</h1>
        <a href="{{ route('trainer.certificates.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h2 class="text-lg font-medium text-gray-900">Reference: {{ $cert->certificate_number ?? 'PENDING' }}</h2>
            @if($cert->status === 'approved')
                <span class="inline-flex px-3 py-1 text-sm font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Approved</span>
            @elseif($cert->status === 'rejected')
                <span class="inline-flex px-3 py-1 text-sm font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Rejected</span>
            @else
                <span class="inline-flex px-3 py-1 text-sm font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
            @endif
        </div>
        
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Student</label>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg uppercase">
                            {{ substr($cert->student->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-900">{{ $cert->student->name ?? 'Unknown' }}</div>
                            <div class="text-sm text-gray-500">{{ $cert->student->email ?? '' }}</div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Course Information</label>
                    <div class="bg-gray-50 rounded-lg p-3 border border-gray-100">
                        <div class="text-base font-medium text-gray-900">{{ $cert->course->title ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-500 capitalize mt-1">Type: {{ str_replace('_', ' ', $cert->type) }}</div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Request Notes</label>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 text-gray-700 whitespace-pre-line">
                    {{ $cert->notes ?: 'No notes provided.' }}
                </div>
                <div class="text-right mt-2 text-xs text-gray-400">
                    Requested on {{ $cert->created_at->format('M d, Y h:i A') }}
                </div>
            </div>

            @if($cert->status === 'rejected' && $cert->admin_note)
                <div class="border-t border-gray-100 pt-6">
                    <label class="block text-sm font-medium text-red-500 uppercase tracking-wider mb-2">Rejection Reason</label>
                    <div class="bg-red-50 rounded-lg p-4 border border-red-100 text-red-800">
                        {{ $cert->admin_note }}
                    </div>
                    <div class="text-right mt-2 text-xs text-gray-400">
                        Rejected by Admin
                    </div>
                </div>
            @endif

            @if($cert->status === 'approved')
                <div class="border-t border-gray-100 pt-6 flex items-center justify-between bg-green-50 rounded-lg p-4 border border-green-100">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 text-2xl mr-3"></i>
                        <div>
                            <div class="font-medium text-green-900">Certificate Issued</div>
                            <div class="text-sm text-green-700">Issued on {{ $cert->issued_at ? $cert->issued_at->format('M d, Y') : 'N/A' }}</div>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('certificates.pdf.download', $cert->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-download mr-2"></i> Download PDF
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
