<div>
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary fw-bold"><i class="fas fa-certificate me-2"></i> My Certificates</h5>
        </div>
        <div class="card-body">
            @if($certs->isEmpty())
                <div class="text-center py-5">
                    <img src="{{ asset('images/no-data.svg') }}" alt="No Certificates" class="img-fluid mb-3" style="max-height: 150px; opacity: 0.6">
                    <p class="text-muted">You haven't earned any certificates yet.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($certs as $cert)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border shadow-sm hover-shadow transition-all">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3 text-warning">
                                        <i class="fas fa-award fa-3x"></i>
                                    </div>
                                    <h6 class="card-title fw-bold text-dark mb-1">{{ $cert->course->title ?? 'Course Completion' }}</h6>
                                    <p class="text-muted small mb-3">{{ $cert->certificate_number }}</p>
                                    
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('certificates.pdf.preview', $cert->id) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                        <a href="{{ route('certificates.pdf.download', $cert->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                            <i class="fas fa-download me-1"></i> Download
                                        </a>
                                    </div>
                                    <div class="mt-3 text-muted" style="font-size: 0.8rem;">
                                        Issued: {{ $cert->issued_at ? $cert->issued_at->format('M d, Y') : 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
