<div class="p-5">
    <div class="d-flex gap-sm-5 flex-sm-row flex-column gap-1">
        <div class="search-container shadow search-bar-sorting border rounded mb-3">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="form-control search-input height-custom" placeholder="Cari">
        </div>

        {{-- Dropdown --}}
        <div x-data="{
            open: false,
            selected: 'Ancol',
            select(option) {
                this.selected = option;
                this.open = false;
            },
            options: [
                'Ancol',
                'Dufan Ancol',
                'Sea World Ancol',
                'Atlantis Ancol',
                'Samudra Ancol',
                'Putri Duyung Ancol',
                'Jakarta Bird Land Ancol'
            ]
        }"
        class="position-relative shadow border rounded bg-light custom-input-sort flex-grow-1 flex-md-grow-0 height-custom"
        @click.outside="open = false">

        <!-- Label -->
        <div class="dropdown-label">Urutkan Dari</div>

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
        {{-- End Dropdown --}}
    </div>
    <div class="card w-100 shadow p-3 mb-3 mt-4 bg-body-tertiary rounded">
        <div class="d-flex align-items-center justify-content-between flex-sm-row flex-column">
            <div class="d-flex align-items-center">
                <div class="vertical-line-admin"></div>
                <h3 class="card-title ms-2">Daftar Tiket</h3>
            </div>
            <div>
                <div>
                    <a href="/manage-ticket-add" class="text-decoration-none me-auto btn btn-primary mt-sm-0 mt-2">Tambahkan<i class="bi bi-plus-circle ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column gap-3">
        <div class="card w-100 shadow p-sm-3 p-1 bg-body-tertiary rounded">
            <div class="card-body d-flex align-items-center justify-content-between flex-sm-row flex-column">
                <div class="d-flex align-items-center flex-sm-row flex-column">
                    <img src="{{asset('img/ancol-logo.png')}}" class="card-img-top rounded w-10" alt="Konser di Pantai Ancol">
                    <div class="ms-4">
                        <h5 class="card-title mt-3">Tiket Masuk Ancol</h5>
                        <p><span class="fw-bolder m-0">Harga : </span>Rp 100.000</p>
                    </div>
                </div>
                <div class="d-flex flex-sm-column flex-row gap-3">
                    <div>
                        <a href="/manage-ticket-edit" class="text-decoration-none me-auto btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                    </div>
                    <div>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#delete"><i class="bi bi-trash-fill"></i></button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Vertically centered modal -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-body text-center p-5">
                    <button type="button" class="btn position-absolute top-0 end-0 m-3 p-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-5"></i>
                    </button>
                    <p class="mb-1">Apakah Anda yakin akan menghapus</p>
                    <h5 class="fw-bold mb-5 mt-2">"Tiket Masuk Ancol?"</h5>
                <div class="d-flex justify-content-center gap-4">
                    <button type="button" class="btn btn-primary">Ya, saya yakin</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
