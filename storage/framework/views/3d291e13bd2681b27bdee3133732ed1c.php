<div>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input wire:model.live.debounce.300ms="q" type="text" class="form-control border-start-0 ps-0" placeholder="Search No, Notes...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select wire:model.live="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted uppercase small">
                    <tr>
                        <th class="ps-4">Reference</th>
                        <th>Student</th>
                        <th>Requested By</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-4 fw-medium text-dark">
                                <?php echo e($cert->certificate_number ?? 'PENDING'); ?>

                            </td>
                            <td>
                                <div>
                                    <div class="fw-medium"><?php echo e($cert->student->name ?? 'Unknown'); ?></div>
                                    <div class="small text-muted"><?php echo e($cert->student->email ?? ''); ?></div>
                                </div>
                            </td>
                            <td>
                                <div class="small"><?php echo e($cert->trainer->name ?? 'System'); ?></div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;" title="<?php echo e($cert->course->title ?? 'N/A'); ?>">
                                    <?php echo e($cert->course->title ?? '—'); ?>

                                </div>
                                <div class="small text-muted"><?php echo e($cert->type); ?></div>
                            </td>
                            <td>
                                <!--[if BLOCK]><![endif]--><?php if($cert->status === 'approved'): ?>
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">Approved</span>
                                <?php elseif($cert->status === 'rejected'): ?>
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3">Rejected</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3">Pending</span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </td>
                            <td class="small text-muted">
                                <?php echo e($cert->created_at->format('M d, Y')); ?>

                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="<?php echo e(route('admin.certificates.show', $cert->id)); ?>" class="btn btn-sm btn-light" title="View Request">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!--[if BLOCK]><![endif]--><?php if($cert->status === 'approved'): ?>
                                        <a href="<?php echo e(route('certificates.pdf.download', $cert->id)); ?>" class="btn btn-sm btn-light text-primary" title="Download PDF">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-file-alt fa-2x mb-3 opacity-50"></i>
                                <p>No certificates found.</p>
                            </td>
                        </tr>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </tbody>
            </table>
        </div>

        <!--[if BLOCK]><![endif]--><?php if($certs->hasPages()): ?>
            <div class="card-footer bg-white border-top-0 py-3">
                <?php echo e($certs->links()); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/certificate-manager.blade.php ENDPATH**/ ?>