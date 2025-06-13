<div class="container-fluid mt-5">
    <div class="search-container mx-auto shadow search-bar-sorting border rounded mb-3">
        <i class="bi bi-search search-icon"></i>
        <input type="text" class="form-control search-input" placeholder="Cari">
    </div>    


    <div class="d-flex flex-row flex-wrap flex-md-nowrap search-container justify-content-between gap-2">    
        {{-- Dropdown --}}
        <div x-data="{
            open: false,
            selected: 'Kapasitas Terbesar',
            select(option) {
                this.selected = option;
                this.open = false;
            },
            options: [
                'Kapasitas Terbesar',
                'Kapasitas Terkecil',
                'Harga Termurah',
                'Harga Tertinggi'
            ]
        }"
        class="position-relative shadow border rounded bg-light custom-input-sort flex-grow-1 flex-md-grow-0"
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
        

        
        {{-- Dropdown --}}
        <div x-data="{
            open: false,
            selected: 'Restoran',
            select(option) {
                this.selected = option;
                this.open = false;
            },
            options: [
                'Restoran',
                'Kapasitas Terkecil',
                'Harga Termurah',
                'Harga Tertinggi'
            ]
        }"
        class="position-relative shadow border rounded bg-light custom-input-sort flex-grow-1 flex-md-grow-0"
        @click.outside="open = false">

        <!-- Label -->
        <div class="dropdown-label">Kategori</div>

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


        {{-- Search Button --}}
        <button class="btn btn-primary search-sort-button flex-grow-1 flex-md-grow-0">Cari</button>
    </div>


    <div class="search-container row mt-2 mx-auto">
        <div class="w-100 bg-light shadow p-3 mt-3 rounded">
            <div class="d-flex flex-row gap-4 flex-wrap flex-md-nowrap position-relative">
                <img src="{{ asset('img/mekdi.png') }}" alt="" class="thumbnail img-fluid w-100" style="max-width: 400px; height: auto;">
                <div class="d-flex flex-column flex-grow-1 pb-5">
                    <h5>Restoran</h5>
                    <h2 class="fw-bold">Giliranku Fried Chicken</h2>
                    <div class="d-flex flex-row flex-wrap">
                        <div class="row me-3">
                            <div class="d-flex flex-row align-items-center gap-2">
                                <i class="bi bi-person-fill sort-icon"></i>
                                <h2 class="m-0">20</h2>
                            </div>
                            <p class="m-0">Antrian</p>
                        </div>
                        
                        <div class="vr mx-3 d-none d-md-block"></div>
                        <div class="row">
                            <div class="d-flex flex-row align-items-center gap-2">
                                <i class="bi bi-clock sort-icon"></i>
                                <h2>10</h2>
                            </div>
                            <p>Menit</p>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mt-md-0 position-absolute position-md-static" style="right: 0; bottom: 0;">
                    <button class="btn btn-primary w-100">Lihat Detail</button>
                </div>
            </div>
        </div>
    </div>
    <style>
    @media (max-width: 767.98px) {
        .search-container .d-flex.flex-row.gap-4 {
            flex-direction: column !important;
            gap: 1rem !important;
        }
        .search-container .thumbnail {
            max-width: 80px;
            margin-bottom: 1rem;
        }
        .search-container .vr {
            display: none !important;
        }
        .search-container button.btn {
            width: 100%;
        }
        .search-container .position-relative > div[style*="position: absolute"] {
            position: static !important;
            bottom: auto !important;
            right: auto !important;
            margin-top: 1rem;
        }
    }
    </style>
    
</div>