@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
    <style>
        /* Enhanced Delete Modal Animations */
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
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Modal entrance animation */
        .modal.fade .modal-dialog {
            transition: transform 0.4s ease-out, opacity 0.4s ease-out;
            transform: scale(0.8) translateY(-50px);
        }
        
        .modal.show .modal-dialog {
            transform: scale(1) translateY(0);
        }
        
        /* Restaurant info card animation */
        .restaurant-info {
            animation: fadeInUp 0.6s ease-out 0.2s both;
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
    // Add loading state to delete button when clicked
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function() {
            // Reset any loading states
            const deleteBtn = deleteModal.querySelector('[wire\\:click="delete"]');
            if (deleteBtn) {
                deleteBtn.classList.remove('btn-loading');
                deleteBtn.innerHTML = '<i class="fas fa-trash-alt me-2"></i>Ya, Hapus Restoran';
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

    // Add entrance animation to modal
    const modal = document.getElementById('deleteModal');
    if (modal) {
        modal.addEventListener('shown.bs.modal', function() {
            const modalContent = this.querySelector('.modal-content');
            modalContent.style.animation = 'fadeInUp 0.4s ease-out';
        });
    }

    // Add shake animation for error states (if needed)
    window.shakeModal = function() {
        const modal = document.getElementById('deleteModal');
        if (modal) {
            const modalDialog = modal.querySelector('.modal-dialog');
            modalDialog.style.animation = 'shake 0.5s ease-in-out';
            setTimeout(() => {
                modalDialog.style.animation = '';
            }, 500);
        }
    };
});

// Add shake keyframe
const shakeStyle = document.createElement('style');
shakeStyle.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
`;
document.head.appendChild(shakeStyle);
</script>
@endpush

<div class="p-5">
    <!-- Search and Filter Section -->
    <div class="d-flex gap-sm-5 flex-sm-row flex-column gap-1 mb-4">
        <div class="search-container shadow search-bar-sorting border rounded mb-3">
            <i class="fas fa-search search-icon"></i>
            <input type="text" wire:model.live="search" class="form-control search-input height-custom" placeholder="Cari restoran...">
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
                    <i class="fas fa-utensils me-2"></i>
                    Manajemen Restoran
                </h3>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary">
                    <i class="fas fa-list me-1"></i>
                    {{ $restaurants->total() }} Total Restoran
                </span>
                <a href="{{ route('admin.restaurants.create') }}" class="text-decoration-none btn btn-primary mt-sm-0 mt-2">
                    <i class="fas fa-plus me-2"></i>Tambah Restoran
                </a>
            </div>
        </div>
    </div>

    <!-- Restaurants Cards -->
    <div class="row">
        @forelse ($restaurants as $restaurant)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($restaurant->cover)
                        <img src="{{ $this->getImageUrl($restaurant->cover) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $restaurant->name }}">
                    @else
                        <div class="card-img-top bg-body-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-utensils fs-1 text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $restaurant->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($restaurant->description, 100) }}</p>
                        
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $restaurant->location }}
                            </small>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-users me-1"></i>Kapasitas: {{ $restaurant->capacity }} orang
                            </small>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>{{ $restaurant->time_estimation }} menit
                            </small>
                        </div>

                        <!-- Staff Assignment -->
                        @if($restaurant->staff)
                            <div class="mb-2">
                                <small class="text-success">
                                    <i class="fas fa-user me-1"></i>Dikelola: {{ $restaurant->staff->name }}
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
                            <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    wire:click="confirmDelete({{ $restaurant->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted mt-5">
                <i class="fas fa-exclamation-circle me-2"></i> Tidak ada restoran ditemukan.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $restaurants->links() }}
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
                        $selectedRestaurant = $restaurants->firstWhere('id', $deleteId ?? null);
                    @endphp

                    <div class="alert alert-warning border-0 mb-4" style="background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%); border-radius: 15px; animation: fadeInUp 0.5s ease-out;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle text-warning me-2" style="font-size: 1.2rem;"></i>
                            <div>
                                <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                                <br><small class="text-muted">Semua data akan terhapus secara permanen dari sistem.</small>
                            </div>
                        </div>
                    </div>

                    <p class="mb-3" style="font-size: 1.1rem; color: #6c757d;">
                        Apakah Anda yakin ingin menghapus restoran:
                    </p>

                    <div class="restaurant-info p-3 mb-4" style="
                        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                        border-radius: 15px;
                        border-left: 4px solid #ff6b6b;
                    ">
                        <h5 class="fw-bold text-primary mb-2" style="font-size: 1.3rem;">
                            <i class="fas fa-utensils me-2 text-danger"></i>
                            "{{ $selectedRestaurant?->name ?? 'restoran ini' }}"
                        </h5>
                        @if($selectedRestaurant)
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $selectedRestaurant->location }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-users me-1"></i>{{ $selectedRestaurant->capacity }} orang
                            </small>
                        @endif
                    </div>

                    <p class="text-muted mb-4">
                        Semua data termasuk menu, pesanan, dan riwayat antrian akan terhapus permanen.
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
                        <i class="fas fa-trash-alt me-2"></i>Ya, Hapus Restoran
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
