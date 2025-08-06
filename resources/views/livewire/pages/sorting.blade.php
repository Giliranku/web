@push('styles')
<style>
/* === MINIMALIST SEARCH PAGE STYLES ===== */

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
[data-bs-theme="dark"] .sort-dropdown-item {
   color: var(--light) !important;
}

[data-bs-theme="light"] .sort-dropdown-item {
   color: var(--dark) !important;
}

[data-bs-theme="light"] .category-dropdown-item {
   color: var(--dark);
}
[data-bs-theme="dark"] .category-dropdown-item {
   color: var(--light);
}

/* === Search Hero Section === */
.search-hero {
   background: var(--gradient-primary);
   padding: 3rem 0 2rem;
   color: white;
}

.search-title {
   font-size: clamp(1.75rem, 4vw, 2.5rem);
   font-weight: 600;
   margin-bottom: 0.5rem;
   text-align: center;
}

.search-subtitle {
   font-size: clamp(1rem, 2vw, 1.1rem);
   font-weight: 300;
   opacity: 0.9;
   margin-bottom: 2.5rem;
   text-align: center;
}

/* === Search Bar with Integrated Controls === */
.search-bar-minimal {
   background: white;
   border-radius: 16px;
   padding: 0;
   box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
   border: 1px solid #e0e0e0;
   display: flex;
   align-items: stretch;
   margin-bottom: 2rem;
   /* overflow: hidden; */
   position: relative;
   min-height: 56px;
   max-width: 100%;
   width: 100%;
}

/* Search Input */
.search-input {
   border: none;
   padding: 1rem 1.5rem;
   font-size: 1rem;
   flex: 1;
   background: transparent;
   outline: none;
   color: var(--dark);
   border-right: 1px solid #e0e0e0;
   min-width: 0;
}

.search-input::placeholder {
   color: #999;
}

/* Category Selector */
.category-selector {
   position: relative;
   background: #f8f9fa;
   border-right: 1px solid #e0e0e0;
   min-width: 160px;
   display: flex;
   align-items: center;
   flex-shrink: 0;
}

.category-button {
   background: none;
   border: none;
   padding: 0 1rem;
   height: 100%;
   width: 100%;
   display: flex;
   align-items: center;
   gap: 0.5rem;
   font-size: 0.85rem;
   color: #666;
   cursor: pointer;
   transition: all 0.3s ease;
   white-space: nowrap;
   justify-content: space-between;
}

.category-button:hover {
   background: #e9ecef;
   color: var(--primary);
}

.category-button .bi-chevron-down,
.sort-button .bi-chevron-down {
   transition: transform 0.3s ease;
}

.category-button .bi-chevron-down.rotate-180,
.sort-button .bi-chevron-down.rotate-180 {
   transform: rotate(180deg);
}

/* Sort Selector */
.sort-selector {
   position: relative;
   background: #f8f9fa;
   border-right: 1px solid #e0e0e0;
   min-width: 140px;
   display: flex;
   align-items: center;
   flex-shrink: 0;
}

.sort-button {
   background: none;
   border: none;
   padding: 0 1rem;
   height: 100%;
   width: 100%;
   display: flex;
   align-items: center;
   gap: 0.5rem;
   font-size: 0.85rem;
   color: #666;
   cursor: pointer;
   transition: all 0.3s ease;
   white-space: nowrap;
   justify-content: space-between;
}

.sort-button:hover {
   background: #e9ecef;
   color: var(--primary);
}

/* Search Button */
.search-button {
   border-radius: 15px;
   background: var(--primary);
   color: white;
   border: none;
   padding: 0 1.5rem;
   display: flex;
   align-items: center;
   justify-content: center;
   cursor: pointer;
   transition: all 0.3s ease;
   min-width: 80px;
   flex-shrink: 0;
   font-size: 1.1rem;
}

.search-button:hover {
   background: #3a9b8a;
}

/* Dropdown Menus */
.category-dropdown-menu,
.sort-dropdown-menu {
   position: absolute;
   top: 100%;
   background: white;
   border: 1px solid #ddd;
   border-radius: 8px;
   box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
   z-index: 1000;
   margin-top: 4px;
   overflow: hidden;
}

.sort-dropdown-menu {
   left: auto;
   right: 0;
   min-width: 180px;
}

