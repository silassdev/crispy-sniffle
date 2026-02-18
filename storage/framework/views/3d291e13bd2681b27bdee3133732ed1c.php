<div>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Certificate Requests</h2>
            <p class="text-gray-500 text-sm">Manage and issue certificates for students.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Filter Bar -->
        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input wire:model.live.debounce.300ms="q" type="text" 
                               class="w-full pl-10 pr-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-shadow" 
                               placeholder="Search by Reference, Student, or Notes...">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <select wire:model.live="status" class="w-full border border-gray-300 rounded-lg py-2 px-3 bg-white text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold tracking-wider text-left">
                    <tr>
                        <th class="px-6 py-3">Reference</th>
                        <th class="px-6 py-3">Student</th>
                        <th class="px-6 py-3">Course / Type</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Requested</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                    <?php echo e($cert->certificate_number ?? 'PENDING'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                        <?php echo e(substr($cert->student->name ?? 'U', 0, 1)); ?>

                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900"><?php echo e($cert->student->name ?? 'Unknown'); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo e($cert->student->email ?? ''); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 font-medium mb-0.5"><?php echo e($cert->course->title ?? 'General'); ?></div>
                                <div class="text-xs text-gray-500 capitalize bg-gray-100 inline-block px-1.5 py-0.5 rounded border border-gray-200">
                                    <?php echo e(str_replace('_', ' ', $cert->type)); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!--[if BLOCK]><![endif]--><?php if($cert->status === 'approved'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        <span class="w-1.5 h-1.5 bg-green-600 rounded-full mr-1.5"></span>
                                        Approved
                                    </span>
                                <?php elseif($cert->status === 'rejected'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                        <span class="w-1.5 h-1.5 bg-red-600 rounded-full mr-1.5"></span>
                                        Rejected
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <span class="w-1.5 h-1.5 bg-yellow-600 rounded-full mr-1.5 animate-pulse"></span>
                                        Pending
                                    </span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex flex-col">
                                    <span><?php echo e($cert->created_at->format('M d, Y')); ?></span>
                                    <span class="text-xs text-gray-400"><?php echo e($cert->created_at->diffForHumans()); ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="openModal(<?php echo e($cert->id); ?>)" 
                                        class="text-indigo-600 hover:text-indigo-900 font-medium hover:underline">
                                    View / Action
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div class="h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-certificate text-3xl text-gray-300"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">No Certificates Found</h3>
                                    <p class="text-sm text-gray-500 max-w-sm mt-1">
                                        Try adjusting your search or filters to find what you're looking for.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </tbody>
            </table>
        </div>

        <!--[if BLOCK]><![endif]--><?php if($certs->hasPages()): ?>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <?php echo e($certs->links()); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <!-- Action Modal -->
    <!--[if BLOCK]><![endif]--><?php if($isModalOpen && $selectedCert): ?>
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500/75 transition-opacity" 
                 wire:click="closeModal" 
                 aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-certificate text-indigo-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Certificate Request Details
                            </h3>
                            <div class="mt-4 space-y-4">
                                <!-- Details Grid -->
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div class="bg-gray-50 p-3 rounded">
                                        <span class="block text-xs uppercase text-gray-500 font-bold">Student</span>
                                        <span class="text-gray-900 font-medium"><?php echo e($selectedCert->student?->name ?? 'Unknown'); ?></span>
                                        <span class="block text-gray-500 text-xs"><?php echo e($selectedCert->student?->email ?? ''); ?></span>
                                    </div>
                                    <div class="bg-gray-50 p-3 rounded">
                                        <span class="block text-xs uppercase text-gray-500 font-bold">Trainer</span>
                                        <span class="text-gray-900 font-medium"><?php echo e($selectedCert->trainer?->name ?? 'Unknown'); ?></span>
                                    </div>
                                    <div class="col-span-2 bg-gray-50 p-3 rounded">
                                        <span class="block text-xs uppercase text-gray-500 font-bold">Course</span>
                                        <span class="text-gray-900 font-medium"><?php echo e($selectedCert->course?->title ?? 'General'); ?></span>
                                        <span class="block text-gray-500 text-xs capitalize">Type: <?php echo e(str_replace('_', ' ', $selectedCert->type)); ?></span>
                                    </div>
                                </div>

                                <div>
                                    <span class="block text-xs uppercase text-gray-500 font-bold mb-1">Request Notes</span>
                                    <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded italic border border-gray-100">
                                        <?php echo e($selectedCert->notes ?: 'No notes provided.'); ?>

                                    </p>
                                </div>

                                <!--[if BLOCK]><![endif]--><?php if($selectedCert->status !== 'pending'): ?>
                                    <div class="p-3 rounded <?php echo e($selectedCert->status === 'approved' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800'); ?>">
                                        <span class="font-bold uppercase text-xs">Current Status:</span> 
                                        <span class="font-medium capitalize"><?php echo e($selectedCert->status); ?></span>
                                        <!--[if BLOCK]><![endif]--><?php if($selectedCert->status === 'approved'): ?>
                                             on <?php echo e($selectedCert->issued_at ? $selectedCert->issued_at->format('M d, Y') : ''); ?>

                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <!--[if BLOCK]><![endif]--><?php if(strtolower($selectedCert->status) === 'pending'): ?>
                        
                        <!--[if BLOCK]><![endif]--><?php if($confirmingAction === 'approve'): ?>
                            <button type="button" 
                                    wire:click="approve" 
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm animate-pulse">
                                <i class="fas fa-check-double mr-2 mt-1"></i> Confirm Approve
                            </button>
                            <button type="button" 
                                    wire:click="cancelAction" 
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        <?php elseif($confirmingAction === 'reject'): ?>
                            <button type="button" 
                                    wire:click="reject" 
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm animate-pulse">
                                <i class="fas fa-ban mr-2 mt-1"></i> Confirm Reject
                            </button>
                            <button type="button" 
                                    wire:click="cancelAction" 
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        <?php else: ?>
                            <button type="button" 
                                    wire:click="verifyAction('approve')" 
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                <i class="fas fa-check mr-2 mt-1"></i> Approve
                            </button>
                            <button type="button" 
                                    wire:click="verifyAction('reject')" 
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                <i class="fas fa-times mr-2 mt-1"></i> Reject
                            </button>
                            <button type="button" 
                                    wire:click="closeModal" 
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Close
                            </button>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <?php else: ?>
                        <!-- Non-pending actions -->
                        <!--[if BLOCK]><![endif]--><?php if($selectedCert->status === 'approved'): ?>
                            <a href="<?php echo e(route('certificates.pdf.preview', $selectedCert->id)); ?>" target="_blank"
                               class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                <i class="fas fa-eye mr-2 mt-1"></i> Preview PDF
                            </a>
                            <a href="<?php echo e(route('certificates.pdf.download', $selectedCert->id)); ?>" 
                               class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                <i class="fas fa-download mr-2 mt-1"></i> Download PDF
                            </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <button type="button" 
                                wire:click="closeModal" 
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/certificate-manager.blade.php ENDPATH**/ ?>