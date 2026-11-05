@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 rounded-0 mb-4" role="alert" style="background: rgba(16, 185, 129, 0.15); border-left: 4px solid #10B981 !important; color: #34D399;">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 rounded-0 mb-4" role="alert" style="background: rgba(244, 63, 94, 0.15); border-left: 4px solid #F43F5E !important; color: #FB7185;">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <div>{{ session('error') }}</div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show border-0 rounded-0 mb-4" role="alert" style="background: rgba(59, 130, 246, 0.15); border-left: 4px solid #3B82F6 !important; color: #60A5FA;">
        <div class="d-flex align-items-center">
            <i class="bi bi-info-circle-fill me-2 fs-5"></i>
            <div>{{ session('info') }}</div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
