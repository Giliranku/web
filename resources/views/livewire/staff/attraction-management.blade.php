<div>
    <div class="p-5 d-none d-md-block">
        <!-- Search & Filter -->
        {{-- resources/views/livewire/admin/attracion-list-manage.blade.php --}}
        <div class="d-flex gap-4 mb-4">
            <div class="shadow border rounded flex-grow-1 position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ps-3 text-secondary"></i>
                <input wire:model.live="search" type="text" class="form-control ps-5" placeholder="Cari wahana...">
            </div>

            <div class="shadow border rounded" style="width:200px;">
                <select wire:model.live="filterType" class="form-select border-0">
                    <option value="none">Urutkan</option>
                    <option value="capacity_desc">Kapasitas Terbesar</option>
                    <option value="capacity_asc">Kapasitas Terkecil</option>
                    <option value="time_estimation_desc">Durasi Terlama</option>
                    <option value="time_estimation_asc">Durasi Terpendek</option>
                </select>
            </div>
        </div>


        <!-- Header -->


        <!-- List -->
        <div class="card shadow p-3 mb-4 bg-body-tertiary rounded">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <!-- Kotak hitam inline CSS -->
                    <div style="background:#000; width:4px; height:24px; display:inline-block;"></div>
                    <h3 class="ms-2 mb-0">Daftar Wahana</h3>
                </div>

            </div>
        </div>
        <div class="card w-100 shadow p-3 bg-body-tertiary rounded mb-3">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <!-- Gambar 80x80 dengan object-fit -->
                    <img src="{{ asset('img/info3.jpg') }}" alt="Konser di Pantai Ancol"
                        style="object-fit: cover; width:15vw;" class="rounded-4 me-3">
                    <div class="d-flex flex-column gap-2">
                        <span class="fs-3 card-title mb-0">Wahana Hura Hura</span>
                        <span> Status wahana : Penuh</span>
                    </div>

                </div>
                <div class="d-flex flex-column gap-2">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                        style="width: 8vw; height: 10vh;">
                        <i class="bi bi-pencil-fill fs-3"></i>
                    </button>
                </div>
            </div>
        </div>


    </div>

    <!-- Vertically centered modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-body text-center p-5">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal"></button>
                    <p class="mb-1">Apakah Anda yakin akan menghapus</p>
                    <h5 class="fw-bold mb-4">"Kenapa Harus ke Ancol?"</h5>
                    <div class="d-flex justify-content-center gap-3">

                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                            Aktif
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal"
                            data-bs-target="#perbaikanModal">
                            Perbaikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal 2: Hasil Setelah Delete --}}
    <div class="modal fade" id="perbaikanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-body position-relative text-center p-5">
                    <!-- Close button -->
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal"></button>

                    <!-- Judul -->
                    <p class="mb-1">Berikan Kerusakan yang Harus di Perbaiki di Wahana:</p>
                    <h5 class="fw-bold mb-4">Kura Kura</h5>

                    <!-- Form Deskripsi -->
                    <form class="needs-validation" novalidate>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Deskripsikan Kerusakan"
                                required></textarea>
                            <div class="invalid-feedback">
                                Deskripsi kerusakan tidak boleh kosong.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">
                            Perbaikan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MOBILE VERSION --}}
    <div class="d-block d-md-none p-3">

        {{-- Search --}}
        <div class="mb-3 position-relative">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ps-3 text-secondary"></i>
            <input wire:model="search" type="text" class="form-control ps-5 rounded-3" placeholder="Cari wahana...">
        </div>

        {{-- Dropdown --}}
        <div class="mb-4">
            <select wire:model="filterType" class="form-select rounded-3">
                <option value="none">Urutkan</option>
                <option value="capacity_desc">Kapasitas Terbesar</option>
                <option value="capacity_asc">Kapasitas Terkecil</option>
                <option value="time_estimation_desc">Durasi Terlama</option>
                <option value="time_estimation_asc">Durasi Terpendek</option>
            </select>
        </div>

        {{-- Judul --}}
        <div class="card shadow p-3 mb-4 bg-body-tertiary rounded">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <!-- Kotak hitam inline CSS -->
                    <div style="background:#000; width:4px; height:24px; display:inline-block;"></div>
                    <h3 class="ms-2 mb-0">Daftar Wahana</h3>
                </div>

            </div>
        </div>

        {{-- List --}}
        <div class="card w-100 shadow p-3 bg-body-tertiary rounded mb-3">
            <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between">
                {{-- BAGIAN GAMBAR & TEKS --}}
                <div class="d-flex flex-column flex-md-row align-items-center text-center text-md-start">
                    <!-- Gambar -->
                    <div style="width: 60vw;">
                        <img src="{{ asset('img/info3.jpg') }}" alt="Konser di Pantai Ancol"
                            class="rounded-4 mb-3 mb-md-0 me-md-3" style="object-fit: cover; 
                            width:100%; max-width: 60vw; height:auto;">
                    </div>

                    <!-- Teks -->
                    <div class="d-flex flex-column gap-2">
                        <span class="fs-5 fs-md-3 card-title mb-0">Wahana Hura Hura</span>
                        <span>Status wahana : Penuh</span>
                    </div>
                </div>

                {{-- BAGIAN TOMBOL --}}
                <div class="mt-3 mt-md-0">
                    <button class="btn btn-warning w-100 w-md-auto" data-bs-toggle="modal"
                        data-bs-target="#deleteConfirmationModal" style="max-width: 120px; height: 50px;">
                        <i class="bi bi-pencil-fill fs-4"></i>
                    </button>
                </div>
            </div>



        </div>

    </div>