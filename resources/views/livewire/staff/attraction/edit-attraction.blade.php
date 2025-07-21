@push('styles')
@vite(['resources/css/jesselyn.css', 'resources/css/sorting.css'])
<style>
    :root {
        --primary-color: #4ABDAC;
        --secondary-color: #FC4A1A;
        --warning-color: #F7B733;
        --text-dark: #2c3e50;
        --text-light: #6c757d;
        --border-light: #e9ecef;
        --bg-light: #f8f9fa;
        --white: #ffffff;
        --shadow: 0 2px 8px rgba(0,0,0,0.08);
        --radius: 8px;
    }

    .container-fluid {
        background-color: var(--bg-light);
        min-height: 100vh;
        font-family: 'Inclusive Sans', Arial, sans-serif;
        padding: 2rem 1rem;
    }

    .card {
        border: 1px solid var(--border-light);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        background: var(--white);
        transition: box-shadow 0.2s ease;
    }
    
    .card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }
    
    .card-header {
        background: var(--white);
        border-bottom: 1px solid var(--border-light);
        padding: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .form-control, .form-select {
        border: 1px solid var(--border-light);
        border-radius: var(--radius);
        padding: 0.75rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        font-family: 'Inclusive Sans', Arial, sans-serif;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(74, 189, 172, 0.1);
        outline: none;
    }
    
    .form-label {
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        font-family: 'Inclusive Sans', Arial, sans-serif;
    }
    
    .form-label i {
        margin-right: 0.5rem;
        color: var(--primary-color);
        font-size: 0.9rem;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border: 1px solid var(--primary-color);
        border-radius: var(--radius);
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
        font-family: 'Inclusive Sans', Arial, sans-serif;
    }
    
    .btn-primary:hover {
        background-color: #3a9b8e;
        border-color: #3a9b8e;
        transform: translateY(-1px);
    }
    
    .btn-secondary {
        background-color: var(--text-light);
        border: 1px solid var(--text-light);
        border-radius: var(--radius);
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
        font-family: 'Inclusive Sans', Arial, sans-serif;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #5a6268;
        transform: translateY(-1px);
    }
    
    /* Minimalist Upload Zone */
    .upload-zone {
        border: 2px dashed var(--border-light);
        border-radius: var(--radius);
        padding: 2rem;
        text-align: center;
        transition: all 0.2s ease;
        background: var(--white);
        cursor: pointer;
        position: relative;
        min-height: 120px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .upload-zone.dragover {
        border-color: var(--primary-color);
        background-color: rgba(74, 189, 172, 0.05);
    }
    
    .upload-zone:hover {
        border-color: var(--primary-color);
        background-color: rgba(74, 189, 172, 0.02);
    }
    
    .upload-zone input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        top: 0;
        left: 0;
    }
    
    .upload-content {
        pointer-events: none;
        color: var(--text-light);
    }
    
    .upload-icon {
        font-size: 2rem;
        color: var(--text-light);
        margin-bottom: 0.5rem;
    }
    
    /* Image Preview Styles */
    .current-image {
        position: relative;
        display: inline-block;
        border-radius: var(--radius);
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    
    .current-image:hover {
        transform: scale(1.02);
    }
    
    .current-image img {
        border-radius: var(--radius);
        transition: opacity 0.2s ease;
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
        transition: opacity 0.2s ease;
        border-radius: var(--radius);
    }
    
    .current-image:hover .image-overlay {
        opacity: 1;
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
        border-radius: var(--radius);
    }
    
    .close-modal {
        position: absolute;
        top: 10px;
        right: 15px;
        color: var(--text-dark);
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
        transition: all 0.2s ease;
    }
    
    .close-modal:hover {
        background-color: var(--bg-light);
        transform: scale(1.1);
    }
    
    .upload-text {
        color: var(--text-light);
        font-weight: 500;
        margin-bottom: 0.25rem;
    }
    
    .upload-hint {
        color: var(--text-light);
        font-size: 0.85rem;
        opacity: 0.8;
    }
    
    /* Alert Styles */
    .alert {
        border-radius: var(--radius);
        padding: 1rem;
        margin-bottom: 1.5rem;
        border: 1px solid transparent;
    }
    
    .alert-success {
        background-color: rgba(74, 189, 172, 0.1);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .alert-danger {
        background-color: rgba(252, 74, 26, 0.1);
        border-color: var(--secondary-color);
        color: var(--secondary-color);
    }
    
    /* Loading Animation */
    @keyframes loading {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    [wire\\:loading] .bi-hourglass-split {
        animation: loading 1s linear infinite;
    }
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }
    
    .upload-hint {
        font-size: 0.8rem;
        color: var(--text-light);
    }
    
    /* Clean Image Preview */
    .image-preview {
        max-width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: var(--radius);
        border: 1px solid var(--border-light);
    }
    
    .current-image {
        position: relative;
        display: inline-block;
        border-radius: var(--radius);
        overflow: hidden;
    }
    
    .current-image img {
        border-radius: var(--radius);
    }
    
    /* Simple Page Header */
    .page-header {
        background: var(--white);
        border: 1px solid var(--border-light);
        border-radius: var(--radius);
        padding: 2rem;
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .page-title {
        color: var(--text-dark);
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1.75rem;
    }
    
    .page-subtitle {
        color: var(--text-light);
        margin-bottom: 1rem;
    }
    
    /* Clean Alerts */
    .alert {
        border: none;
        border-radius: var(--radius);
        padding: 1rem;
        margin-bottom: 1rem;
        font-weight: 500;
        font-family: 'Inclusive Sans', Arial, sans-serif;
    }
    
    .alert-success {
        background-color: rgba(74, 189, 172, 0.1);
        color: #2d5a52;
        border-left: 3px solid var(--primary-color);
    }
    
    .alert-danger {
        background-color: rgba(252, 74, 26, 0.1);
        color: #8b2635;
        border-left: 3px solid var(--secondary-color);
    }
    
    /* Loading State */
    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 1rem 0.5rem;
        }
        
        .upload-zone {
            min-height: 100px;
            padding: 1.5rem;
        }
        
        .page-header {
            padding: 1.5rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
            <i class="bi bi-stars me-2"></i>Edit Wahana
        </h1>
        <p class="page-subtitle">Perbarui informasi wahana yang Anda kelola</p>
        <a href="/staff/attraction/dashboard" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
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

    <form wire:submit.prevent="updateAttraction">
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
                                    <i class="bi bi-stars me-1"></i>Nama Wahana
                                </label>
                                <input type="text" class="form-control" id="name" wire:model="name" placeholder="Masukkan nama wahana">
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
                                <input type="text" class="form-control" id="category" wire:model="category" placeholder="Kategori wahana">
                                @error('category') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="bi bi-card-text me-1"></i>Deskripsi
                            </label>
                            <textarea class="form-control" id="description" rows="4" wire:model="description" placeholder="Deskripsi wahana..."></textarea>
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

        <!-- Modern Image Upload Section -->
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
                                <h6 class="mb-3" style="color: var(--primary-color); font-weight: 600;">
                                    <i class="bi bi-card-image me-2"></i>Cover Image
                                </h6>
                                
                                <div class="upload-zone" id="coverDropZone">
                                    <input type="file" id="coverInput" class="d-none" wire:model="newCover" accept="image/*">
                                    
                                    @if($newCover)
                                        <img src="{{ $newCover->temporaryUrl() }}" style="max-width: 100%; max-height: 200px; border-radius: var(--radius);">
                                        <div class="mt-2 text-success">
                                            <i class="bi bi-check-circle me-1"></i>File siap diupload
                                        </div>
                                    @else
                                        <div class="upload-content">
                                            <div class="upload-icon">
                                                <i class="bi bi-cloud-upload"></i>
                                            </div>
                                            <div class="upload-text">Drag & Drop atau Klik untuk Upload</div>
                                            <div class="upload-hint">JPG, JPEG, PNG, WEBP • Max 2MB</div>
                                        </div>
                                    @endif
                                </div>
                                @error('newCover') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                            </div>

                            <!-- Gallery Images -->
                            <div class="col-lg-6">
                                <h6 class="mb-3" style="color: var(--primary-color); font-weight: 600;">
                                    <i class="bi bi-images me-2"></i>Gallery Images
                                </h6>
                                
                                <div class="row">
                                    @foreach(['newImg1', 'newImg2', 'newImg3'] as $index => $newImg)
                                        <div class="col-4 mb-3">
                                            <div class="upload-zone" style="min-height: 130px; padding: 15px;" id="galleryDropZone{{ $index }}">
                                                <input type="file" id="galleryInput{{ $index }}" class="d-none" wire:model="{{ $newImg }}" accept="image/*">
                                                
                                                @if($$newImg)
                                                    <img src="{{ ($$newImg)->temporaryUrl() }}" style="max-width: 100%; max-height: 80px; border-radius: var(--radius);">
                                                @else
                                                    <div class="upload-content">
                                                        <div class="upload-icon" style="font-size: 1.5rem;">
                                                            <i class="bi bi-plus-circle"></i>
                                                        </div>
                                                        <div class="upload-text" style="font-size: 0.8rem;">Image {{ $index + 1 }}</div>
                                                        <div class="upload-hint" style="font-size: 0.7rem;">Opsional</div>
                                                    </div>
                                                @endif
                                            </div>
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
                            
                            <a href="/staff/attraction/dashboard" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
