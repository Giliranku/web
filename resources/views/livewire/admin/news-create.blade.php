@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .main-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
        }
        
        .image-upload-container {
            transition: all 0.3s ease;
            border: 3px dashed #007bff;
            background: #f8f9ff;
        }
        
        .image-upload-container:hover {
            transform: scale(1.02);
            border-color: #0056b3;
            background: #e3f2fd;
        }
        
        .form-control {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .edit-icon {
            transition: all 0.3s ease;
        }
        
        .edit-icon:hover {
            color: #007bff !important;
            transform: scale(1.1);
        }
        
        .btn-primary {
            background: #007bff;
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }
        
        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
        }
        
        .page-header {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
        }
        
        .trix-editor {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            min-height: 400px;
            padding: 1.5rem;
            font-size: 1rem;
            line-height: 1.6;
            transition: border-color 0.3s ease;
        }
        
        .trix-editor:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .trix-button-group {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .image-preview {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
        }
        
        .image-preview img {
            transition: transform 0.3s ease;
        }
        
        .image-preview:hover img {
            transform: scale(1.05);
        }
        
        .upload-placeholder {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 3px dashed #007bff;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .upload-placeholder:hover {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            transform: scale(1.02);
        }
        
        .form-section {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .trix-content {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush
<div>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 2rem 0;">
    <div class="main-container p-5" style="max-width: 1100px; width: 100%;">
        <div class="page-header p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <span class="border-start border-primary border-4 ps-3">Tambahkan Berita Baru</span>
                </h4>
                <a href="news.create" class="btn-close"></a>
            </div>
        </div>
    
        <form id="newsForm" wire:submit="store" enctype="multipart/form-data">
            <div class="row g-5">
                {{-- Left Column: Image Upload --}}
                <div class="col-lg-4">
                    <div class="form-section">
                        <h6 class="mb-4">Gambar Berita</h6>
                        <label for="news_cover">
                            <div class="upload-placeholder d-flex justify-content-center align-items-center mx-auto image-upload-container"
                                 style="width: 100%; height: 300px; cursor: pointer;">
                                @if ($news_cover)
                                    <div class="image-preview w-100 h-100">
                                        <img src="{{ $news_cover->temporaryUrl() }}" alt="Preview" 
                                             class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                @else
                                    <div class="text-center">
                                        <i class="bi bi-cloud-upload fs-1 text-primary mb-3"></i>
                                        <p class="fw-semibold text-muted">Klik untuk upload gambar</p>
                                        <small class="text-muted">PNG, JPG, JPEG (Max 2MB)</small>
                                    </div>
                                @endif
                            </div>
                        </label>
                        <input type="file" wire:model="news_cover" id="news_cover" class="d-none" accept="image/*">
                        @error('news_cover') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                    </div>
                </div>
    
                {{-- Right Column: Form Fields --}}
                <div class="col-lg-8">
                    <div class="form-section">
                        <h6 class="mb-4">Informasi Berita</h6>
                        
                        {{-- Title --}}
                        <div class="mb-4">
                            <label for="title" class="form-label">Judul Berita</label>
                            <div class="position-relative">
                                <input type="text" wire:model.lazy="title" class="form-control" 
                                       id="title" placeholder="Masukkan judul berita...">
                                <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-3 p-0 border-0 bg-transparent edit-icon" data-target="title">
                                    <i class="bi bi-pencil-square text-muted"></i>
                                </button>
                            </div>
                            @error('title') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
        
                        {{-- Author --}}
                        <div class="mb-4">
                            <label for="author_name" class="form-label">Nama Penulis</label>
                            <div class="position-relative">
                                <input type="text" wire:model.lazy="author_name" class="form-control" 
                                       id="author_name" placeholder="Masukkan nama penulis...">
                                <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-3 p-0 border-0 bg-transparent edit-icon" data-target="author_name">
                                    <i class="bi bi-pencil-square text-muted"></i>
                                </button>
                            </div>
                            @error('author_name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
        
                        {{-- Keywords --}}
                        <div class="mb-4">
                            <label for="keywords" class="form-label">Kata Kunci</label>
                            <div class="position-relative">
                                <input type="text" wire:model.lazy="keywords" class="form-control" 
                                       id="keywords" placeholder="Pisahkan dengan koma...">
                                <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-3 p-0 border-0 bg-transparent edit-icon" data-target="keywords">
                                    <i class="bi bi-pencil-square text-muted"></i>
                                </button>
                            </div>
                            @error('keywords') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- Category --}}
                        <div class="mb-4">
                            <label for="category" class="form-label">Kategori Berita</label>
                            <div class="position-relative">
                                <select wire:model.lazy="category" class="form-control" id="category">
                                    <option value="">Pilih Kategori</option>
                                    <option value="info">Info Giliranku</option>
                                    <option value="promo">Promo Spesial</option>
                                    <option value="kegiatan">Kegiatan Seru</option>
                                    <option value="wahana">Info Wahana</option>
                                </select>
                                <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-3 p-0 border-0 bg-transparent edit-icon" data-target="category">
                                    <i class="bi bi-pencil-square text-muted"></i>
                                </button>
                            </div>
                            @error('category') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
        
                        {{-- Description --}}
                        <div class="mb-4">
                            <label for="description" class="form-label">Deskripsi Singkat</label>
                            <div class="position-relative">
                                <textarea wire:model.lazy="description" class="form-control" 
                                          id="description" rows="4" placeholder="Tulis deskripsi singkat berita..."></textarea>
                                <button type="button" class="btn position-absolute top-0 end-0 mt-3 me-3 p-0 border-0 bg-transparent edit-icon" data-target="description">
                                    <i class="bi bi-pencil-square text-muted"></i>
                                </button>
                            </div>
                            @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content Editor Section --}}
            <div class="trix-content">
                <div class="mb-4">
                    <label class="form-label">Isi Berita</label>
                    <div wire:ignore x-data x-init="
                        $nextTick(() => {
                            const trixInput = document.getElementById('trix_content');
                            const trixEditor = document.querySelector('trix-editor');

                            trixEditor.addEventListener('trix-change', function () {
                                const htmlContent = trixEditor.innerHTML;
                                trixInput.value = htmlContent;
                                window.Livewire.find(trixEditor.closest('[wire\\:id]').getAttribute('wire:id'))
                                    .set('content', htmlContent);
                            });
                        })
                    ">
                        <input id="trix_content" type="hidden" name="content" value="{{ $content }}">
                        <trix-editor input="trix_content"></trix-editor>
                    </div>
                    @error('content') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>
            </div>
    
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary px-5 py-3">
                    <i class="bi bi-send me-2"></i>
                    Publikasikan Berita
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@push('scripts')
<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<script>
    document.addEventListener('livewire:load', () => {
        const trixInput = document.getElementById('trix_content');
        const trixEditor = document.querySelector('trix-editor');

        function syncToLivewire() {
            const htmlContent = trixEditor.innerHTML;
            trixInput.value = htmlContent;

            const componentId = trixEditor.closest('[wire\\:id]')?.getAttribute('wire:id');
            if (componentId && Livewire.find(componentId)) {
                Livewire.find(componentId).set('content', htmlContent);
            }
        }

        // Enhanced Trix Image Upload
        trixEditor.addEventListener('trix-attachment-add', function(event) {
            const attachment = event.attachment;
            const file = attachment.file;
            
            if (file) {
                const formData = new FormData();
                formData.append('file', file);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}');
                
                fetch('/trix/upload', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    attachment.setAttributes({
                        url: data.url,
                        href: data.url
                    });
                })
                .catch(error => {
                    console.error('Error uploading image:', error);
                    attachment.remove();
                    alert('Gagal mengunggah gambar. Silakan coba lagi.');
                });
            }
        });

        trixEditor.addEventListener('trix-change', syncToLivewire);

        const form = document.getElementById('newsForm');
        form.addEventListener('submit', () => syncToLivewire());

        Livewire.hook('element.updated', () => {
            const serverContent = @json($content);
            if (trixEditor && trixInput && serverContent !== trixEditor.innerHTML) {
                trixEditor.editor.loadHTML(serverContent);
                trixInput.value = serverContent;
            }
        });
    });

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

    // Add CSRF token to meta if not exists
    if (!document.querySelector('meta[name="csrf-token"]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = '{{ csrf_token() }}';
        document.head.appendChild(meta);
    }
</script>
@endpush
