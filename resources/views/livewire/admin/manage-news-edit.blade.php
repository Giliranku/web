@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
@endpush

<div class="container mt-4 p-4 shadow rounded bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            <span class="border-start border-warning border-4 ps-2">Edit Berita</span>
        </h4>
        <a href="{{ route('news.index') }}" class="btn-close" aria-label="Close"></a>
    </div>

    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="row g-4 d-flex align-items-center">
            <!-- Kiri: Gambar -->
            <div class="col-md-4 text-center">
                <label for="news_cover">
                    <div class="position-relative border rounded-circle d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                         style="width: 200px; height: 200px; background-color: #f8f8f8; cursor: pointer;">
                        @if ($news_cover)
                            <img src="{{ $news_cover->temporaryUrl() }}" alt="Preview" class="img-fluid" style="width: 100%; height: 100%; object-fit: contain;">
                        @else
                            <img src="{{ asset('storage/' . $oldCover) }}" alt="Preview" class="img-fluid" style="width: 100%; height: 100%; object-fit: contain;">
                        @endif
                    </div>
                </label>
                <input type="file" wire:model="news_cover" id="news_cover" class="d-none" accept="image/*">

                <div class="mt-2 text-end pe-4">
                    <i class="bi bi-pencil-square text-dark" style="cursor: pointer;"></i>
                </div>

                <p class="fw-semibold mt-3">Gambar Depan</p>
            </div>

            <!-- Kanan: Input -->
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Judul</label>
                    <input type="text" class="form-control" id="title" wire:model.defer="title">
                    @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="author_name" class="form-label fw-semibold">Nama Penulis</label>
                    <input type="text" class="form-control" id="author_name" wire:model.defer="author_name">
                    @error('author_name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="keywords" class="form-label fw-semibold">Kata Kunci</label>
                    <input type="text" class="form-control" id="keywords" wire:model.defer="keywords">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control" id="description" rows="3" wire:model.defer="description"></textarea>
                </div>

                <div class="mb-4" wire:ignore>
                    <label for="content" class="form-label fw-semibold">Isi Berita</label>
                    <input id="content" type="hidden" name="content" value="{{ $content }}">
                    <trix-editor input="content"></trix-editor>
                    @error('content') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
        </div>
    </form>
</div>

@push('scripts')
    <script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script>
        document.addEventListener("trix-change", function (event) {
            @this.set('content', event.target.value);
        });
    </script>
@endpush
