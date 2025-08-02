@push('styles')
@vite([
    'resources/css/jesselyn.css',
    // 'public/js/userprofile.js'
])
<style>
    .news-btn {
        background: var(--bs-primary);
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .news-btn:hover {
        background: #3a9d8f;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(74, 189, 172, 0.3);
    }
    
    .news-card {
        background: var(--bs-body-bg);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--bs-body-color);
        width: 100%;
        max-width: 350px;
        height: 480px;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--bs-border-color);
    }
    
    .news-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        text-decoration: none;
        color: var(--bs-body-color);
    }
    
    [data-bs-theme="dark"] .news-card {
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
    }
    
    [data-bs-theme="dark"] .news-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
    }
    
    .news-image {
        height: 220px;
        object-fit: cover;
        width: 100%;
    }
    
    .news-content {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex: 1;
        justify-content: space-between;
    }
    
    .news-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .news-description {
        color: var(--bs-secondary-color);
        margin-bottom: 0.5rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .news-keywords {
        color: var(--bs-tertiary-color);
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .category-badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        border-radius: 0.375rem;
        margin-bottom: 0.5rem;
    }

    .category-info { background-color: var(--bs-primary); color: white; }
    .category-promo { background-color: var(--bs-danger); color: white; }
    .category-kegiatan { background-color: var(--bs-warning); color: var(--bs-dark); }
    .category-wahana { background-color: var(--bs-success); color: white; }

    .filter-section {
        background: var(--bs-light);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--bs-border-color);
    }

    [data-bs-theme="dark"] .filter-section {
        background: var(--bs-dark);
    }

    .search-input {
        border: 2px solid var(--bs-border-color);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(74, 189, 172, 0.25);
    }
    
    .newsletter-section {
        background: linear-gradient(135deg, var(--bs-light) 0%, var(--bs-gray-200) 100%);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        max-width: 400px;
    }
    
    .newsletter-section h3 {
        color: var(--bs-heading-color);
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .newsletter-section p {
        color: var(--bs-secondary-color);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }
</style>
@endpush
<div>
    <!-- Header Section -->
    <div class="container my-5">
        <div class="row align-items-center justify-content-start g-4">
            <div class="col-md-6">
                <h1 class="large-font-title mb-0">NEWS</h1>
            </div>
        </div>
    </div>

    <!-- Filter and Search Section -->
    <div class="container mb-4">
        <div class="filter-section">
            <div class="row g-3 align-items-end">
                <!-- Search -->
                <div class="col-md-4">
                    <label for="search" class="form-label fw-bold">
                        <i class="bi bi-search me-1"></i>Cari Berita
                    </label>
                    <input type="text" 
                           wire:model.live.debounce.300ms="search" 
                           class="form-control search-input" 
                           id="search"
                           placeholder="Cari judul, deskripsi, atau kata kunci...">
                </div>

                <!-- Category Filter -->
                <div class="col-md-3">
                    <label for="category" class="form-label fw-bold">
                        <i class="bi bi-funnel me-1"></i>Kategori
                    </label>
                    <select wire:model.live="category" class="form-select" id="category">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort -->
                <div class="col-md-3">
                    <label for="sort" class="form-label fw-bold">
                        <i class="bi bi-sort-down me-1"></i>Urutkan
                    </label>
                    <select wire:model.live="sortBy" class="form-select" id="sort">
                        <option value="created_at">Tanggal Terbaru</option>
                        <option value="title">Judul A-Z</option>
                        <option value="category">Kategori</option>
                    </select>
                </div>

                <!-- Clear Filters -->
                <div class="col-md-2">
                    <button wire:click="clearFilters" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise me-1"></i>Reset
                    </button>
                </div>
            </div>

            <!-- Active Filters Display -->
            @if($search || $category)
                <div class="mt-3">
                    <small class="text-muted">Filter aktif:</small>
                    @if($search)
                        <span class="badge bg-primary ms-1">Pencarian: "{{ $search }}"</span>
                    @endif
                    @if($category)
                        <span class="badge bg-secondary ms-1">{{ $categories[$category] }}</span>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Results Count -->
    <div class="container mb-3">
        <p class="text-muted">
            Menampilkan <strong>{{ $news->count() }}</strong> dari <strong>{{ $news->total() }}</strong> berita
        </p>
    </div>

    <!-- News Grid Section -->
    <div class="bg-primary py-5 rounded-top-5">
        <div class="container">
            @if($news->count() > 0)
                <div class="row g-4 justify-content-center">
                    @foreach ($news as $item)
                    <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                        <a href="/news-detail/{{ $item->id }}" class="news-card" wire:navigate>
                            <img src="{{ $item->image_url }}" 
                                class="news-image"
                                alt="{{ $item->title }}">
                            <div class="news-content">
                                <div>
                                    <span class="category-badge category-{{ $item->category }}">
                                        {{ $item->category_label }}
                                    </span>
                                    <h5 class="news-title">{{ $item->title }}</h5>
                                    <p class="news-description">{{ $item->description }}</p>
                                    <p class="news-keywords">Keywords: {{ $item->keywords }}</p>
                                </div>
                                <div class="mt-auto">
                                    <span class="news-btn">Read More</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $news->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="text-white">
                        <i class="bi bi-search display-1 opacity-50"></i>
                        <h3 class="mt-3">Tidak ada berita ditemukan</h3>
                        <p class="lead opacity-75">Coba ubah kriteria pencarian atau filter Anda</p>
                        <button wire:click="clearFilters" class="btn btn-outline-light">
                            <i class="bi bi-arrow-clockwise me-2"></i>Reset Filter
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
