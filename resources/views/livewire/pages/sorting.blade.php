@push('styles')
<style>
/* ===== MINIMALIST SEARCH PAGE STYLES ===== */

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

/* === Search Header === */
.search-hero {
   background: var(--gradient-primary);
   padding: 3rem 0 2rem;
   color: white;
}

.search-title {
   font-size: clamp(2rem, 4vw, 2.5rem);
   font-weight: 300;
   margin-bottom: 0.5rem;
}

.search-subtitle {
   font-size: 1.1rem;
   font-weight: 300;
   opacity: 0.9;
   margin-bottom: 2rem;
}

/* === Search Bar Minimal === */
.search-bar-minimal {
   background: white;
   border-radius: 50px;
   padding: 0.75rem 1.5rem;
   box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
   border: none;
   display: flex;
   align-items: center;
   gap: 1rem;
   margin-bottom: 2rem;
}

.search-bar-minimal input {
   border: none;
   outline: none;
   flex: 1;
   font-size: 1rem;
   background: transparent;
}

.search-bar-minimal input::placeholder {
   color: var(--gray-medium);
}

.search-bar-minimal .search-icon {
   color: var(--gray-medium);
   font-size: 1.2rem;
}

/* === Filter Section === */
.filter-section {
   background: white;
   padding: 1.5rem 0;
   border-bottom: 1px solid #eee;
}

.filter-container {
   display: flex;
   gap: 1rem;
   align-items: center;
   flex-wrap: wrap;
}

.filter-dropdown {
   position: relative;
   min-width: 200px;
}

.filter-button {
   background: var(--gray-light);
   border: 1px solid #e0e0e0;
   border-radius: 12px;
   padding: 0.75rem 1rem;
   width: 100%;
   text-align: left;
   display: flex;
   justify-content: between;
   align-items: center;
   font-size: 0.95rem;
   color: var(--dark);
   transition: all 0.3s ease;
}

.filter-button:hover {
   border-color: var(--primary);
   background: white;
}

.filter-button .dropdown-icon {
   margin-left: auto;
   transition: transform 0.3s ease;
}

.filter-button.active .dropdown-icon {
   transform: rotate(180deg);
}

.filter-dropdown-menu {
   position: absolute;
   top: 100%;
   left: 0;
   right: 0;
   background: white;
   border: 1px solid #e0e0e0;
   border-radius: 12px;
   box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
   z-index: 100;
   margin-top: 0.5rem;
   overflow: hidden;
}

.filter-dropdown-item {
   padding: 0.75rem 1rem;
   cursor: pointer;
   transition: background-color 0.2s ease;
   font-size: 0.95rem;
}

.filter-dropdown-item:hover {
   background: var(--gray-light);
}

.filter-dropdown-item.active {
   background: var(--primary);
   color: white;
}

.search-button-minimal {
   background: var(--primary);
   color: white;
   border: none;
   border-radius: 12px;
   padding: 0.75rem 2rem;
   font-weight: 500;
   transition: all 0.3s ease;
   white-space: nowrap;
}

.search-button-minimal:hover {
   background: #3a9d94;
   transform: translateY(-2px);
   box-shadow: 0 4px 15px rgba(74, 189, 172, 0.3);
}

/* === Results Section === */
.results-section {
   padding: 2rem 0;
}

.results-header {
   display: flex;
   justify-content: between;
   align-items: center;
   margin-bottom: 2rem;
}

