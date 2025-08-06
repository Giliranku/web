@push('styles')
@vite(['resources/css/jesselyn.css', 'resources/css/sorting.css'])
<style>
    :root {
        --primary-color: #4ABDAC;
        --secondary-color: #FC4A1A;
        --warning-color: #F7B733;
        --dark-color: #2c3e50;
        --light-gray: #f8f9fa;
        --border-color: #dee2e6;
        --text-color: #333;
        --shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    body {
        background-color: #ffffff;
        font-family: 'Inclusive Sans', Arial, sans-serif;
        color: var(--text-color);
    }

    .page-header {
        padding: 2rem 0;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: #666;
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .card {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        box-shadow: var(--shadow);
        background: #ffffff;
        margin-bottom: 1.5rem;
    }
    
    .card-header {
        background: var(--light-gray);
        border-bottom: 1px solid var(--border-color);
        font-weight: 600;
        color: var(--dark-color);
        padding: 1rem 1.5rem;
    }
    
    .form-control, .form-select {
        border: 1px solid var(--border-color);
        border-radius: 4px;
        padding: 0.75rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background: #ffffff;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(74, 189, 172, 0.25);
    }
    
    .form-label {
        font-weight: 500;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        transition: all 0.15s ease-in-out;
    }
    
    .btn-primary:hover {
        background-color: #3a9d93;
        border-color: #3a9d93;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        transition: all 0.15s ease-in-out;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .drag-drop-zone {
        border: 2px dashed var(--border-color);
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        background-color: var(--light-gray);
        cursor: pointer;
    }

    .drag-drop-zone.dragover {
        border-color: var(--primary-color);
        background-color: rgba(74, 189, 172, 0.1);
    }
    
    .current-image {
        position: relative;
        display: inline-block;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
    }
    
    .current-image img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    
    .current-image:hover img {
        transform: scale(1.05);
    }
    
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 8px;
    }
    
    .current-image:hover .image-overlay {
        opacity: 1;
    }
    
    .upload-icon {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }
    
    .section-title {
        color: var(--dark-color);
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    /* Image Preview Modal */
    .image-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
    }
    
    .image-modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }
    
    .modal-image {
        max-width: 100%;
        max-height: 80vh;
        border-radius: 8px;
    }
    
    .close-modal {
        position: absolute;
        top: 10px;
        right: 15px;
        color: var(--dark-color);
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        background: none;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .close-modal:hover {
        background-color: #f8f9fa;
        transform: scale(1.1);
    }
    
    .alert {
        border-radius: 4px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
    }
    
    .alert-success {
        background-color: #d1edcc;
        border-color: #badbcc;
        color: #0f5132;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c2c7;
        color: #842029;
    }
    
    .container-fluid {
        background-color: #ffffff;
        min-height: 100vh;
        padding: 1.5rem;
    }
    
    .text-primary {
        color: var(--primary-color) !important;
    }
    
    /* Loading Animation */
    @keyframes loading {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    [wire\\:loading] .bi-hourglass-split {
        animation: loading 1s linear infinite;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .card {
            margin-bottom: 1rem;
        }
        
        .page-header {
            text-align: center;
            padding: 1.5rem 0;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }
</style>

<script>
document.addEventListener('livewire:navigated', function() {
    // Setup drag and drop for file uploads
    setupDragDrop('coverDropZone', 'coverInput');
    for (let i = 0; i < 3; i++) {
        setupDragDrop(`galleryDropZone${i}`, `galleryInput${i}`);
    }
    
    // Setup image preview modal
    setupImagePreview();
    
    function setupDragDrop(dropZoneId, inputId) {
        const dropZone = document.getElementById(dropZoneId);
        const fileInput = document.getElementById(inputId);
        
        if (!dropZone || !fileInput) return;
        
        dropZone.addEventListener('click', () => fileInput.click());
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            dropZone.classList.add('dragover');
        }
        
        function unhighlight(e) {
            dropZone.classList.remove('dragover');
        }
        
        dropZone.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }
    }
    
    function setupImagePreview() {
        // Create modal HTML
        const modal = document.createElement('div');
        modal.className = 'image-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <button class="close-modal">&times;</button>
                <img class="modal-image" src="" alt="Preview">
            </div>
        `;
        document.body.appendChild(modal);
        
        const modalImage = modal.querySelector('.modal-image');
        const closeBtn = modal.querySelector('.close-modal');
        
        // Add click handlers to all current images
        document.addEventListener('click', function(e) {
            const currentImage = e.target.closest('.current-image');
            if (currentImage) {
                const img = currentImage.querySelector('img');
                if (img) {
                    modalImage.src = img.src;
                    modal.classList.add('show');
                }
            }
        });
        
        // Close modal handlers
        closeBtn.addEventListener('click', () => modal.classList.remove('show'));
        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.remove('show');
        });
        
        // ESC key handler
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('show')) {
                modal.classList.remove('show');
            }
        });
    }
});
</script>

@endpush

<div class="container-fluid">
    <!-- Minimalist Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-shop me-2"></i>Edit Restoran
        </h1>
        <p class="page-subtitle">Perbarui informasi restoran yang Anda kelola</p>
    </div>

    <!-- Success/Error Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form wire:submit.prevent="updateRestaurant">
        <div class="row">
            <!-- Basic Information -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-info-circle me-2"></i>Informasi Dasar
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="bi bi-shop me-1"></i>Nama Restaurant
                                </label>
                                <input type="text" class="form-control" id="name" wire:model="name" placeholder="Masukkan nama restaurant">
                                @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">
                                    <i class="bi bi-geo-alt me-1"></i>Lokasi
                                </label>
                                <input type="text" class="form-control" id="location" wire:model="location" placeholder="Masukkan lokasi">
                                @error('location') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="capacity" class="form-label">
                                    <i class="bi bi-people me-1"></i>Kapasitas
                                </label>
                                <input type="number" class="form-control" id="capacity" wire:model="capacity" placeholder="Kapasitas orang">
                                @error('capacity') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="time_estimation" class="form-label">
                                    <i class="bi bi-clock me-1"></i>Estimasi Waktu (menit)
                                </label>
                                <input type="number" class="form-control" id="time_estimation" wire:model="time_estimation" placeholder="Waktu dalam menit">
                                @error('time_estimation') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="category" class="form-label">
                                    <i class="bi bi-tag me-1"></i>Kategori
                                </label>
                                <input type="text" class="form-control" id="category" wire:model="category" placeholder="Kategori restaurant">
                                @error('category') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Queue Management Settings -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="players_per_round" class="form-label">
                                    <i class="bi bi-person-plus me-1"></i>Jumlah Tamu per Giliran
                                </label>
                                <input type="number" class="form-control" id="players_per_round" wire:model="players_per_round" placeholder="1" min="1">
                                @error('players_per_round') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                <div class="form-text">Berapa orang yang bisa dilayani dalam 1 giliran</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estimated_time_per_round" class="form-label">
                                    <i class="bi bi-stopwatch me-1"></i>Waktu per Giliran (menit)
                                </label>
                                <input type="number" class="form-control" id="estimated_time_per_round" wire:model="estimated_time_per_round" placeholder="30" min="1">
                                @error('estimated_time_per_round') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                <div class="form-text">Estimasi waktu untuk 1 giliran makan</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="bi bi-card-text me-1"></i>Deskripsi
                            </label>
                            <textarea class="form-control" id="description" rows="4" wire:model="description" placeholder="Deskripsi restaurant..."></textarea>
                            @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Images -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-images me-2"></i>Gambar Saat Ini
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @if($cover)
                            <div class="mb-3">
                                <label class="form-label">Cover Saat Ini:</label>
                                <div class="current-image">
                                    <img src="{{ asset('img/' . $cover) }}" class="img-fluid rounded">
                                    <div class="image-overlay">
                                        <span><i class="bi bi-eye-fill"></i> Preview</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            @foreach(['img1', 'img2', 'img3'] as $index => $img)
                                @if($$img)
                                    <div class="col-6 mb-2">
                                        <div class="current-image">
                                            <img src="{{ asset('img/' . $$img) }}" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                                            <div class="image-overlay">
                                                <span><i class="bi bi-eye-fill"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Uploads -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-cloud-upload me-2"></i>Upload Gambar Baru
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Cover Image -->
                            <div class="col-lg-6 mb-4">
                                <h6 class="section-title">
                                    <i class="bi bi-card-image me-1"></i>Cover Image
                                </h6>
                                <div class="drag-drop-zone" id="coverDropZone" wire:loading.class="opacity-50" wire:target="newCover">
                                    @if($newCover)
                                        <img src="{{ $newCover->temporaryUrl() }}" alt="Cover Preview" style="max-width: 100%; max-height: 200px; border-radius: 4px;">
                                    @else
                                        <div class="upload-icon">
                                            <i class="bi bi-cloud-upload"></i>
                                        </div>
                                        <p class="mb-1">Drag & drop atau klik untuk upload</p>
                                        <small class="text-muted">JPG, JPEG, PNG, WEBP. Max 2MB</small>
                                    @endif
                                </div>
                                <input type="file" id="coverInput" class="d-none" wire:model="newCover" accept="image/*">
                                @error('newCover') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Gallery Images -->
                            <div class="col-lg-6">
                                <h6 class="section-title">
                                    <i class="bi bi-images me-1"></i>Gallery Images
                                </h6>
                                <div class="row">
                                    @foreach(['newImg1', 'newImg2', 'newImg3'] as $index => $newImg)
                                        <div class="col-4 mb-3">
                                            <div class="drag-drop-zone" style="height: 150px;" id="galleryDropZone{{ $index }}" wire:loading.class="opacity-50" wire:target="{{ $newImg }}">
                                                @if($$newImg)
                                                    <img src="{{ ($$newImg)->temporaryUrl() }}" alt="Preview {{ $index + 1 }}" style="max-width: 100%; max-height: 120px; border-radius: 4px;">
                                                @else
                                                    <div class="upload-icon" style="font-size: 1.5rem;">
                                                        <i class="bi bi-plus-circle"></i>
                                                    </div>
                                                    <small>Image {{ $index + 1 }}</small>
                                                @endif
                                            </div>
                                            <input type="file" id="galleryInput{{ $index }}" class="d-none" wire:model="{{ $newImg }}" accept="image/*">
                                            @error($newImg) <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-center gap-3">
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                                </span>
                                <span wire:loading>
                                    <i class="bi bi-hourglass-split me-2"></i>Menyimpan...
                                </span>
                            </button>
                            
                            <a href="/staff/restaurant/dashboard" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>