@push('styles')
@vite([
    'resources/css/jesselyn.css',
    'resources/css/sorting.css',
])
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
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" wire:click="confirmDelete({{ $user->id }})">
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
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-body text-center p-5">
                    <button type="button" class="btn position-absolute top-0 end-0 m-3 p-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-5"></i>
                    </button>
                    <div class="text-danger mb-4">
                        <i class="bi bi-exclamation-triangle-fill" style="font-size: 4rem;"></i>
                    </div>
                    <p class="mb-1">Apakah Anda yakin akan menghapus user ini?</p>
                    <h5 class="fw-bold mb-4 mt-2">Tindakan ini tidak dapat dibatalkan!</h5>
                    <div class="d-flex justify-content-center gap-4">
                        <button type="button" class="btn btn-danger" wire:click="deleteUser" data-bs-dismiss="modal">
                            <i class="bi bi-trash-fill me-2"></i>
                            Ya, Hapus
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-2"></i>
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-backdrop')) {
        @this.closeModal();
    }
});
</script>
@endpush
