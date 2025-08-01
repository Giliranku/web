<div>
    <div class="p-5">
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
        <div class="card shadow p-3 mb-4 bg-body-tertiary rounded">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="vertical-line-admin"></div>
                    <h3 class="ms-2 mb-0">Daftar Wahana</h3>
                </div>
                <a href="{{ route('admin.attractions.create') }}" class="btn btn-primary">
                    Tambahkan <i class="bi bi-plus-circle ms-1"></i>
                </a>
            </div>
        </div>

        <!-- List -->
        <div class="d-flex flex-column gap-3 ">
            @foreach($attractions as $atr)
                <div class="card shadow p-3 bg-body-tertiary rounded ">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            @if($atr->cover)
                                <img src="{{ asset('storage/' . $atr->cover) }}" class="rounded me-3"
                                    style="width:200px;height:150px;object-fit:cover;" alt="{{ $atr->name }}">
                            @else
                                <div class="border rounded me-3" style="width:80px;height:80px;"></div>
                            @endif
                            <div class="d-flex justify-content-center flex-column">
                                <span class="fs-4">{{ $atr->name }}</span>
                                <div class="text-muted  ">
                                    <span class="fs-5">Durasi : {{ $atr->time_estimation }} Menit | Kapasitas :
                                        {{ $atr->capacity }}
                                        Orang </span>

                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-3  me-3 flex-column">
                            <a href="{{ route('admin.attractions.edit', $atr) }}" class="btn btn-warning" style="width:75px;">
                                <i class="bi bi-pencil-fill" ;"></i>
                            </a>
                            <button type="button" class="btn btn-danger" wire:click="confirmDelete({{ $atr->id }})"
                                data-bs-toggle="modal" data-bs-target="#deleteConfirmation">
                                <i class="bi bi-trash-fill"></i>
                            </button>


                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div>{{ $attractions->links() }}</div>
        </div>
    </div>




    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmation" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3">
                <div class="modal-body text-center p-4">
                    <h5 class="mb-3">Apakah Anda yakin akan menghapus wahana ini?</h5>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" wire:click="delete()" data-bs-dismiss="modal">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>