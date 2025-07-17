@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
@endpush

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container p-4 shadow rounded bg-white" style="max-width: 900px; width: 100%;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">
                <span class="border-start border-warning border-4 ps-2">Tambahkan Berita</span>
            </h4>
            <a href="{{ url('/manage-news') }}" class="btn-close"></a>
        </div>
    
        <form id="newsForm" wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="row g-4 d-flex align-items-center">
                {{-- Gambar --}}
                <div class="col-md-4 text-center">
                    <label for="news_cover">
                        <div class="position-relative border rounded-circle d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                             style="width: 200px; height: 200px; background-color: #f8f8f8; cursor: pointer;">
                            @if ($news_cover)
                                <img src="{{ $news_cover->temporaryUrl() }}" alt="Preview" class="img-fluid" style="max-height: 100%; max-width: 100%;">
                            @else
                                <i class="bi bi-camera fs-1 text-muted"></i>
                            @endif
                        </div>
                    </label>
                    <input type="file" wire:model="news_cover" id="news_cover" class="d-none" accept="image/*">
                    <p class="fw-semibold mt-3">Gambar Depan</p>
                    @error('news_cover') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
    
                {{-- Inputan --}}
                <div class="col-md-8">
    
                    {{-- Judul --}}
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Judul</label>
                        <div class="position-relative">
                            <input type="text" wire:model.lazy="title" class="form-control pe-5" id="title" placeholder="Judul">
                            <button type="button" class="btn position-absolute top-0 end-0 mt-2 me-2 p-0 border-0 bg-transparent edit-icon" data-target="title">
                                <i class="bi bi-pencil-square text-muted"></i>
                            </button>
                        </div>
                        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
    
                    {{-- Penulis --}}
                    <div class="mb-3">
                        <label for="author_name" class="form-label fw-semibold">Nama Penulis</label>
                        <div class="position-relative">
                            <input type="text" wire:model.lazy="author_name" class="form-control pe-5" id="author_name" placeholder="Nama Penulis">
                            <button type="button" class="btn position-absolute top-0 end-0 mt-2 me-2 p-0 border-0 bg-transparent edit-icon" data-target="author_name">
                                <i class="bi bi-pencil-square text-muted"></i>
                            </button>
                        </div>
                        @error('author_name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
    
                    {{-- Kata Kunci --}}
                    <div class="mb-3">
                        <label for="keywords" class="form-label fw-semibold">Kata Kunci</label>
                        <div class="position-relative">
                            <input type="text" wire:model.lazy="keywords" class="form-control pe-5" id="keywords" placeholder="Kata Kunci">
                            <button type="button" class="btn position-absolute top-0 end-0 mt-2 me-2 p-0 border-0 bg-transparent edit-icon" data-target="keywords">
                                <i class="bi bi-pencil-square text-muted"></i>
                            </button>
                        </div>
                        @error('keywords') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
    
                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Deskripsi</label>
                        <div class="position-relative">
                            <textarea wire:model.lazy="description" class="form-control pe-5" id="description" rows="3" placeholder="Tulis deskripsi..."></textarea>
                            <button type="button" class="btn position-absolute top-0 end-0 mt-2 me-2 p-0 border-0 bg-transparent edit-icon" data-target="description">
                                <i class="bi bi-pencil-square text-muted"></i>
                            </button>
                        </div>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Isi Berita</label>
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
                        {{-- Error HARUS diletakkan DI LUAR wire:ignore --}}
                        @error('content') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>
    
    
                </div>
            </div>
    
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary w-100">Kirim</button>
            </div>
        </form>
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

    document.addEventListener('DOMContentLoaded', () => {
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
