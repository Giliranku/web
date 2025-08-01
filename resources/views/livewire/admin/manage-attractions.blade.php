@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
    <style>
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
        .attraction-info {
            animation: fadeIn 0.3s ease-out;
        }
        
        .alert {
            animation: fadeIn 0.2s ease-out !important;
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
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 1rem;
            }
            
            .modal-header {
                padding: 1.5rem 1.5rem 0.5rem !important;
            }
            
            .modal-body {
                padding: 1.5rem !important;
            }
            
            .modal-footer {
                padding: 0.5rem 1.5rem 1.5rem !important;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .modal-footer .btn {
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

@push('scripts')
<script>
document.addEventListener('livewire:navigated', function() {
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        // Reset button state when modal shows
        deleteModal.addEventListener('show.bs.modal', function() {
            const deleteBtn = deleteModal.querySelector('[wire\\:click="delete"]');
            if (deleteBtn) {
                deleteBtn.classList.remove('btn-loading');
                deleteBtn.innerHTML = '<i class="fas fa-trash-alt me-2"></i>Ya, Hapus Wahana';
            }
        });

        // Add loading state when delete is clicked
        const deleteBtn = deleteModal.querySelector('[wire\\:click="delete"]');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                this.classList.add('btn-loading');
                this.innerHTML = 'Menghapus...';
            });
        }
    }
});
</script>
@endpush

<div class="p-5">
    <!-- Search and Filter Section -->
    <div class="d-flex gap-sm-5 flex-sm-row flex-column gap-1 mb-4">
        <div class="search-container shadow search-bar-sorting border rounded mb-3">
            <i class="fas fa-search search-icon"></i>
            <input type="text" wire:model.live="search" class="form-control search-input height-custom" placeholder="Cari wahana...">
        </div>

        <!-- Location Filter -->
        <div class="position-relative shadow border rounded bg-body-secondary custom-input-sort flex-grow-1 flex-md-grow-0 height-custom">
            <div class="dropdown-label">Lokasi</div>
            <select wire:model.live="filterLocation" class="form-select custom-dropdown">
                <option value="">Semua Lokasi</option>
                <option value="Ancol">Ancol</option>
                <option value="Dufan Ancol">Dufan Ancol</option>
                <option value="Sea World Ancol">Sea World Ancol</option>
                <option value="Atlantis Ancol">Atlantis Ancol</option>
                <option value="Samudra Ancol">Samudra Ancol</option>
                <option value="Putri Duyung Ancol">Putri Duyung Ancol</option>
                <option value="Jakarta Bird Land Ancol">Jakarta Bird Land Ancol</option>
            </select>
        </div>

        <!-- Staff Filter -->
        <div class="position-relative shadow border rounded bg-body-secondary custom-input-sort flex-grow-1 flex-md-grow-0 height-custom">
            <div class="dropdown-label">Staff</div>
            <select wire:model.live="filterStaff" class="form-select custom-dropdown">
                <option value="">Semua Staff</option>
                <option value="unassigned">Belum Ditugaskan</option>
                @foreach($staff as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Header Card -->
    <div class="card w-100 shadow p-3 mb-3 mt-4 bg-body-tertiary rounded">
        <div class="d-flex align-items-center justify-content-between flex-sm-row flex-column">
            <div class="d-flex align-items-center">
                <div class="vertical-line-admin"></div>
                <h3 class="card-title ms-2">
                    <i class="fas fa-star me-2"></i>
                    Manajemen Wahana
                </h3>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary">
                    <i class="fas fa-list me-1"></i>
                    {{ $attractions->total() }} Total Wahana
                </span>
                <a href="{{ route('admin.attractions.create') }}" class="text-decoration-none btn btn-primary mt-sm-0 mt-2">
                    <i class="fas fa-plus me-2"></i>Tambah Wahana
                </a>
            </div>
        </div>
    </div>

    <!-- Attractions Cards -->
    <div class="row">
        @forelse ($attractions as $attraction)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($attraction->cover)
                        <img src="{{ $this->getImageUrl($attraction->cover) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $attraction->name }}">
                    @else
                        <div class="card-img-top bg-body-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-image fs-1 text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $attraction->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($attraction->description, 100) }}</p>
                        
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $attraction->location }}
                            </small>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-users me-1"></i>Kapasitas: {{ $attraction->capacity }} orang
                            </small>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>{{ $attraction->time_estimation }} menit
                            </small>
                        </div>

                        <!-- Staff Assignment -->
                        @if($attraction->staff)
                            <div class="mb-2">
                                <small class="text-success">
                                    <i class="fas fa-user me-1"></i>Dikelola: {{ $attraction->staff->name }}
                                </small>
                            </div>
                        @else
                            <div class="mb-2">
                                <small class="text-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Belum ada staff yang ditugaskan
                                </small>
                            </div>
                        @endif

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.attractions.edit', $attraction->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    wire:click="confirmDelete({{ $attraction->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted mt-5">
                <i class="fas fa-exclamation-circle me-2"></i> Tidak ada wahana ditemukan.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $attractions->links() }}
    </div>

    <!-- Delete Confirmation Modal - Redesigned -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <!-- Modal Header with Gradient -->
                <div class="modal-header border-0 text-white position-relative" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%); padding: 2rem 2rem 1rem;">
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
                        <h4 class="modal-title fw-bold mb-0" style="font-size: 1.5rem;">Konfirmasi Penghapusan</h4>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="modal-body text-center" style="padding: 2rem;">
                    @php
                        $selectedAttraction = $attractions->firstWhere('id', $deleteId ?? null);
                    @endphp

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
                        Apakah Anda yakin ingin menghapus wahana:
                    </p>

                    <div class="attraction-info p-3 mb-4" style="
                        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                        border-radius: 15px;
                        border-left: 4px solid #ff6b6b;
                    ">
                        <h5 class="fw-bold text-primary mb-2" style="font-size: 1.3rem;">
                            <i class="fas fa-star me-2 text-danger"></i>
                            "{{ $selectedAttraction?->name ?? 'wahana ini' }}"
                        </h5>
                        @if($selectedAttraction)
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $selectedAttraction->location }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-users me-1"></i>{{ $selectedAttraction->capacity ?? 'Unlimited' }} orang
                            </small>
                        @endif
                    </div>

                    <p class="text-muted mb-4">
                        Semua data termasuk pengaturan antrian, pesanan, dan riwayat akan terhapus permanen.
                    </p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-0 justify-content-center" style="padding: 1rem 2rem 2rem;">
                    <button type="button" class="btn btn-lg px-4 me-3 btn-hover-effect" 
                            style="
                                background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
                                border: none;
                                border-radius: 25px;
                                color: white;
                                font-weight: 600;
                                box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
                                transition: all 0.3s ease;
                            "
                            wire:click="delete"
                            data-bs-dismiss="modal"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(255, 107, 107, 0.6)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(255, 107, 107, 0.4)'">
                        <i class="fas fa-trash-alt me-2"></i>Ya, Hapus Wahana
                    </button>

                    <button type="button" class="btn btn-lg px-4 btn-hover-effect" 
                            style="
                                background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
                                border: none;
                                border-radius: 25px;
                                color: white;
                                font-weight: 600;
                                box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
                                transition: all 0.3s ease;
                            "
                            data-bs-dismiss="modal"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(108, 117, 125, 0.6)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(108, 117, 125, 0.4)'">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
