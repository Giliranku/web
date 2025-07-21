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
        
        .image-edit-area {
            transition: all 0.3s ease;
            border: 3px dashed #007bff;
            background: #f8f9ff;
        }
        
        .image-edit-area:hover {
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
    </style>
@endpush

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 2rem 0;">
    <div class="main-container p-5" style="max-width: 1100px; width: 100%;">
        <div class="page-header p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <span class="border-start border-primary border-4 ps-3">Edit Berita</span>
                </h4>
                <a href="{{ route('admin.manage-news') }}" class="btn-close" aria-label="Close"></a>
            </div>
        </div>

        <form wire:submit="update" enctype="multipart/form-data">
            <div class="row g-5">
                {{-- Left Column: Image Upload --}}
                <div class="col-lg-4">
                    <div class="form-section">
                        <h6 class="mb-4">Gambar Berita</h6>
                        <label for="news_cover">
                            <div class="upload-placeholder d-flex justify-content-center align-items-center mx-auto image-edit-area"
                                 style="width: 100%; height: 300px; cursor: pointer;">
                                @if ($news_cover)
                                    <div class="image-preview w-100 h-100">
                                        <img src="{{ $news_cover->temporaryUrl() }}" alt="Preview" 
                                             class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                @else
                                    <div class="image-preview w-100 h-100">
                                        <img src="{{ asset('storage/' . $oldCover) }}" alt="Current Image" 
                                             class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                @endif
                            </div>
                        </label>
                        <input type="file" wire:model="news_cover" id="news_cover" class="d-none" accept="image/*">
                        <p class="text-center mt-3 text-muted">Klik untuk mengganti gambar</p>
                        @error('news_cover') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Right Column: Form Fields --}}
                <div class="col-lg-8">
                    <div class="form-section">
                        <h6 class="mb-4">Informasi Berita</h6>
                        
                        <div class="mb-4">
                            <label for="title" class="form-label">Judul Berita</label>
                            <input type="text" class="form-control" id="title" wire:model.defer="title" 
                                   placeholder="Masukkan judul berita...">
                            @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="author_name" class="form-label">Nama Penulis</label>
                            <input type="text" class="form-control" id="author_name" wire:model.defer="author_name" 
                                   placeholder="Masukkan nama penulis...">
                            @error('author_name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="keywords" class="form-label">Kata Kunci</label>
                            <input type="text" class="form-control" id="keywords" wire:model.defer="keywords" 
                                   placeholder="Pisahkan dengan koma...">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Deskripsi Singkat</label>
                            <textarea class="form-control" id="description" rows="4" wire:model.defer="description" 
                                      placeholder="Tulis deskripsi singkat berita..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content Editor Section --}}
            <div class="trix-content" wire:ignore>
                <div class="mb-4">
                    <label for="content" class="form-label">Isi Berita</label>
                    <input id="content" type="hidden" name="content" value="{{ $content }}">
                    <trix-editor input="content"></trix-editor>
                    @error('content') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary px-5 py-3">
                    <i class="bi bi-check-circle me-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trixEditor = document.querySelector('trix-editor');
            const contentInput = document.getElementById('content');

            if (trixEditor && contentInput) {
                // Enhanced Trix Image Upload for Edit
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

                // Sync content with Livewire
                trixEditor.addEventListener('trix-change', function() {
                    const content = trixEditor.innerHTML;
                    contentInput.value = content;
                    @this.set('content', content);
                });
            }
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
