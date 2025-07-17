@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
@endpush

<div class="container mt-4 p-4 shadow rounded bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            <span class="border-start border-warning border-4 ps-2">Tambahkan Berita</span>
        </h4>
        <button class="btn-close" aria-label="Close"></button>
    </div>

    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4 d-flex align-items-center">
            <!-- Kiri: Gambar -->
            <div class="col-md-4 text-center">
                <label for="news_cover">
                    <div class="position-relative border rounded-circle d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                        style="width: 200px; height: 200px; background-color: #f8f8f8; cursor: pointer;">
                        <i class="bi bi-camera fs-1 text-muted"></i>
                    </div>
                </label>
                <input type="file" name="news_cover" id="news_cover" class="d-none" accept="image/*">

                <!-- Icon edit luar lingkaran -->
                <div class="mt-2 text-end pe-4">
                    <i class="bi bi-pencil-square text-dark" style="cursor: pointer;"></i>
                </div>

                <p class="fw-semibold mt-3">Gambar Depan</p>
            </div>

            <!-- Kanan: Input -->
            <div class="col-md-8">
                <!-- Judul -->
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Judul</label>
                    <div class="position-relative">
                        <input type="text" class="form-control pe-5" id="title" name="title" placeholder="Judul">
                        <button type="button"
                                class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon"
                                data-target="title">
                            <i class="bi bi-pencil-square text-muted"></i>
                        </button>
                    </div>
                </div>

                <!-- Penulis -->
                <div class="mb-3">
                    <label for="author" class="form-label fw-semibold">Nama Penulis</label>
                    <div class="position-relative">
                        <input type="text" class="form-control pe-5" id="author" name="author" placeholder="Nama Penulis">
                        <button type="button"
                                class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon"
                                data-target="author">
                            <i class="bi bi-pencil-square text-muted"></i>
                        </button>
                    </div>
                </div>

                <!-- Kata Kunci -->
                <div class="mb-3">
                    <label for="keywords" class="form-label fw-semibold">Kata Kunci</label>
                    <div class="position-relative">
                        <input type="text" class="form-control pe-5" id="keywords" name="keywords" placeholder="Kata kunci">
                        <button type="button"
                                class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon"
                                data-target="keywords">
                            <i class="bi bi-pencil-square text-muted"></i>
                        </button>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi</label>
                    <div class="position-relative">
                        <textarea class="form-control pe-5" id="description" name="description" rows="3" placeholder="Tulis deskripsi..."></textarea>
                        <button type="button"
                                class="btn position-absolute top-0 end-0 mt-2 me-2 p-0 border-0 bg-transparent edit-icon"
                                data-target="description">
                            <i class="bi bi-pencil-square text-muted"></i>
                        </button>
                    </div>
                </div>

                <!-- Isi Berita (Trix Editor) -->
                <div class="mb-4">
                    <label for="content" class="form-label fw-semibold">Isi Berita</label>
                    <input id="content" type="hidden" name="content">
                    <trix-editor input="content"
                        style="height: 150px; overflow-x: auto; overflow-y: auto; white-space: nowrap;"></trix-editor>
                </div>
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary w-100">Kirim</button>
        </div>
    </form>
</div>

@push('scripts')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.edit-icon').forEach(icon => {
                icon.addEventListener('click', () => {
                    const targetId = icon.getAttribute('data-target');
                    const targetInput = document.getElementById(targetId);
                    if (targetInput) {
                        targetInput.focus();
                    }
                });
            });
        });
    </script>
@endpush
