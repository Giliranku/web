@push('styles')
@vite([
    'resources/css/jesselyn.css',
    // 'public/js/userprofile.js'
])
<style>
    /* === Color Palette === */
    :root {
       --primary: #4ABDAC;
       --secondary: #FC4A1A; 
       --warning: #F7B733;
       --light: #FFFFFF;
       --dark: #2c3e50;
       --gray-light: #f8f9fa;
       --gray-medium: #6c757d;
       --gradient-primary: linear-gradient(135deg, #4ABDAC, #3a9d94);
       --gradient-secondary: linear-gradient(135deg, #FC4A1A, #e03d0f);
    }

    /* === Page Hero Section === */
    .page-hero {
       background: var(--gradient-primary);
       padding: 3rem 0 2rem;
       color: white;
    }

    .page-title {
       font-size: clamp(1.75rem, 4vw, 2.5rem);
       font-weight: 600;
       margin-bottom: 0.5rem;
       text-align: center;
    }

    .page-subtitle {
       font-size: clamp(1rem, 2vw, 1.1rem);
       font-weight: 300;
       opacity: 0.9;
       margin-bottom: 2.5rem;
       text-align: center;
    }

    /* === Search Bar Section === */
    .search-bar-minimal {
       background: white;
       border-radius: 20px;
       padding: 0;
       box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
       border: 1px solid #e0e0e0;
       display: flex;
       align-items: stretch;
       margin-bottom: 3rem;
       position: relative;
       min-height: 60px;
       max-width: 100%;
       width: 100%;
    }

    /* Search Input */
    .search-input-modern {
       border: none;
       padding: 1.2rem 1.8rem;
       font-size: 1rem;
       flex: 1;
       background: transparent;
       outline: none;
       color: var(--dark);
       border-right: 1px solid #e0e0e0;
       min-width: 0;
       border-radius: 20px 0 0 20px;
       font-weight: 500;
    }

    .search-input-modern::placeholder {
       color: #999;
       font-weight: 400;
    }

    /* Category and Sort Selectors */
    .category-selector, .sort-selector {
       position: relative;
       background: #f8f9fa;
       border-right: 1px solid #e0e0e0;
       min-width: 180px;
       display: flex;
       align-items: center;
       flex-shrink: 0;
    }

    .modern-select {
       background: none;
       border: none;
       padding: 1.2rem 1.5rem;
       height: 100%;
       width: 100%;
       font-size: 0.9rem;
       color: #666;
       cursor: pointer;
       outline: none;
       font-weight: 500;
    }

    .modern-select:hover {
       background: #e9ecef;
       color: var(--primary);
    }

    /* Reset Button */
    .reset-button {
       background: var(--primary);
       color: white;
       border: none;
       padding: 1.2rem 2rem;
       display: flex;
       align-items: center;
       justify-content: center;
       cursor: pointer;
       transition: all 0.3s ease;
       min-width: 120px;
       flex-shrink: 0;
       font-size: 0.9rem;
       border-radius: 0 20px 20px 0;
       font-weight: 600;
    }

    .reset-button:hover {
       background: #3a9b8a;
       color: white;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
       .search-bar-minimal {
          flex-wrap: wrap;
          min-height: auto;
          margin-bottom: 2rem;
       }
       
       .search-input-modern {
          flex-basis: 100%;
          border-right: none;
          border-bottom: 1px solid #e0e0e0;
          border-radius: 20px 20px 0 0;
          padding: 1rem 1.5rem;
       }
       
       .category-selector, .sort-selector {
          flex: 1;
          min-width: 140px;
          border-radius: 0;
       }
       
       .reset-button {
          border-radius: 0 0 20px 20px;
          min-width: 100%;
       }

       .news-card {
          max-width: 340px;
          height: 480px;
       }

       .news-image {
          height: 200px;
       }

       .news-content {
          padding: 1.5rem;
       }
    }

    @media (max-width: 576px) {
       .search-bar-minimal {
          flex-direction: column;
          margin-bottom: 1.5rem;
       }
       
       .search-input-modern, .category-selector, .sort-selector, .reset-button {
          border-right: none;
          border-bottom: 1px solid #e0e0e0;
          min-width: 100%;
          border-radius: 0;
       }

       .search-input-modern {
          border-radius: 20px 20px 0 0;
       }
       
       .reset-button {
          border-bottom: none;
          border-radius: 0 0 20px 20px;
          padding: 1rem;
       }

       .news-card {
          max-width: 100%;
          height: auto;
          min-height: 450px;
       }

       .news-image {
          height: 180px;
       }

       .news-content {
          padding: 1.2rem;
       }

       .news-title {
          font-size: 1.2rem;
       }

       /* Mobile pagination adjustments */
       .pagination-wrapper {
          padding: 1rem 1.2rem;
          margin: 0 1rem;
       }

       .pagination-wrapper .page-link {
          padding: 0.5rem 0.65rem;
          font-size: 0.85rem;
          min-width: 36px;
       }
    }

    /* Dark mode support */
    [data-bs-theme="dark"] .search-bar-minimal {
       background: var(--bs-dark);
       border-color: var(--bs-border-color);
    }

    [data-bs-theme="dark"] .category-selector, 
    [data-bs-theme="dark"] .sort-selector {
       background: var(--bs-secondary-bg);
    }

    [data-bs-theme="dark"] .modern-select {
       color: var(--bs-body-color);
    }

    .news-btn {
        background: var(--bs-primary);
        border: none;
        border-radius: 12px;
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
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        text-decoration: none;
        color: var(--bs-body-color);
        width: 100%;
        max-width: 380px;
        height: 520px;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--bs-border-color);
        position: relative;
        margin: 0 auto;
    }
    
    .news-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        text-decoration: none;
        color: var(--bs-body-color);
        border-color: var(--primary);
    }
    
    [data-bs-theme="dark"] .news-card {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        border-color: var(--bs-border-color);
    }
    
    [data-bs-theme="dark"] .news-card:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
        border-color: var(--primary);
    }
    
    .news-image {
        height: 240px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.4s ease;
    }
    
    .news-card:hover .news-image {
        transform: scale(1.05);
    }
    
    .news-content {
        padding: 1.8rem;
        display: flex;
        flex-direction: column;
        flex: 1;
        justify-content: space-between;
    }
    
    .news-title {
        font-size: 1.35rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        color: var(--bs-body-color);
    }
    
    .news-description {
        color: var(--bs-secondary-color);
        margin-bottom: 1rem;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-size: 0.95rem;
    }
    
    .news-keywords {
        color: var(--bs-tertiary-color);
        font-size: 0.85rem;
        margin-bottom: 1.2rem;
        font-style: italic;
    }

    .category-badge {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 12px;
        margin-bottom: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .category-info { 
        background: linear-gradient(135deg, var(--bs-primary), #3a9d94); 
        color: white; 
    }
    .category-promo { 
        background: linear-gradient(135deg, var(--bs-danger), #e03d0f); 
        color: white; 
    }
    .category-kegiatan { 
        background: linear-gradient(135deg, var(--bs-warning), #f5b800); 
        color: var(--bs-dark); 
    }
    .category-wahana { 
        background: linear-gradient(135deg, var(--bs-success), #198754); 
        color: white; 
    }

    /* News Meta */
    .news-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid var(--bs-border-color-translucent);
    }

    .news-date {
        font-size: 0.8rem;
        color: var(--bs-secondary-color);
        font-weight: 500;
    }

    .news-read-more {
        font-size: 0.85rem;
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        transition: all 0.3s ease;
    }

    .news-read-more:hover {
        color: var(--secondary);
        transform: translateX(3px);
    }

    /* Pagination Styling */
    .pagination-wrapper {
        background: var(--bs-body-bg);
        padding: 1.5rem 2rem;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--bs-border-color);
        display: inline-block;
        margin: 0 auto;
    }

    .pagination-wrapper .pagination {
        margin-bottom: 0;
        justify-content: center;
        align-items: center;
        gap: 0.25rem;
    }

    .pagination-wrapper .page-item {
        margin: 0;
    }

    .pagination-wrapper .page-link {
        border: 1px solid transparent;
        color: var(--bs-secondary-color);
        font-weight: 500;
        padding: 0.65rem 1rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: transparent;
        font-size: 0.9rem;
        min-width: 42px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pagination-wrapper .page-link:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(74, 189, 172, 0.25);
    }

    .pagination-wrapper .page-item.active .page-link {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        box-shadow: 0 2px 8px rgba(74, 189, 172, 0.3);
        font-weight: 600;
    }

    .pagination-wrapper .page-item.disabled .page-link {
        color: var(--bs-tertiary-color);
        background: var(--bs-secondary-bg);
        border-color: var(--bs-border-color);
        cursor: not-allowed;
    }

    .pagination-wrapper .page-item.disabled .page-link:hover {
        transform: none;
        box-shadow: none;
        background: var(--bs-secondary-bg);
        color: var(--bs-tertiary-color);
    }

    /* Dark mode pagination */
    [data-bs-theme="dark"] .pagination-wrapper {
        background: var(--bs-dark);
        border-color: var(--bs-border-color);
    }

    [data-bs-theme="dark"] .pagination-wrapper .page-link {
        color: var(--bs-body-color);
    }

    [data-bs-theme="dark"] .pagination-wrapper .page-item.disabled .page-link {
        background: var(--bs-tertiary-bg);
        color: var(--bs-tertiary-color);
    }

    /* Override default Bootstrap pagination styling */
    .pagination-wrapper .pagination .page-item:not(:first-child) .page-link {
        margin-left: 0;
    }

    .pagination-wrapper .pagination .page-item:first-child .page-link,
    .pagination-wrapper .pagination .page-item:last-child .page-link {
        border-radius: 12px;
    }

    .pagination-wrapper .pagination .page-link:focus {
        box-shadow: 0 0 0 0.2rem rgba(74, 189, 172, 0.25);
        border-color: var(--primary);
    }

    /* Ensure consistent spacing */
    .pagination-wrapper nav[aria-label="pagination"] {
        display: flex;
        justify-content: center;
        width: 100%;
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
    {{-- ===== PAGE HERO SECTION ===== --}}
    <section class="page-hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="page-title">📰 Berita & Informasi</h1>
                    <p class="page-subtitle">Dapatkan update terbaru tentang wahana, promo, dan kegiatan menarik di Giliranku</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter and Search Section -->
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="search-bar-minimal">
                    {{-- Search Input --}}
                    <input type="text" 
                           class="search-input-modern" 
                           placeholder="Cari berita, kategori, atau kata kunci..."
                           wire:model.live.debounce.300ms="search">

                    {{-- Category Filter --}}
                    <div class="category-selector">
                        <select wire:model.live="category" class="modern-select">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Sort Filter --}}
                    <div class="sort-selector">
                        <select wire:model.live="sortBy" class="modern-select">
                            <option value="created_at">Terbaru</option>
                            <option value="title">Judul A-Z</option>
                            <option value="category">Kategori</option>
                        </select>
                    </div>

                    {{-- Reset Button --}}
                    <button wire:click="clearFilters" class="reset-button">
                        <i class="bi bi-arrow-clockwise me-1"></i>Reset
                    </button>
                </div>

                <!-- Active Filters Display -->
                @if($search || $category)
                    <div class="mt-3 text-center">
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
    </div>

    <!-- Results Count -->
    <div class="container mb-3">
        <p class="text-muted">
            Menampilkan <strong>{{ $news->count() }}</strong> dari <strong>{{ $news->total() }}</strong> berita
        </p>
    </div>

    <!-- News Grid Section -->
    <div class="container py-5">
        @if($news->count() > 0)
            <div class="row g-4 justify-content-center">
                @foreach ($news as $item)
                <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                    <a href="/news-detail/{{ $item->id }}" class="news-card" wire:navigate>
                        <img src="{{ $item->getCoverUrl() }}" 
                            class="news-image"
                            alt="{{ $item->title }}">
                        <div class="news-content">
                            <div>
                                <span class="category-badge category-{{ $item->category }}">
                                    {{ $item->category_label }}
                                </span>
                                <h5 class="news-title">{{ $item->title }}</h5>
                                <p class="news-description">{{ $item->description }}</p>
                                @if($item->keywords)
                                <p class="news-keywords">{{ $item->keywords }}</p>
                                @endif
                            </div>
                            <div class="news-meta">
                                <span class="news-date">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </span>
                                <span class="news-read-more">
                                    Baca Selengkapnya
                                    <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                <div class="pagination-wrapper">
                    <div class="d-flex justify-content-center">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div style="padding: 4rem 2rem; color: #6c757d;">
                    <i class="bi bi-search" style="font-size: 4rem; color: #f8f9fa; margin-bottom: 1rem; display: block;"></i>
                    <h3 style="font-size: 1.5rem; font-weight: 300; margin-bottom: 1rem; color: #2c3e50;">Tidak ada berita ditemukan</h3>
                    <p style="margin-bottom: 1.5rem;">Coba ubah kriteria pencarian atau filter Anda</p>
                    <button wire:click="clearFilters" class="news-btn">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Filter
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
