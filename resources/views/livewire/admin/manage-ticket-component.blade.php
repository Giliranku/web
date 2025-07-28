@push('styles')
@vite([
    'resources/css/jesselyn.css',
    'resources/css/sorting.css',
])
@endpush

<div class="p-5">
    <div class="d-flex gap-sm-5 flex-sm-row flex-column gap-1">
        <div class="search-container shadow search-bar-sorting border rounded mb-3">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="form-control search-input height-custom" placeholder="Cari">
        </div>

        {{-- Dropdown --}}
        <div 
            x-data="{
                open: false,
                selected: @entangle('filterLocation'),
                options: [
                    'Semua',
                    'Ancol',
                    'Dufan Ancol',
                    'Sea World Ancol',
                    'Atlantis Ancol',
                    'Samudra Ancol',
                    'Putri Duyung Ancol',
                    'Jakarta Bird Land Ancol'
                ],
                select(option) {
                    this.selected = option;
                    this.open = false;
                    $wire.set('filterLocation', option);
                }
            }"
            class="position-relative shadow border rounded bg-body-secondary custom-input-sort flex-grow-1 flex-md-grow-0 height-custom"
            @click.outside="open = false"
        >

            <!-- Label -->
            <div class="dropdown-label">Destinasi</div>

            <!-- Trigger -->
            <div class="custom-dropdown" @click="open = !open">
                <span x-text="selected" style="font-size: 1rem;"></span>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>

            <!-- Dropdown Options -->
            <div class="dropdown-list bg-body-secondary" x-show="open" x-transition>
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
                <h3 class="card-title ms-2">
                    <i class="fas fa-ticket-alt me-2"></i>
                    Daftar Tiket
                </h3>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary">
                    <i class="fas fa-list me-1"></i>
                    {{ $tickets->count() }} Total Tiket
                </span>
                <a href="{{ route('admin.ticket.create') }}" class="text-decoration-none btn btn-primary mt-sm-0 mt-2">
                    <i class="fas fa-plus me-2"></i>Tambah Tiket
                </a>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column gap-3">
        <div class="d-flex flex-column gap-3">
            @forelse($tickets as $ticket)
                <div class="card w-100 shadow p-sm-3 p-1 bg-body-tertiary rounded">
                    <div class="card-body d-flex align-items-center justify-content-between flex-sm-row flex-column">
                        <div class="d-flex align-items-center flex-sm-row flex-column">
                            <img src="{{ asset('storage/' . $ticket->logo) }}" class="card-img-top rounded" style="width: 100px;" alt="{{ $ticket->name }}">
                            <div class="ms-4">
                                <h5 class="card-title mt-3">{{ $ticket->name }}</h5>

                                {{-- Conditional Price Display --}}
                                @if(!is_null($ticket->price) && $ticket->price < $ticket->price_before)
                                    <div class="d-flex align-items-baseline gap-2">
                                        <span class="fw-bolder m-0">Harga : </span>Rp {{ number_format($ticket->price, 0, ',', '.') }}
                                        <span class="text-decoration-line-through opacity-50">Rp {{ number_format($ticket->price_before, 0, ',', '.') }}</span>
                                    </div>
                                @else
                                    <p><span class="fw-bolder m-0">Harga : </span>Rp {{ number_format($ticket->price_before, 0, ',', '.') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex flex-sm-column flex-row gap-3">
                            <div>
                                <a href="{{ route('admin.ticket.edit', $ticket->id) }}" class="text-decoration-none me-auto btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <div>
                                <button class="btn btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#delete"
                                        wire:click="confirmDelete({{ $ticket->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted mt-5">
                    <i class="fas fa-exclamation-circle me-2"></i> Tidak ada tiket ditemukan.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Vertically centered modal -->
    <div wire:ignore.self class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-body text-center p-5">
                    <!-- Tombol close -->
                    <button type="button" class="btn position-absolute top-0 end-0 m-3 p-0"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fs-5"></i>
                    </button>

                    <p class="mb-1">Apakah Anda yakin akan menghapus</p>

                    @php
                        $selectedTicket = $tickets->firstWhere('id', $deleteId ?? null);
                    @endphp

                    <h5 class="fw-bold mb-5 mt-2">
                        "{{ $selectedTicket?->name ?? 'tiket ini' }}"
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
