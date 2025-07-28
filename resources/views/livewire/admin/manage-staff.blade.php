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
            <input type="text" wire:model.live="search" class="form-control search-input height-custom" placeholder="Cari staff...">
        </div>

        <!-- Role Filter -->
        <div class="position-relative shadow border rounded bg-body-secondary custom-input-sort flex-grow-1 flex-md-grow-0 height-custom">
            <div class="dropdown-label">Role</div>
            <select wire:model.live="filterRole" class="form-select custom-dropdown">
                <option value="">Semua Role</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="manager">Manager</option>
            </select>
        </div>
    </div>

    <!-- Header Card -->
    <div class="card w-100 shadow p-3 mb-3 mt-4 bg-body-tertiary rounded">
        <div class="d-flex align-items-center justify-content-between flex-sm-row flex-column">
            <div class="d-flex align-items-center">
                <div class="vertical-line-admin"></div>
                <h3 class="card-title ms-2">
                    <i class="fas fa-users me-2"></i>
                    Manajemen Staff
                </h3>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary">
                    <i class="fas fa-list me-1"></i>
                    {{ $staff->total() }} Total Staff
                </span>
                <a href="{{ route('admin.staff.create') }}" class="text-decoration-none btn btn-primary mt-sm-0 mt-2">
                    <i class="fas fa-plus me-2"></i>Tambah Staff
                </a>
            </div>
        </div>
    </div>

    <!-- Staff Cards -->
    <div class="row">
        @forelse ($staff as $member)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            @if($member->avatar)
                                <img src="{{ asset('storage/' . $member->avatar) }}" alt="Avatar" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            @endif
                            <div>
                                <h5 class="card-title mb-1">{{ $member->name }}</h5>
                                <span class="badge bg-{{ $member->role === 'admin' ? 'danger' : ($member->role === 'manager' ? 'warning' : 'info') }}">
                                    {{ ucfirst($member->role) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mb-2">
                            <small class="text-muted"><i class="fas fa-envelope me-1"></i>{{ $member->email }}</small>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i class="fas fa-phone me-1"></i>{{ $member->number }}</small>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ $member->location }}</small>
                        </div>

                        <!-- Assigned Attraction/Restaurant -->
                        @if($member->attraction)
                            <div class="mb-2">
                                <small class="text-success">
                                    <i class="fas fa-star me-1"></i>Mengelola: {{ $member->attraction->name }}
                                </small>
                            </div>
                        @endif
                        @if($member->restaurant)
                            <div class="mb-2">
                                <small class="text-success">
                                    <i class="fas fa-utensils me-1"></i>Mengelola: {{ $member->restaurant->name }}
                                </small>
                            </div>
                        @endif

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.staff.edit', $member->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    wire:click="confirmDelete({{ $member->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted mt-5">
                <i class="fas fa-exclamation-circle me-2"></i> Tidak ada staff ditemukan.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $staff->links() }}
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

                    <p class="mb-1">Apakah Anda yakin akan menghapus staff</p>

                    @php
                        $selectedStaff = $staff->firstWhere('id', $deleteId ?? null);
                    @endphp

                    <h5 class="fw-bold mb-5 mt-2">
                        "{{ $selectedStaff?->name ?? 'staff ini' }}"
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
