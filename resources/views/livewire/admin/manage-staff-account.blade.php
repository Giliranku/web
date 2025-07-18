@push('styles')
@vite([
    'resources/css/jesselyn.css',
    'resources/css/sorting.css',
])
@endpush

<div class="p-5">
    <!-- Search Bar dan Dropdown -->
    <div class="d-flex gap-sm-5 flex-sm-row flex-column gap-1">
        <!-- Search -->
        <div class="search-container shadow search-bar-sorting border rounded mb-3">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="form-control search-input height-custom" placeholder="Cari">
        </div>

        <!-- Dropdown Dummy -->
        <div x-data="{
            open: false,
            selected: 'Wahana',
            select(option) {
                this.selected = option;
                this.open = false;
            },
            options: [
                'Wahana',
                'Restoran',
            ]
        }"
        class="position-relative shadow border rounded bg-light custom-input-sort flex-grow-1 flex-md-grow-0 height-custom"
        @click.outside="open = false">

            <!-- Label -->
            <div class="dropdown-label">Bagian</div>

            <!-- Trigger -->
            <div class="custom-dropdown" @click="open = !open">
                <span x-text="selected" style="font-size: 1rem;"></span>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>

            <!-- Dropdown Options -->
            <div class="dropdown-list bg-light dark:text-dark" x-show="open" x-transition>
                <template x-for="option in options" :key="option">
                    <div class="dropdown-item" @click="select(option)" x-text="option"></div>
                </template>
            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="card w-100 shadow p-3 mb-3 mt-4 bg-body-tertiary rounded">
        <div class="d-flex align-items-center justify-content-between flex-sm-row flex-column">
            <div class="d-flex align-items-center">
                <div class="vertical-line-admin"></div>
                <h3 class="card-title ms-2">Daftar Staff</h3>
            </div>
            <div>
                <a href="/manage-staff-account-add" class="text-decoration-none me-auto btn btn-primary mt-sm-0 mt-2">
                    Tambahkan<i class="bi bi-plus-circle ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Dummy Staff Data -->
    @php
        $staffList = [
            ['name' => 'Abang 123', 'wahana' => 'Kora kora', 'image' => 'https://randomuser.me/api/portraits/men/11.jpg'],
            ['name' => 'Sindi Puspita', 'wahana' => 'Bianglala', 'image' => 'https://randomuser.me/api/portraits/women/21.jpg'],
            ['name' => 'Rahmad Affi', 'wahana' => 'Ice Age', 'image' => 'https://randomuser.me/api/portraits/men/31.jpg'],
        ];
    @endphp

    <!-- Daftar Staff atau Empty -->
    <div class="d-flex flex-column gap-3">
        @forelse ($staffList as $staff)
            <div class="card w-100 shadow p-sm-3 p-1 bg-body-tertiary rounded">
                <div class="card-body d-flex align-items-center justify-content-between flex-sm-row flex-column">
                    <div class="d-flex align-items-center flex-sm-row flex-column text-center text-sm-start">
                        <img src="{{ $staff['image'] }}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $staff['name'] }}">
                        <div class="ms-sm-4 mt-3 mt-sm-0">
                            <h5 class="card-title m-0 mb-2">{{ $staff['name'] }}</h5>
                            <p class=""><span class="fw-bolder">Staff Wahana :</span> {{ $staff['wahana'] }}</p>
                        </div>
                    </div>
                    <div class="d-flex flex-sm-column flex-row gap-3 mt-sm-0 mt-2">
                        <div>
                            <a href="/manage-news-edit" class="text-decoration-none me-auto btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        </div>
                        <div>
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#delete"><i class="bi bi-trash-fill"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted mt-5">
                <i class="bi bi-exclamation-circle"></i> Tidak ada staff ditemukan.
            </div>
        @endforelse
    </div>

    <!-- Vertically Centered Modal Delete -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-body text-center p-5">
                    <!-- Close Button -->
                    <button type="button" class="btn position-absolute top-0 end-0 m-3 p-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-5"></i>
                    </button>

                    <p class="mb-1">Apakah Anda yakin akan menghapus</p>
                    <h5 class="fw-bold mb-5 mt-2">"Staff Ini"</h5>

                    <div class="d-flex justify-content-center gap-4">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                            Ya, saya yakin
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
