<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800"><i class="fas fa-certificate me-2 text-indigo-600"></i> Certificates Management</h2>
        <a href="{{ route('trainer.certificates.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
            <i class="fas fa-plus me-2"></i> Request Certificate
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b border-gray-100 bg-gray-50">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input wire:model.live.debounce.300ms="q" type="text" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm" placeholder="Search student, number, course...">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <select wire:model.live="status" class="w-full border rounded-lg py-2 px-3 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white">
                        <option value="all">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-medium tracking-wider text-left">
                    <tr>
                        <th class="px-6 py-3">Reference</th>
                        <th class="px-6 py-3">Student</th>
                        <th class="px-6 py-3">Course</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($certs as $cert)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $cert->certificate_number ?? 'PENDING' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs uppercase">
                                        {{ substr($cert->student->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $cert->student->name ?? 'Unknown' }}</div>
                                        <div class="text-xs text-gray-500">{{ $cert->student->email ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $cert->course->title ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($cert->status === 'approved')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Approved</span>
                                @elseif($cert->status === 'rejected')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Rejected</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $cert->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="openModal({{ $cert->id }})" 
                                        class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded hover:bg-indigo-700 transition">
                                    <i class="fas fa-eye mr-1.5"></i> View / Action
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-file-alt text-4xl mb-3 text-gray-300"></i>
                                    <p class="text-lg font-medium text-gray-900">No certificates found</p>
                                    <p class="text-sm text-gray-500">Get started by requesting a certificate for your students.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($certs->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $certs->links() }}
            </div>
        @endif
    </div>

    <!-- Certificate Details Modal -->
    @if($isModalOpen && $selectedCert)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div wire:click="closeModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Center modal -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                                    <i class="fas fa-certificate text-indigo-600 mr-2"></i>
                                    Certificate Details
                                    </h3>

                                <div class="space-y-4">
                                    <!-- Certificate Number -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600 mb-1">Certificate Number</p>
                                        <p class="font-semibold text-gray-900">{{ $selectedCert->certificate_number ?? 'Pending Assignment' }}</p>
                                    </div>

                                    <!-- Student Info -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600 mb-1">Student</p>
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold uppercase">
                                                {{ substr($selectedCert->student->name ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $selectedCert->student->name ?? 'Unknown' }}</p>
                                                <p class="text-sm text-gray-500">{{ $selectedCert->student->email ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Course Info -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600 mb-1">Course</p>
                                        <p class="font-semibold text-gray-900">{{ $selectedCert->course->title ?? '—' }}</p>
                                    </div>

                                    <!-- Notes -->
                                    @if($selectedCert->notes)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="text-sm text-gray-600 mb-1">Notes</p>
                                            <p class="text-gray-700">{{ $selectedCert->notes }}</p>
                                        </div>
                                    @endif

                                    <!-- Status -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600 mb-2">Status</p>
                                        @if(strtolower($selectedCert->status) === 'approved')
                                            <span class="inline-flex px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                                <i class="fas fa-check-circle mr-1.5"></i> Approved
                                            </span>
                                            @if($selectedCert->issued_at)
                                                <p class="text-xs text-gray-500 mt-2">Issued: {{ $selectedCert->issued_at->format('M d, Y') }}</p>
                                            @endif
                                        @elseif(strtolower($selectedCert->status) === 'rejected')
                                            <span class="inline-flex px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">
                                                <i class="fas fa-times-circle mr-1.5"></i> Rejected
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                                <i class="fas fa-clock mr-1.5"></i> Pending Approval
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Footer with Actions -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        @if(strtolower($selectedCert->status) === 'approved')
                            <a href="{{ route('certificates.pdf.download', $selectedCert->id) }}" 
                               class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                <i class="fas fa-download mr-2 mt-1"></i> Download PDF
                            </a>
                        @endif

                        <button type="button" 
                                wire:click="closeModal" 
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
