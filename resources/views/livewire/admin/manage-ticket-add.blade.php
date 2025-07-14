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
            <form>
                <div class="row mb-4 d-flex align-items-center">
                    <!-- Gambar Upload -->
                    <div class="col-md-4 text-center">
                        <label for="gambar">
                            <div class="border rounded-circle d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                                style="width: 200px; height: 200px; cursor: pointer; background-color: #f9f9f9;">
                                <img id="preview" src="#" alt="Preview" class="img-fluid d-none" style="object-fit: cover; width: 100%; height: 100%;">
                                <i class="bi bi-camera fs-1 text-muted" id="camera-icon"></i>
                            </div>
                        </label>
                        <input type="file" class="d-none" id="gambar" name="gambar">
                    </div>

                    <!-- Input Fields -->
                    <div class="col-md-8">
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama">
                        </div>

                        <div class="row">
                            <!-- Harga Awal -->
                            <div class="col">
                                <label for="harga_awal" class="form-label fw-semibold">Harga Awal</label>
                                <input type="number" class="form-control" id="harga_awal" placeholder="Harga Awal">
                            </div>

                            <!-- Harga Promo -->
                            <div class="col">
                                <label for="harga_promo" class="form-label fw-semibold">Harga Promo</label>
                                <input type="number" class="form-control" id="harga_promo" placeholder="Harga Promo">
                            </div>
                        </div>

                        <!-- Syarat & Ketentuan -->
                        <div class="mb-3 mt-3">
                            <label for="syarat" class="form-label fw-semibold">Syarat & Ketentuan Tiket</label>
                            <textarea class="form-control" id="syarat" rows="3" placeholder="Syarat & Ketentuan Tiket"></textarea>
                        </div>

                        <!-- Cara Menggunakan -->
                        <div class="mb-4">
                            <label for="cara" class="form-label fw-semibold">Cara Menggunakan Tiket</label>
                            <textarea class="form-control" id="cara" rows="3" placeholder="Cara Menggunakan Tiket"></textarea>
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

@push('scripts')
<script src="{{ asset('js/adminticket.js') }}"></script>
@endpush