.category-dropdown-item,
.sort-dropdown-item {
   padding: 12px 16px;
   cursor: pointer;
   transition: background-color 0.2s ease;
   font-size: 14px;
   border-bottom: 1px solid #f5f5f5;
   display: flex;
   align-items: center;
   gap: 8px;
}

.category-dropdown-item:last-child,
.sort-dropdown-item:last-child {
   border-bottom: none;
}

.category-dropdown-item:hover,
.sort-dropdown-item:hover {
   background: #f8f9fa;
}

.category-dropdown-item.active,
.sort-dropdown-item.active {
   background: var(--primary);
   color: white;
}

.category-dropdown-item i {
   width: 16px;
   text-align: center;
}

/* Filter Section */
.filter-section {
   background: white;
   padding: 1rem 0;
   border-bottom: 1px solid #eee;
}

.filter-container {
   display: flex;
   align-items: center;
   justify-content: space-between;
   padding: 0;
}

.results-count {
   color: #6c757d;
   font-size: 0.9rem;
   font-weight: 500;
}

/* Responsive Design */
@media (max-width: 992px) {
   .search-bar-minimal {
      flex-wrap: wrap;
      min-height: auto;
   }
   
   .search-input {
      flex-basis: 100%;
      border-right: none;
      border-bottom: 1px solid #e0e0e0;
   }
   
   .category-selector,
   .sort-selector {
      flex: 1;
      min-width: 120px;
   }
   
   .search-button {
      min-width: 100px;
   }
   
   /* Better dropdown positioning for tablet */
   .category-dropdown-menu,
   .sort-dropdown-menu {
      min-width: 180px;
      max-width: 250px;
   }
}

@media (max-width: 576px) {
   .search-bar-minimal {
      flex-direction: column;
   }
   
   .search-input {
      border-right: none;
      border-bottom: 1px solid #e0e0e0;
   }
   
   .category-selector,
   .sort-selector,
   .search-button {
      border-right: none;
      border-bottom: 1px solid #e0e0e0;
      min-width: 100%;
   }
   
   .search-button {
      border-bottom: none;
      padding: 1rem;
   }
   
   .category-button,
   .sort-button {
      padding: 1rem;
   }
   
   /* Mobile dropdown improvements */
   .category-dropdown-menu,
   .sort-dropdown-menu {
      left: 0;
      right: 0;
      min-width: auto;
      max-width: none;
      position: absolute;
   }
   
   .category-dropdown-item,
   .sort-dropdown-item {
      padding: 16px 20px;
      font-size: 16px;
   }
}

@media (max-width: 768px) {
   .search-hero {
      padding: 2rem 0 1.5rem;
   }
   
   .container {
      padding-left: 1rem;
      padding-right: 1rem;
   }
}

/* === Result Cards === */
.result-card {
   background: white;
   border-radius: 16px;
   border: 1px solid #f0f0f0;
   padding: 1.5rem;
   margin-bottom: 1.5rem;
   transition: all 0.3s ease;
   overflow: hidden;
}

.result-card:hover {
   transform: translateY(-4px);
   box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
   border-color: var(--primary);
}

.result-content {
   display: grid;
   grid-template-columns: auto 1fr auto;
   gap: 1.5rem;
   align-items: center;
}

.result-image {
   width: 120px;
   height: 80px;
   border-radius: 12px;
   object-fit: cover;
   border: 1px solid #f0f0f0;
}

.result-info {
   flex: 1;
   min-width: 0;
}

.result-type {
   display: inline-block;
   background: var(--gray-light);
   color: var(--gray-medium);
   padding: 0.25rem 0.75rem;
   border-radius: 20px;
   font-size: 0.8rem;
   font-weight: 500;
   margin-bottom: 0.5rem;
}

.result-type.restaurant {
   background: rgba(252, 74, 26, 0.1);
   color: var(--secondary);
}

.result-type.attraction {
   background: rgba(74, 189, 172, 0.1);
   color: var(--primary);
}

.result-title {
   font-size: 1.25rem;
   font-weight: 600;
   color: var(--dark);
   margin-bottom: 0.75rem;
   line-height: 1.3;
}

.result-meta {
   display: flex;
   gap: 2rem;
   align-items: center;
}

.meta-item {
   display: flex;
   align-items: center;
   gap: 0.5rem;
   color: var(--gray-medium);
   font-size: 0.9rem;
}

.meta-item i {
   font-size: 1.1rem;
   color: var(--primary);
}

.meta-value {
   font-weight: 600;
   color: var(--dark);
}

