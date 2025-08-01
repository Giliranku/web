@push('styles')
@vite([
    'resources/css/jesselyn.css',
    'resources/css/sorting.css',
])
<style>
    /* Custom Pagination Styling - Clean Approach */
    .pagination-custom {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        list-style: none;
    }
    
    .pagination-custom .page-item {
        margin: 0;
        list-style: none;
    }
    
    .pagination-custom .page-link {
        color: var(--bs-primary);
        background-color: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color);
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        min-width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
    }
    
    .pagination-custom .page-link:hover {
        color: white;
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        transform: translateY(-1px);
        text-decoration: none;
    }
    
    .pagination-custom .page-item.active .page-link {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        color: white;
        box-shadow: 0 2px 8px rgba(var(--bs-primary-rgb), 0.3);
    }
    
    .pagination-custom .page-item.disabled .page-link {
        color: var(--bs-secondary-color);
        background-color: var(--bs-secondary-bg);
        border-color: var(--bs-border-color);
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    .pagination-custom .page-item.disabled .page-link:hover {
        transform: none;
        background-color: var(--bs-secondary-bg);
        border-color: var(--bs-border-color);
        color: var(--bs-secondary-color);
    }
    
    /* Dark mode support */
    [data-bs-theme="dark"] .pagination-custom .page-link {
        background-color: var(--bs-dark);
        border-color: var(--bs-border-color-translucent);
        color: var(--bs-body-color);
    }
    
    [data-bs-theme="dark"] .pagination-custom .page-link:hover {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        color: white;
    }
    
    [data-bs-theme="dark"] .pagination-custom .page-item.active .page-link {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        color: white;
    }
    
    [data-bs-theme="dark"] .pagination-custom .page-item.disabled .page-link {
        background-color: var(--bs-secondary-bg);
        border-color: var(--bs-border-color-translucent);
        color: var(--bs-secondary-color);
    }
    
    /* Pagination container styling */
    .pagination-wrapper {
        background: var(--bs-body-bg);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--bs-border-color);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    
    .pagination-info {
        color: var(--bs-secondary-color);
        font-size: 0.875rem;
        text-align: center;
    }
    
    [data-bs-theme="dark"] .pagination-wrapper {
        background: var(--bs-dark);
        border-color: var(--bs-border-color-translucent);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    /* Enhanced Delete Modal Animations - Single Fade In Only */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    @keyframes ripple {
        0% { 
            transform: translateX(-50%) scale(0.8);
            opacity: 1;
        }
        100% { 
            transform: translateX(-50%) scale(1.2);
            opacity: 0;
        }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    /* Modal entrance - No slide, only fade */
    .modal.fade .modal-dialog {
        transition: opacity 0.15s linear;
    }
    
    .modal.show .modal-dialog {
        opacity: 1;
    }
    
    /* Simple fade for elements - no slide up */
    .user-info {
        animation: fadeIn 0.3s ease-out;
    }
    
    /* Button loading state */
    .btn-loading {
        position: relative;
        pointer-events: none;
    }
    
    .btn-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    /* Icon bounce animation */
    .icon-bounce {
        animation: iconBounce 0.6s ease-in-out;
    }
    
    @keyframes iconBounce {
        0%, 20%, 60%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        80% { transform: translateY(-5px); }
    }
    
    /* Responsive adjustments for delete modal */
    @media (max-width: 576px) {
        .delete-modal-dialog {
            margin: 1rem;
        }
        
        .delete-modal-header {
            padding: 1.5rem 1.5rem 0.5rem !important;
        }
        
        .delete-modal-body {
            padding: 1.5rem !important;
        }
        
        .delete-modal-footer {
            padding: 0.5rem 1.5rem 1.5rem !important;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .delete-modal-footer .btn {
            width: 100%;
            margin: 0 !important;
        }
        
        .delete-icon-bg {
            width: 60px !important;
            height: 60px !important;
        }
        
        .delete-icon-bg i {
            font-size: 1.5rem !important;
        }
    }
</style>
@endpush

<div class="p-5">
    <!-- Search and Sort Controls -->
    <div class="d-flex gap-sm-5 flex-sm-row flex-column gap-1">
        <div class="search-container shadow search-bar-sorting border rounded mb-3">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="form-control search-input height-custom" placeholder="Cari nama, email, atau nomor..." wire:model.live="search">
        </div>

        {{-- Dropdown Sort --}}
        <div x-data="{
            open: false,
            selected: '{{ $sortBy === 'created_at' ? 'Terbaru' : ($sortBy === 'name' ? 'Nama' : 'Email') }}',
            select(option, value) {
                this.selected = option;
                this.open = false;
                @this.set('sortBy', value);
            },
            options: [
                { label: 'Terbaru', value: 'created_at' },
                { label: 'Nama', value: 'name' },
                { label: 'Email', value: 'email' }
            ]
        }"
        class="position-relative shadow border rounded bg-body-secondary custom-input-sort flex-grow-1 flex-md-grow-0 height-custom"
        @click.outside="open = false">

            <!-- Label -->
            <div class="dropdown-label">Urutkan Dari</div>

            <!-- Trigger -->
            <div class="custom-dropdown" @click="open = !open">
                <span x-text="selected" style="font-size: 1rem;"></span>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>

            <!-- Dropdown Options -->
            <div class="dropdown-list bg-body-secondary" x-show="open" x-transition>
                <template x-for="option in options" :key="option.value">
                    <div class="dropdown-item" @click="select(option.label, option.value)" x-text="option.label"></div>
                </template>
            </div>
        </div>
        {{-- End Dropdown --}}
    </div>

    <!-- Header Card -->
    <div class="card w-100 shadow p-3 mb-3 mt-4 bg-body-tertiary rounded">
        <div class="d-flex align-items-center justify-content-between flex-sm-row flex-column">
            <div class="d-flex align-items-center">
                <div class="vertical-line-admin"></div>
                <h3 class="card-title ms-2">
                    <i class="fas fa-users me-2"></i>
                    Daftar User
                </h3>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary">
                    <i class="fas fa-chart-bar me-1"></i>
                    {{ $users->total() }} Total Users
                </span>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Users List -->
    <div class="d-flex flex-column gap-3">
        @forelse($users as $user)
            <div class="card w-100 shadow p-3 bg-body-tertiary rounded">
                <div class="card-body d-flex align-items-center justify-content-between flex-sm-row flex-column">
                    <div class="d-flex align-items-center flex-sm-row flex-column w-100">
                        <!-- User Avatar -->
                        <div class="flex-shrink-0 me-3 mb-2 mb-sm-0">
                            @if($user->avatar)
                                @if(str_contains($user->avatar, 'http'))
                                    <img src="{{ $user->avatar }}" class="rounded-circle" width="60" height="60" alt="Avatar" style="object-fit:cover;">
                                @else
                                    <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle" width="60" height="60" alt="Avatar" style="object-fit:cover;">
                                @endif
                            @else
                                <div class="bg-body-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-person-fill text-muted fs-4"></i>
                                </div>
                            @endif
                        </div>

                        <!-- User Info -->
                        <div class="flex-grow-1 text-center text-sm-start">
                            <h5 class="card-title mb-1">{{ $user->name }}</h5>
                            <p class="text-muted mb-1">
                                <i class="bi bi-envelope me-1"></i>
                                {{ $user->email }}
                            </p>
                            <p class="text-muted mb-1">
                                <i class="bi bi-phone me-1"></i>
                                {{ $user->number ?? 'Tidak ada nomor' }}
                            </p>
                            <div class="d-flex gap-2 justify-content-center justify-content-sm-start">
                                @if($user->google_id)
                                    <span class="badge bg-info">
                                        <i class="bi bi-google me-1"></i>
                                        Google Account
                                    </span>
                                @endif
                                <span class="badge bg-{{ $user->email_verified_at ? 'success' : 'warning' }}">
                                    {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                                </span>
                                <span class="badge bg-secondary">
                                    {{ $user->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex flex-sm-column flex-row gap-2 mt-sm-0 mt-3">
                        <button wire:click="showUserDetail({{ $user->id }})" class="btn btn-info btn-sm">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        <a href="{{ route('admin.edit-user', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" 
                                wire:click="confirmDelete({{ $user->id }})"
                                type="button">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                <h4 class="text-muted mt-3">Tidak ada user ditemukan</h4>
                <p class="text-muted">{{ $search ? 'Coba ubah kata kunci pencarian' : 'Belum ada user yang terdaftar' }}</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                </div>
                
                <!-- Custom Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-custom">
                        {{-- Previous Page Link --}}
                        @if ($users->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $users->previousPageUrl() }}" wire:navigate>Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            @if ($page == $users->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}" wire:navigate>{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($users->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $users->nextPageUrl() }}" wire:navigate>Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    @endif

    <!-- User Detail Modal -->
    @if($showModal && $selectedUser)
        <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog" aria-labelledby="userDetailModalLabel" aria-modal="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content rounded-4">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="userDetailModalLabel">Detail User</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                @if($selectedUser->avatar)
                                    @if(str_contains($selectedUser->avatar, 'http'))
                                        <img src="{{ $selectedUser->avatar }}" class="rounded-circle mb-3" width="120" height="120" alt="Avatar" style="object-fit:cover;">
                                    @else
                                        <img src="{{ asset('storage/' . $selectedUser->avatar) }}" class="rounded-circle mb-3" width="120" height="120" alt="Avatar" style="object-fit:cover;">
                                    @endif
                                @else
                                    <div class="bg-body-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 120px; height: 120px;">
                                        <i class="bi bi-person-fill text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                                <h4>{{ $selectedUser->name }}</h4>
                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                    @if($selectedUser->google_id)
                                        <span class="badge bg-info">
                                            <i class="bi bi-google me-1"></i>
                                            Google
                                        </span>
                                    @endif
                                    <span class="badge bg-{{ $selectedUser->email_verified_at ? 'success' : 'warning' }}">
                                        {{ $selectedUser->email_verified_at ? 'Verified' : 'Unverified' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Email</label>
                                        <p class="form-control-plaintext">{{ $selectedUser->email }}</p>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Nomor Telepon</label>
                                        <p class="form-control-plaintext">{{ $selectedUser->number ?? 'Tidak ada nomor' }}</p>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Lokasi</label>
                                        <p class="form-control-plaintext">{{ $selectedUser->location ?? 'Tidak ada lokasi' }}</p>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-bold">Bergabung</label>
                                        <p class="form-control-plaintext">{{ $selectedUser->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-bold">Terakhir Update</label>
                                        <p class="form-control-plaintext">{{ $selectedUser->updated_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    @if($selectedUser->email_verified_at)
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Email Verified</label>
                                            <p class="form-control-plaintext">{{ $selectedUser->email_verified_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                        <a href="{{ route('admin.edit-user', $selectedUser->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-fill me-2"></i>
                            Edit User
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

    <!-- Delete Confirmation Modal - Redesigned -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md delete-modal-dialog" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <!-- Modal Header with Gradient -->
                <div class="modal-header border-0 text-white position-relative delete-modal-header" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%); padding: 2rem 2rem 1rem;">
                    <button type="button" class="btn-close btn-close-white position-absolute" style="top: 1rem; right: 1rem;" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
                    
                    <!-- Animated Icon -->
                    <div class="w-100 text-center">
                        <div class="delete-icon-container mb-3" style="position: relative;">
                            <div class="delete-icon-bg" style="
                                width: 80px; 
                                height: 80px; 
                                background: rgba(255,255,255,0.2);
                                border-radius: 50%;
                                margin: 0 auto;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                animation: pulse 2s infinite;
                                backdrop-filter: blur(10px);
                            ">
                                <i class="fas fa-trash-alt icon-bounce" style="font-size: 2rem; color: white;"></i>
                            </div>
                            <!-- Warning rings -->
                            <div style="
                                position: absolute;
                                top: -10px;
                                left: 50%;
                                transform: translateX(-50%);
                                width: 100px;
                                height: 100px;
                                border: 2px solid rgba(255,255,255,0.3);
                                border-radius: 50%;
                                animation: ripple 2s infinite;
                            "></div>
                        </div>
                        <h4 class="modal-title fw-bold mb-0" id="deleteModalLabel" style="font-size: 1.5rem;">Konfirmasi Penghapusan</h4>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="modal-body text-center delete-modal-body" style="padding: 2rem;">
                    <div class="alert alert-warning border-0 mb-4" style="background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%); border-radius: 15px;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle text-warning me-2" style="font-size: 1.2rem;"></i>
                            <div>
                                <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                                <br><small class="text-muted">Semua data akan terhapus secara permanen dari sistem.</small>
                            </div>
                        </div>
                    </div>

                    <p class="mb-3" style="font-size: 1.1rem; color: #6c757d;">
                        Apakah Anda yakin ingin menghapus user:
                    </p>

                    <div class="user-info p-3 mb-4" style="
                        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                        border-radius: 15px;
                        border-left: 4px solid #ff6b6b;
                    ">
                        <h5 class="fw-bold text-primary mb-2" style="font-size: 1.3rem;">
                            <i class="fas fa-user me-2 text-danger"></i>
                            "{{ $selectedUser?->name ?? 'user ini' }}"
                        </h5>
                        @if($selectedUser)
                            <small class="text-muted">
                                <i class="fas fa-envelope me-1"></i>{{ $selectedUser->email }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-calendar me-1"></i>Member sejak {{ $selectedUser->created_at->format('d M Y') }}
                            </small>
                        @endif
                    </div>

                    <p class="text-muted mb-4">
                        Semua data termasuk profil, preferensi, riwayat pembelian, dan antrian akan terhapus permanen.
                    </p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-0 justify-content-center delete-modal-footer" style="padding: 1rem 2rem 2rem;">
                    <button type="button" class="btn btn-lg px-4 me-3 btn-hover-effect" 
                            wire:click="deleteUser"
                            data-bs-dismiss="modal"
                            style="
                                background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
                                border: none;
                                border-radius: 25px;
                                color: white;
                                font-weight: 600;
                                box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
                                transition: all 0.3s ease;
                            "
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(255, 107, 107, 0.6)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(255, 107, 107, 0.4)'">
                        <i class="fas fa-trash-alt me-2"></i>Ya, Hapus User
                    </button>

                    <button type="button" class="btn btn-lg px-4 btn-hover-effect" 
                            data-bs-dismiss="modal"
                            style="
                                background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
                                border: none;
                                border-radius: 25px;
                                color: white;
                                font-weight: 600;
                                box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
                                transition: all 0.3s ease;
                            "
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(108, 117, 125, 0.6)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(108, 117, 125, 0.4)'">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Close modal when clicking outside (only for user detail modal)
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-backdrop') && !document.getElementById('deleteModal').classList.contains('show')) {
        @this.closeModal();
    }
});
</script>
@endpush
