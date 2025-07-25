@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
@endpush

<div class="p-5">
    <!-- Search and Filter Section -->
    <div class="d-flex gap-sm-5 flex-sm-row flex-column gap-1 mb-4">
        <div class="search-container shadow search-bar-sorting border rounded mb-3">
            <i class="fas fa-search search-icon"></i>
            <input type="text" wire:model.live="search" class="form-control search-input height-custom" placeholder="Cari restoran...">
        </div>

        <!-- Location Filter -->
        <div class="position-relative shadow border rounded bg-light custom-input-sort flex-grow-1 flex-md-grow-0 height-custom">
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
        <div class="position-relative shadow border rounded bg-light custom-input-sort flex-grow-1 flex-md-grow-0 height-custom">
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
                        <img src="{{ asset('storage/' . $restaurant->cover) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $restaurant->name }}">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
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
                        <div class="mb-3">
                            <span class="badge bg-success">{{ $restaurant->category }}</span>
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

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" 
                        data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fs-5"></i>
                    </button>

                    <p class="mb-1">Apakah Anda yakin akan menghapus restoran</p>

                    @php
                        $selectedRestaurant = $restaurants->firstWhere('id', $deleteId ?? null);
                    @endphp

                    <h5 class="fw-bold mb-5 mt-2">
                        "{{ $selectedRestaurant?->name ?? 'restoran ini' }}"
                    </h5>

                    <div class="d-flex justify-content-center gap-4">
                        <button type="button" class="btn btn-danger"
                                wire:click="delete"
                                data-bs-dismiss="modal">
                            <i class="fas fa-check me-2"></i>Ya, saya yakin
                        </button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