.result-action {
   display: flex;
   align-items: center;
}

.result-button {
   background: var(--primary);
   color: white;
   border: none;
   border-radius: 12px;
   padding: 0.75rem 1.5rem;
   font-weight: 500;
   text-decoration: none;
   transition: all 0.3s ease;
   display: inline-block;
}

.result-button:hover {
   background: #3a9d94;
   color: white;
   transform: translateY(-2px);
   box-shadow: 0 4px 15px rgba(74, 189, 172, 0.3);
}



/* === Responsive === */
@media (max-width: 768px) {
   .result-content {
      grid-template-columns: 1fr;
      gap: 1rem;
   }
   
   .result-image {
      width: 100%;
      height: 160px;
      order: -1;
   }
   
   .result-action {
      justify-content: center;
   }
   
   .result-button {
      width: 100%;
      text-align: center;
   }
   
   .result-meta {
      gap: 1rem;
      flex-wrap: wrap;
   }
}

@media (max-width: 576px) {
   .result-meta {
      flex-direction: column;
      align-items: flex-start;
      gap: 0.5rem;
   }
}

/* === Animations === */
@keyframes fadeInUp {
   from { opacity: 0; transform: translateY(20px); }
   to { opacity: 1; transform: translateY(0); }
}

.fade-in-up {
   animation: fadeInUp 0.6s ease-out;
}

/* Dark mode support */
[data-bs-theme="dark"] .search-bar-minimal,
[data-bs-theme="dark"] .result-card,
[data-bs-theme="dark"] .category-dropdown-menu,
[data-bs-theme="dark"] .sort-dropdown-menu {
   background: var(--bs-dark);
   border-color: var(--bs-border-color);
}

[data-bs-theme="dark"] .filter-section {
   background: var(--bs-body-bg);
   border-color: var(--bs-border-color);
}
</style>
@endpush

