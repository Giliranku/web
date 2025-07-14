<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-100 h-100" style="max-width: 1400px;">
        <div class="modal-content p-4 shadow rounded">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                    <span class="border-start border-warning border-4 ps-2">Tambahkan Tiket</span>
                </h5>
                <a href="{{ url('/manage-ticket') }}" class="btn-close"></a>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="save" enctype="multipart/form-data">
                <div class="row mb-4 d-flex align-items-center">
                    <!-- Gambar Upload -->
                    <div class="col-md-4 text-center position-relative">
                        <label for="gambar">
                            <div class="border rounded-circle d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                                style="width: 200px; height: 200px; cursor: pointer; background-color: #f9f9f9;">
                                @if ($logo)
                                    <img src="{{ $logo->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: contain; width: 100%; height: 100%;">
                                @else
                                    <i class="bi bi-camera fs-1 text-muted"></i>
                                @endif
                            </div>
                        </label>

                        <!-- Tombol edit (ikon) di luar lingkaran -->
                        <button type="button"
                            class="btn btn-light p-1 position-absolute"
                            style="bottom: -5px; right: 50px;"
                            onclick="document.getElementById('gambar').click()"
                            title="Unggah logo">
                            <i class="bi bi-pencil-square text-dark fs-5"></i>
                        </button>

                        <input type="file" wire:model="logo" class="d-none" id="gambar" accept="image/*">
                        @error('logo')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Fields -->
                    <div class="col-md-8">
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama</label>
                            <input type="text" wire:model="name" class="form-control" id="nama" placeholder="Nama">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="row">
                            <!-- Harga Awal -->
                            <div class="col">
                                <label for="harga_awal" class="form-label fw-semibold">Harga Awal</label>
                                <input type="number" wire:model="price_before" class="form-control" id="harga_awal" placeholder="Harga Awal">
                                @error('price_before') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Harga Promo -->
                            <div class="col">
                                <label for="harga_promo" class="form-label fw-semibold">Harga Promo</label>
                                <input type="number" wire:model="price" class="form-control" id="harga_promo" placeholder="Harga Promo">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Syarat & Ketentuan -->
                        <div class="mb-3 mt-3">
                            <label for="syarat" class="form-label fw-semibold">Syarat & Ketentuan Tiket</label>
                            <textarea wire:model="terms_and_conditions" class="form-control" id="syarat" rows="3" placeholder="Syarat & Ketentuan Tiket"></textarea>
                            @error('terms_and_conditions') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Cara Menggunakan -->
                        <div class="mb-4">
                            <label for="cara" class="form-label fw-semibold">Cara Menggunakan Tiket</label>
                            <textarea wire:model="usage" class="form-control" id="cara" rows="3" placeholder="Cara Menggunakan Tiket"></textarea>
                            @error('usage') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary w-100">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
