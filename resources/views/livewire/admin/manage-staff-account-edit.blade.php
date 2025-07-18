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
                    <span class="border-start border-warning border-4 ps-2">Edit Staff</span>
                </h5>
                <a href="#" class="btn-close" onclick="history.back()"></a>
            </div>

            <!-- Form -->
            <form id="ticketForm" enctype="multipart/form-data">
                <div class="row mb-4 d-flex align-items-center">
                    <!-- Gambar Upload -->
                    <div class="col-md-4 text-center position-relative">
                        <label for="gambar">
                            <div class="border rounded-circle d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                                 style="width: 200px; height: 200px; cursor: pointer; background-color: #f9f9f9;">
                                <img id="previewImage" class="img-fluid d-none" style="object-fit: contain; width: 100%; height: 100%;" alt="Preview">
                                <i class="bi bi-camera fs-1 text-muted" id="cameraIcon"></i>
                            </div>
                        </label>

                        <!-- Tombol edit -->
                        <button type="button"
                                class="btn btn-light p-1 position-absolute"
                                style="bottom: -5px; right: 50px;"
                                onclick="document.getElementById('gambar').click()"
                                title="Unggah Foto">
                            <i class="bi bi-pencil-square text-dark fs-5"></i>
                        </button>

                        <input type="file"
                               class="d-none"
                               id="gambar"
                               accept="image/*"
                               onchange="previewImage(event)">
                        <p class="fw-semibold mt-3">Foto Profil</p>
                    </div>

                    <!-- Input Fields -->
                    <div class="col-md-8">
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama-lengkap" class="form-label fw-semibold">Nama Lengkap</label>
                            <div class="position-relative">
                                <input type="text" class="form-control pe-5" id="nama-lengkap" placeholder="Nama Lengkap">
                                <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon" data-target="nama-lengkap">
                                    <i class="bi bi-pencil-square text-muted"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="position-relative">
                                <input type="email" class="form-control pe-5" id="email" placeholder="Email">
                                <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon" data-target="email">
                                    <i class="bi bi-pencil-square text-muted"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="mb-3">
                            <label for="nomor" class="form-label fw-semibold">Nomor Telepon</label>
                            <div class="position-relative">
                                <input type="text" class="form-control pe-5" id="nomor" placeholder="Nomor Telepon">
                                <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon" data-target="nomor">
                                    <i class="bi bi-pencil-square text-muted"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Nama Wahana -->
                        <div class="mb-3">
                            <label for="nama-wahana" class="form-label fw-semibold">Nama Wahana</label>
                            <div class="position-relative">
                                <input type="text" class="form-control pe-5" id="nama-wahana" placeholder="Nama Wahana">
                                <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent edit-icon" data-target="nama-wahana">
                                    <i class="bi bi-pencil-square text-muted"></i>
                                </button>
                            </div>
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
<script>
    function previewImage(event) {
        const input = event.target;
        const file = input.files[0];
        const preview = document.getElementById('previewImage');
        const icon = document.getElementById('cameraIcon');

        if (file && preview && icon) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                icon.classList.add('d-none');
            };
            reader.readAsDataURL(file);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Fokus ke input saat icon edit diklik
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