<div class="search-page-minimal">
   {{-- ===== SEARCH HERO SECTION ===== --}}
   <section class="search-hero">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
               <h1 class="search-title">Temukan Destinasi Impian</h1>
               <p class="search-subtitle">Cari wahana dan restoran favorit Anda dengan mudah</p>
               
               <div class="search-bar-minimal"
                  x-data="{
                     categoryOpen: false,
                     sortOpen: false,
                     selectedCategory: @entangle('category'),
                     selectedSort: @entangle('sortBy'),
                     
                     getCategoryLabel() {
                        switch(this.selectedCategory) {
                           case 'Attraction': return 'Wahana';
                           case 'Restaurant': return 'Restoran';
                           default: return 'Semua Kategori';
                        }
                     },
                     getCategoryIcon() {
                        switch(this.selectedCategory) {
                           case 'Attraction': return 'bi-star-fill';
                           case 'Restaurant': return 'bi-cup-hot-fill';
                           default: return 'bi-list-ul';
                        }
                     }
                  }"
                  @click.outside="categoryOpen = false; sortOpen = false">

                  {{-- 1. Search Input --}}
                  <input type="text" 
                         class="search-input" 
                         placeholder="Cari restoran atau wahana..."
                         wire:model.live.debounce.300ms="searchQuery">

                  {{-- 2. Category Dropdown --}}
                  <div class="category-selector">
                     <button type="button" 
                             class="category-button" 
                             @click="categoryOpen = !categoryOpen; sortOpen = false">
                        <i class="bi" :class="getCategoryIcon()"></i>
                        <span x-text="getCategoryLabel()"></span>
                        <i class="bi bi-chevron-down" :class="{ 'rotate-180': categoryOpen }"></i>
                     </button>
                     <div class="category-dropdown-menu" x-show="categoryOpen" x-transition>
                        <div class="category-dropdown-item" @click="$wire.set('category', 'Semua'); categoryOpen = false">
                           <i class="bi bi-list-ul"></i>
                           <span>Semua Kategori</span>
                        </div>
                        <div class="category-dropdown-item" @click="$wire.set('category', 'Attraction'); categoryOpen = false">
                           <i class="bi bi-star-fill"></i>
                           <span>Wahana</span>
                        </div>
                        <div class="category-dropdown-item" @click="$wire.set('category', 'Restaurant'); categoryOpen = false">
                           <i class="bi bi-cup-hot-fill"></i>
                           <span>Restoran</span>
                        </div>
                     </div>
                  </div>

                  {{-- 3. Sort Dropdown --}}
                  <div class="sort-selector">
                     <button type="button" 
                             class="sort-button" 
                             @click="sortOpen = !sortOpen; categoryOpen = false">
                        <span x-text="selectedSort"></span>
                        <i class="bi bi-chevron-down" :class="{ 'rotate-180': sortOpen }"></i>
                     </button>
                     <div class="sort-dropdown-menu" x-show="sortOpen" x-transition>
                        <div class="sort-dropdown-item" @click="$wire.set('sortBy', 'Terpopuler'); sortOpen = false">Terpopuler</div>
                        <div class="sort-dropdown-item" @click="$wire.set('sortBy', 'Nama A-Z'); sortOpen = false">Nama A-Z</div>
                        <div class="sort-dropdown-item" @click="$wire.set('sortBy', 'Nama Z-A'); sortOpen = false">Nama Z-A</div>
                        <div class="sort-dropdown-item" @click="$wire.set('sortBy', 'Kapasitas Terbesar'); sortOpen = false">Kapasitas Terbesar</div>
                        <div class="sort-dropdown-item" @click="$wire.set('sortBy', 'Kapasitas Terkecil'); sortOpen = false">Kapasitas Terkecil</div>
                     </div>
                  </div>

                  {{-- 4. Search Button --}}
                  <button class="search-button" wire:click="doSearch">
                     <i class="bi bi-search"></i>
                  </button>
               </div>
            </div>
         </div>
      </div>
   </section>

   {{-- ===== FILTER SECTION ===== --}}
   <section class="filter-section">
      <div class="container">
         <div class="filter-container">
            {{-- Spacer atau bisa ditambah filter tambahan di sini --}}
         </div>
      </div>
   </section>

   {{-- ===== RESULTS SECTION ===== --}}
   <section class="results-section">
      <div class="container">
         <div class="results-header">
            <div class="results-count">
               Menampilkan {{ $items->count() }} hasil
               @if($searchQuery)
                  untuk "<strong>{{ $searchQuery }}</strong>"
               @endif
            </div>
         </div>

         {{-- Results List --}}
         @forelse($items as $index => $item)
            <div class="result-card fade-in-up" style="animation-delay: {{ $index * 0.1 }}s;">
               <div class="result-content">
                  <img src="{{ $this->getImageUrl($item->cover) }}" alt="{{ $item->name }}" class="result-image">
                  
                  <div class="result-info">
                     <div class="result-type {{ $item->type === 'Restaurant' ? 'restaurant' : 'attraction' }}">
                        {{ $item->type === 'Restaurant' ? 'Restoran' : 'Wahana' }}
                     </div>
                     
                     <h3 class="result-title">{{ $item->name }}</h3>
                     
                     <div class="result-meta">
                        <div class="meta-item">
                           <i class="bi bi-person-fill"></i>
                           <span>Kapasitas: <span class="meta-value">{{ $item->capacity ?? '0' }}</span></span>
                        </div>
                        
                        @if($item->time_estimation)
                           <div class="meta-item">
                              <i class="bi bi-clock"></i>
                              <span>Waktu: <span class="meta-value">{{ $item->time_estimation }} menit</span></span>
                           </div>
                        @endif
                        
                        @if($item->type === 'Restaurant' && isset($item->price))
                           <div class="meta-item">
                              <i class="bi bi-tag"></i>
                              <span>Harga: <span class="meta-value">Rp{{ number_format($item->price) }}</span></span>
                           </div>
                        @endif
                     </div>
                  </div>
                  
                  <div class="result-action">
                     @if($item->type === 'Restaurant')
                        <a href="/restaurant/{{ $item->id }}" class="result-button" wire:navigate>
                           Lihat Detail
                        </a>
                     @elseif ($item->type === 'Attraction')
                        <a href="/attraction/{{ $item->id }}" class="result-button" wire:navigate>
                           Lihat Detail
                        </a>
                     @endif
                  </div>
               </div>
            </div>
         @empty
            <div style="text-align: center; padding: 4rem 2rem; color: #6c757d;">
               <i class="bi bi-search" style="font-size: 4rem; color: #f8f9fa; margin-bottom: 1rem; display: block;"></i>
               <h3 style="font-size: 1.5rem; font-weight: 300; margin-bottom: 1rem; color: #2c3e50;">Tidak ada hasil ditemukan</h3>
               <p>Coba ubah kata kunci pencarian atau filter yang digunakan.</p>
            </div>
         @endforelse
      </div>
   </section>
</div>