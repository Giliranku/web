@push('styles')
@vite([
'resources/css/jesselyn.css',
'resources/css/sorting.css',
])
<style>
    /* Enhanced responsiveness for manage-news */
    @media (max-width: 576px) {
        .p-5 {
            padding: 1rem !important;
        }
        
        .card-body {
            padding: 1rem !important;
        }
        
        .search-container {
            margin-bottom: 1rem;
        }
        
        .height-custom {
            min-height: 45px;
        }
        
        .custom-input-sort .dropdown-label {
            font-size: 0.75rem;
        }
        
        .btn-sm {
            padding: 0.375rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .modal-dialog {
            margin: 1rem;
        }
        
        .news-image {
            width: 70px !important;
            height: 50px !important;
        }
        
        .card-title {
            font-size: 1rem;
        }
        
        .badge {
            font-size: 0.75rem;
        }
    }
    
    @media (max-width: 768px) {        
        .gap-sm-5 {
            gap: 1rem !important;
        }
        
        .mb-3.mb-md-0 {
            margin-bottom: 1rem !important;
        }
    }
    
    /* News card responsive image */
    .news-image {
        width: 100px;
        height: 80px;
        object-fit: cover;
        border-radius: 0.375rem;
        flex-shrink: 0;
    }
    
    /* Responsive text truncation */
    .card-title {
        word-break: break-word;
        line-height: 1.3;
    }
    
    /* Better button spacing on mobile */
    @media (max-width: 576px) {
        .gap-2 {
            gap: 0.25rem !important;
        }
        
        .btn-sm {
            min-width: 40px;
            justify-content: center;
        }
    }
</style>
@endpush
<div class="p-5">
    <!-- Search and Filter Section -->
    <div class="row mb-3">
        <div class="col-lg-6 col-md-8 col-12 mb-3 mb-md-0">
            <div class="search-container shadow search-bar-sorting border rounded">
                <i class="bi bi-search search-icon"></i>
                <input type="text" wire:model.live="search" class="form-control search-input height-custom" placeholder="Cari berita...">
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <div x-data="{
                open: false,
                selected: @entangle('selectedCategory'),
                select(option) {
                    this.selected = option;
                    this.open = false;
                    $wire.set('selectedCategory', option);
                },
                options: [
                    'Semua Kategori',
                    'Restoran',
                    'Wahana',
                    'Event'
                ]
            }"
            class="position-relative shadow border rounded bg-body-secondary custom-input-sort height-custom"
            @click.outside="open = false">

            <!-- Label -->
            <div class="dropdown-label">Kategori</div>

            <!-- Trigger -->
            <div class="custom-dropdown" @click="open = !open">
                <span x-text="selected" class="text-truncate" style="font-size: 1rem;"></span>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>

            <!-- Dropdown Options -->
            <div class="dropdown-list bg-body-secondary" x-show="open" x-transition>
                <template x-for="option in options" :key="option">
                <div class="dropdown-item" @click="select(option)" x-text="option"></div>
                </template>
            </div>
            </div>
        </div>
    </div>
    <div class="card w-100 shadow p-3 mb-3 mt-4 bg-body-tertiary rounded">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div class="d-flex align-items-center mb-2 mb-sm-0">
                <div class="vertical-line-admin"></div>
                <h3 class="card-title ms-2 mb-0">
                    <i class="fas fa-newspaper me-2"></i>
                    Daftar Berita
                </h3>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary d-none d-md-inline">
                    <i class="fas fa-list me-1"></i>
                    {{ $totalNews }} Total Berita
                </span>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1 d-none d-sm-inline"></i>
                    <span class="d-none d-sm-inline">Tambah Berita</span>
                    <i class="bi bi-plus-circle d-sm-none"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse($newsList as $news)
        <div class="col-12">
            <div class="card shadow mb-3 bg-body-tertiary rounded">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-7 col-12 mb-3 mb-md-0">
                            <div class="d-flex align-items-center flex-sm-row flex-column text-center text-sm-start">
                                <img src="{{ asset('img/' . $news->image) }}" 
                                     class="news-image mb-3 mb-sm-0 me-sm-4" 
                                     alt="{{ $news->title }}">
                                <div>
                                    <h5 class="card-title mb-1">{{ $news->title }}</h5>
                                    <p class="text-muted mb-1 small">{{ $news->description }}</p>
                                    <div class="d-flex align-items-center gap-2 justify-content-center justify-content-sm-start">
                                        <span class="badge bg-{{ $news->category === 'Event' ? 'primary' : ($news->category === 'Restoran' ? 'warning' : 'info') }}">
                                            {{ $news->category }}
                                        </span>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ $news->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 col-12">
                            <div class="d-flex justify-content-center justify-content-md-end gap-2">
                                <a href="/manage-news-edit/{{ $news->id }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-fill me-1 d-none d-sm-inline"></i>
                                    <span class="d-none d-sm-inline">Edit</span>
                                    <i class="bi bi-pencil-fill d-sm-none"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $news->id }}">
                                    <i class="bi bi-trash-fill me-1 d-none d-sm-inline"></i>
                                    <span class="d-none d-sm-inline">Hapus</span>
                                    <i class="bi bi-trash-fill d-sm-none"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal for each news -->
        <div class="modal fade" id="delete{{ $news->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $news->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content rounded-4">
                    <div class="modal-body text-center p-4">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="mb-3">
                            <i class="bi bi-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Konfirmasi Hapus</h5>
                        <p class="mb-1">Apakah Anda yakin akan menghapus berita:</p>
                        <p class="fw-bold text-primary mb-4">"{{ $news->title }}"</p>
                        <div class="d-flex justify-content-center gap-2 flex-column flex-sm-row">
                            <button type="button" class="btn btn-danger">
                                <i class="bi bi-trash-fill me-1"></i>Ya, Hapus
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i>Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow bg-body-tertiary rounded">
                <div class="card-body text-center py-5">
                    <i class="bi bi-newspaper text-muted mb-3" style="font-size: 3rem;"></i>
                    <h5 class="text-muted">Tidak ada berita ditemukan</h5>
                    <p class="text-muted mb-3">
                        @if($search)
                            Tidak ada berita yang cocok dengan pencarian "{{ $search }}"
                        @else
                            Belum ada berita yang tersedia
                        @endif
                    </p>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Berita Pertama
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

</div>
