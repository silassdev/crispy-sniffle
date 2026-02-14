<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-primary fw-bold mb-0"><i class="fas fa-certificate me-2"></i> Certificates Management</h4>
        {{-- <button wire:click="create" class="btn btn-primary"><i class="fas fa-plus me-1"></i> New Request</button> --}}
        <!-- Trigger modal via JS or separate component if needed, or simple redirect -->
        <a href="{{ route('trainer.certificates.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Request Certificate</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input wire:model.live.debounce.300ms="q" type="text" class="form-control border-start-0 ps-0" placeholder="Search student, number...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select wire:model.live="status" class="form-select">
                        <option value="all">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <!-- <div class="col-md-3">
                    <select wire:model.live="type" class="form-select">
                        <option value="all">All Types</option>
                        <option value="course_completion">Course Completion</option>
                        <option value="graduation">Graduation</option>
                    </select>
                </div> -->
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted uppercase small">
                    <tr>
                        <th class="ps-4">Reference</th>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($certs as $cert)
                        <tr>
                            <td class="ps-4 fw-medium text-dark">
                                {{ $cert->certificate_number ?? 'PENDING' }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2 bg-primary rounded-circle text-white d-flex align-items-center justify-content-center" style="width:32px;height:32px">
                                        {{ substr($cert->student->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium">{{ $cert->student->name ?? 'Unknown' }}</div>
                                        <div class="small text-muted">{{ $cert->student->email ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $cert->course->title ?? '—' }}</td>
                            <td>
                                @if($cert->status === 'approved')
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">Approved</span>
                                @elseif($cert->status === 'rejected')
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3">Rejected</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3">Pending</span>
                                @endif
                            </td>
                            <td class="small text-muted">
                                {{ $cert->created_at->format('M d, Y') }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('trainer.certificates.show', $cert->id) }}" class="btn btn-sm btn-light" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($cert->status === 'approved')
                                        <a href="{{ route('certificates.pdf.download', $cert->id) }}" class="btn btn-sm btn-light text-primary" title="Download PDF">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-file-alt fa-2x mb-3 opacity-50"></i>
                                <p>No certificates found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($certs->hasPages())
            <div class="card-footer bg-white border-top-0 py-3">
                {{ $certs->links() }}
            </div>
        @endif
    </div>
</div>
