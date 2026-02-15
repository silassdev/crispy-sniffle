<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800"><i class="fas fa-certificate me-2 text-indigo-600"></i> Certificates Management</h2>
        <a href="<?php echo e(route('trainer.certificates.create')); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
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
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <?php echo e($cert->certificate_number ?? 'PENDING'); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs uppercase">
                                        <?php echo e(substr($cert->student->name ?? 'U', 0, 1)); ?>

                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900"><?php echo e($cert->student->name ?? 'Unknown'); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo e($cert->student->email ?? ''); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <?php echo e($cert->course->title ?? '—'); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!--[if BLOCK]><![endif]--><?php if($cert->status === 'approved'): ?>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Approved</span>
                                <?php elseif($cert->status === 'rejected'): ?>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Rejected</span>
                                <?php else: ?>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo e($cert->created_at->format('M d, Y')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="<?php echo e(route('trainer.certificates.show', $cert->id)); ?>" class="text-gray-500 hover:text-indigo-600 transition" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!--[if BLOCK]><![endif]--><?php if($cert->status === 'approved'): ?>
                                        <a href="<?php echo e(route('certificates.pdf.download', $cert->id)); ?>" class="text-indigo-600 hover:text-indigo-900 transition" title="Download PDF">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-file-alt text-4xl mb-3 text-gray-300"></i>
                                    <p class="text-lg font-medium text-gray-900">No certificates found</p>
                                    <p class="text-sm text-gray-500">Get started by requesting a certificate for your students.</p>
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
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/trainer/certificates-index.blade.php ENDPATH**/ ?>