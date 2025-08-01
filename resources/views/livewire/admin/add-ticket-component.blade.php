@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
@endpush

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-100 h-100" style="max-width: 1400px;">
        <div class="modal-content p-4 shadow rounded">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                    <span class="border-start border-warning border-4 ps-2">
                        <i class="fas fa-plus me-2"></i>Tambahkan Tiket
                    </span>
                </h5>
                <a href="{{ route('admin.ticket.index') }}" class="btn-close"></a>
            </div>
            <!-- Form -->
            <form wire:submit="save" enctype="multipart/form-data">
                <div class="row mb-4 d-flex align-items-center">
                    <!-- Gambar Upload -->
                    <div class="col-md-4 text-center position-relative">
                        <label for="gambar">
                            <div class="border rounded-circle d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                                style="width: 200px; height: 200px; cursor: pointer; background-color: #f9f9f9;">
                                @if ($logo)
                                    <img src="{{ $logo->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: contain; width: 100%; height: 100%;">
                                @else
                                    <i class="fas fa-camera fs-1 text-muted"></i>
                                @endif
                            </div>
                        </label>

                        <!-- Tombol edit (ikon) di luar lingkaran -->
                        <button type="button"
                            class="btn btn-light p-1 position-absolute"
                            style="bottom: -5px; right: 50px;"
                            onclick="document.getElementById('gambar').click()"
                            title="Unggah logo">
                            <i class="fas fa-edit  fs-5"></i>
                        </button>

                        <input type="file" wire:model="logo" class="d-none" id="gambar" accept="image/*">
                        @error('logo')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror

                        <p class="fw-semibold mt-3">Gambar Logo</p>
                    </div>

                    <!-- Input Fields -->
                    <div class="col-md-8">
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama</label>
                            <div class="position-relative">
                                <input type="text" wire:model="name" class="form-control pe-5" id="nama" placeholder="Nama">
                                <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon" data-target="nama">
                                    <i class="fas fa-edit text-muted"></i>
                                </button>
                            </div>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="row">
                            <!-- Harga Awal -->
                            <div class="col">
                                <label for="harga_awal" class="form-label fw-semibold">Harga Awal</label>
                                <div class="position-relative">
                                    <input type="number" wire:model="price_before" class="form-control pe-5" id="harga_awal" placeholder="Harga Awal">
                                    <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon" data-target="harga_awal">
                                        <i class="fas fa-edit text-muted"></i>
                                    </button>
                                </div>
                                @error('price_before') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Harga Promo -->
                            <div class="col">
                                <label for="harga_promo" class="form-label fw-semibold">Harga Promo</label>
                                <div class="position-relative">
                                    <input type="number" wire:model="price" class="form-control pe-5" id="harga_promo" placeholder="Harga Promo">
                                    <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon" data-target="harga_promo">
                                        <i class="fas fa-edit text-muted"></i>
                                    </button>
                                </div>
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Fast Pass Settings -->
                        <div class="mb-3 mt-3">
                            <div class="card border-0" style="background: linear-gradient(135deg, rgba(252, 74, 26, 0.1), rgba(247, 183, 51, 0.1));">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-bolt text-warning me-2"></i>
                                        <h6 class="mb-0 fw-bold">Pengaturan Fast Pass</h6>
                                    </div>
                                    
                                    <!-- Ticket Type -->
                                    <div class="mb-3">
                                        <label for="ticket_type" class="form-label fw-semibold">Jenis Tiket</label>
                                        <select wire:model.live="ticket_type" id="ticket_type" class="form-select">
                                            <option value="regular">Regular</option>
                                            <option value="fast_pass">Fast Pass</option>
                                        </select>
                                        @error('ticket_type') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Fast Pass Price Multiplier (only show for fast_pass) -->
                                    @if($ticket_type === 'fast_pass')
                                        <div class="mb-3">
                                            <label for="fast_pass_price_multiplier" class="form-label fw-semibold">
                                                Pengali Harga Fast Pass
                                                <small class="text-muted">(mis: 1.5 untuk 50% lebih mahal)</small>
                                            </label>
                                            <div class="position-relative">
                                                <input type="number" step="0.1" min="1" wire:model="fast_pass_price_multiplier" 
                                                       class="form-control pe-5" id="fast_pass_price_multiplier" 
                                                       placeholder="Contoh: 1.5">
                                                <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon" data-target="fast_pass_price_multiplier">
                                                    <i class="fas fa-edit text-muted"></i>
                                                </button>
                                            </div>
                                            @error('fast_pass_price_multiplier') <span class="text-danger">{{ $message }}</span> @enderror
                                            
                                            @if($fast_pass_price_multiplier && $price)
                                                <div class="alert alert-info mt-2 py-2">
                                                    <small>
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Harga Fast Pass: Rp {{ number_format($price * $fast_pass_price_multiplier, 0, ',', '.') }}
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="mb-3 mt-3">
                            <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                            <select wire:model="location" id="lokasi" class="form-select">
                                <option value="">-- Pilih Lokasi --</option>
                                <option value="Ancol">Ancol</option>
                                <option value="Dufan Ancol">Dufan Ancol</option>
                                <option value="Sea World Ancol">Sea World Ancol</option>
                                <option value="Atlantis Ancol">Atlantis Ancol</option>
                                <option value="Samudra Ancol">Samudra Ancol</option>
                                <option value="Putri Duyung Ancol">Putri Duyung Ancol</option>
                                <option value="Jakarta Bird Land Ancol">Jakarta Bird Land Ancol</option>
                            </select>
                            @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Syarat & Ketentuan -->
                        <div class="mb-3 mt-3">
                            <label for="syarat" class="form-label fw-semibold">Syarat & Ketentuan Tiket</label>
                            <div class="position-relative">
                                <textarea wire:model="terms_and_conditions" class="form-control pe-5" id="syarat" rows="3" placeholder="Syarat & Ketentuan Tiket"></textarea>
                                <button type="button" class="btn position-absolute top-0 end-0 mt-2 me-2 p-0 border-0 bg-transparent edit-icon" data-target="syarat">
                                    <i class="fas fa-edit text-muted"></i>
                                </button>
                            </div>
                            @error('terms_and_conditions') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Cara Menggunakan -->
                        <div class="mb-4">
                            <label for="cara" class="form-label fw-semibold">Cara Menggunakan Tiket</label>
                            <div class="position-relative">
                                <textarea wire:model="usage" class="form-control pe-5" id="cara" rows="3" placeholder="Cara Menggunakan Tiket"></textarea>
                                <button type="button" class="btn position-absolute top-0 end-0 mt-2 me-2 p-0 border-0 bg-transparent edit-icon" data-target="cara">
                                    <i class="fas fa-edit text-muted"></i>
                                </button>
                            </div>
                            @error('usage') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Simpan Tiket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script: Fokus ke input saat ikon diklik -->
@push('scripts')
<script>
    document.addEventListener('livewire:navigated', () => {
        document.querySelectorAll('.edit-icon').forEach(icon => {
            icon.addEventListener('click', () => {
                const targetId = icon.getAttribute('data-target');
                const targetEl = document.getElementById(targetId);
                if (targetEl) {
                    targetEl.focus();
                }
            });
        });
    });
</script>
@endpush