.results-count {
   font-size: 0.95rem;
   color: var(--gray-medium);
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

/* === Empty State === */
.empty-state {
   text-align: center;
   padding: 4rem 2rem;
   color: var(--gray-medium);
}

.empty-state i {
   font-size: 4rem;
   color: var(--gray-light);
   margin-bottom: 1rem;
}

.empty-state h3 {
   font-size: 1.5rem;
   font-weight: 300;
   margin-bottom: 1rem;
   color: var(--dark);
}

/* === Responsive === */
@media (max-width: 768px) {
   .search-hero { padding: 2rem 0 1.5rem; }
   
   .filter-container {
      flex-direction: column;
      align-items: stretch;
   }
   
   .filter-dropdown {
      min-width: 100%;
   }
   
   .search-button-minimal {
      width: 100%;
   }
   
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
   .results-header {
      flex-direction: column;
      gap: 1rem;
      align-items: stretch;
   }
   
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
[data-bs-theme="dark"] .filter-button,
[data-bs-theme="dark"] .filter-dropdown-menu {
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
               
               <div class="search-bar-minimal">
                  <input type="text"
                     placeholder="Cari wahana, restoran, atau aktivitas..."
                     wire:model.defer="search"
                     x-data
                     x-on:keydown.enter="$wire.doSearch()"
                  >
               </div>
            </div>
         </div>
      </div>
   </section>

   {{-- ===== FILTER SECTION ===== --}}
   <section class="filter-section">
      <div class="container">
         <div class="filter-container">
            {{-- Sort Dropdown --}}
            <div class="filter-dropdown"
               x-data="{
                  open: false,
                  selected: @entangle('sortBy'),
                  select(option) {
                     this.selected = option;
                     this.open = false;
                     $wire.sortBy = option;
                  },
                  options: [
                     'Kapasitas Terbesar',
                     'Kapasitas Terkecil',
                  ]
               }"
               @click.outside="open = false">
               
               <button class="filter-button" :class="{ 'active': open }" @click="open = !open">
                  <span>Urutkan: </span>
                  <strong x-text="selected"></strong>
                  <i class="bi bi-chevron-down dropdown-icon"></i>
               </button>
               
               <div class="filter-dropdown-menu" x-show="open" x-transition>
                  <template x-for="option in options" :key="option">
                     <div class="filter-dropdown-item" 
                          :class="{ 'active': option === selected }"
                          @click="select(option)" 
                          x-text="option">
                     </div>
                  </template>
               </div>
            </div>

            {{-- Category Dropdown --}}
            <div class="filter-dropdown"
               x-data="{
                  open: false,
                  selected: @entangle('category'),
                  select(option) {
                     this.selected = option;
                     this.open = false;
                     $wire.category = option;
                  },
                  options: [
                     'Semua',
                     'Restoran', 
                     'Attraction'
                  ]
               }"
               @click.outside="open = false">
               
               <button class="filter-button" :class="{ 'active': open }" @click="open = !open">
                  <span>Kategori: </span>
                  <strong x-text="selected"></strong>
                  <i class="bi bi-chevron-down dropdown-icon"></i>
               </button>
               
               <div class="filter-dropdown-menu" x-show="open" x-transition>
                  <template x-for="option in options" :key="option">
                     <div class="filter-dropdown-item" 
                          :class="{ 'active': option === selected }"
                          @click="select(option)" 
                          x-text="option">
                     </div>
                  </template>
               </div>
            </div>

            {{-- Search Button --}}
            <button class="search-button-minimal" wire:click="doSearch">
               <i class="bi bi-search me-2"></i>Cari
            </button>
         </div>
      </div>
   </section>

   {{-- ===== RESULTS SECTION ===== --}}
   <section class="results-section">
      <div class="container">
         <div class="results-header">
            <div class="results-count">
               Menampilkan {{ $items->count() }} hasil
               @if($search)
                  untuk "<strong>{{ $search }}</strong>"
               @endif
            </div>
         </div>

         {{-- Results List --}}
         @forelse($items as $index => $item)
            <div class="result-card fade-in-up" style="animation-delay: {{ $index * 0.1 }}s;">
               <div class="result-content">
                  <img src="{{ $this->getImageUrl($item->cover) }}" alt="{{ $item->name }}" class="result-image">
                  
                  <div class="result-info">
                     <div class="result-type {{ strtolower($item->type) === 'restoran' ? 'restaurant' : 'attraction' }}">
                        {{ $item->type === 'Restoran' ? 'Restoran' : 'Wahana' }}
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
                        
                        @if($item->type === 'Restoran' && isset($item->price))
                           <div class="meta-item">
                              <i class="bi bi-tag"></i>
                              <span>Harga: <span class="meta-value">Rp{{ number_format($item->price) }}</span></span>
                           </div>
                        @endif
                     </div>
                  </div>
                  
                  <div class="result-action">
                     @if($item->type === 'Restoran')
                        <a href="/restaurant/{{ $item->id }}" class="result-button">
                           Lihat Detail
                        </a>
                     @elseif ($item->type === 'Attraction')
                        <a href="/attraction/{{ $item->id }}" class="result-button">
                           Lihat Detail
                        </a>
                     @endif
                  </div>
               </div>
            </div>
         @empty
            <div class="empty-state">
               <i class="bi bi-search"></i>
               <h3>Tidak ada hasil ditemukan</h3>
               <p>Coba ubah kata kunci pencarian atau filter yang digunakan.</p>
            </div>
         @endforelse
      </div>
   </section>
</div>