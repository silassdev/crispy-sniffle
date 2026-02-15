@extends('dashboards.shell', ['section' => 'feedback', 'role' => 'admin'])

@section('dashboard-content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary fw-bold">Certificate Request Details</h5>
                    <span class="badge {{ $cert->status == 'approved' ? 'bg-success' : ($cert->status == 'rejected' ? 'bg-danger' : 'bg-warning') }} rounded-pill px-3">
                        {{ ucfirst($cert->status) }}
                    </span>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small text-uppercase fw-bold">Student</label>
                            <div class="d-flex align-items-center mt-2">
                                <div class="avatar avatar-md bg-light text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px">
                                    {{ substr($cert->student->name ?? '?', 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $cert->student->name ?? 'Unknown' }}</h6>
                                    <div class="small text-muted">{{ $cert->student->email ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small text-uppercase fw-bold">Course</label>
                            <h6 class="mt-2 fw-bold text-dark">{{ $cert->course->title ?? 'N/A' }}</h6>
                            <div class="small text-muted">{{ $cert->type }}</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted small text-uppercase fw-bold">Trainer Notes</label>
                        <div class="bg-light rounded p-3 mt-2 border">
                            {{ $cert->notes ?: 'No notes provided.' }}
                        </div>
                        <div class="text-end mt-1">
                            <small class="text-muted">Requested by {{ $cert->trainer->name ?? 'Trainer' }} on {{ $cert->created_at->format('M d, Y h:i A') }}</small>
                        </div>
                    </div>

                    @if($cert->status === 'pending')
                    <hr>
                    <div class="d-flex gap-3 justify-content-end mt-4">
                        <!-- Reject Button -->
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                            <i class="fas fa-times me-1"></i> Reject
                        </button>
                        
                        <!-- Approve Form -->
                         <form action="{{ route('admin.certificates.approve', $cert->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success text-white">
                                <i class="fas fa-check me-1"></i> Approve & Issue
                            </button>
                        </form>
                    </div>
                    @endif
                    
                    @if($cert->status === 'approved')
                        <hr>
                        <div class="alert alert-success d-flex align-items-center">
                            <i class="fas fa-check-circle fa-2x me-3"></i>
                            <div>
                                <strong>Issued on {{ $cert->issued_at->format('M d, Y') }}</strong>
                                <p class="mb-0 small">Certificate Number: {{ $cert->certificate_number }}</p>
                            </div>
                            <div class="ms-auto">
                                <a href="{{ route('certificates.pdf.download', $cert->id) }}" class="btn btn-sm btn-success">Download PDF</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
             <div class="text-center">
                <a href="{{ route('admin.certificates.index') }}" class="text-muted text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i> Back to list
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.certificates.reject', $cert->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Reject Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Reason for rejection <span class="text-danger">*</span></label>
                        <textarea name="admin_note" class="form-control" rows="3" required placeholder="Explain why this request is being rejected..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject Request</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
