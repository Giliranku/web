@push('styles')
@vite([
    'resources/sass/app.scss',
    'resources/js/app.js',
    'resources/css/main.css',
    'resources/css/tiket-ecommerce.css'
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

/* Dark mode support */
[data-bs-theme="dark"] .page-hero {
   background: var(--gradient-primary);
}
</style>
@endpush

@push('scripts')
<script>
console.log('🎫 Tiket E-commerce page loaded');

// Initialize modals when page loads
document.addEventListener('livewire:navigated', function() {
    console.log('🚀 Initializing ticket modals...');
    
    // Initialize all modals
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (typeof bootstrap !== 'undefined') {
            new bootstrap.Modal(modal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
        }
    });
    
    console.log(`✅ Initialized ${modals.length} modals`);
});

// Listen for cart updates to close modal and sync components
document.addEventListener('livewire:initialized', function() {
    Livewire.on('cartUpdated', function() {
        console.log('🛒 Cart updated, checking if modal should close...');
        
        // Close any open modal when item is added to cart
        const openModal = document.querySelector('.modal.show');
        if (openModal) {
            const modalInstance = bootstrap.Modal.getInstance(openModal);
            if (modalInstance) {
                modalInstance.hide();
                console.log('✅ Modal closed after cart update');
            }
        }
    });
});
</script>
@endpush

<div class="overflow-x-hidden">
    {{-- ===== PAGE HERO SECTION ===== --}}
    <section class="page-hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="page-title">🎢 Beli Tiket Giliranku</h1>
                    <p class="page-subtitle">Satu tiket untuk semua keseruan! Akses unlimited ke wahana dan restoran favorit</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <!-- Feature Icons Section -->
        <div class="row g-3 justify-content-center mt-4 mb-5">
            <div class="col-md-3 col-6">
                <div class="text-center">
                    <i class="bi bi-ticket-perforated" style="font-size: 2rem; color: var(--primary);"></i>
                    <p class="mb-0 mt-2">Universal Access</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="text-center">
                    <i class="bi bi-clock" style="font-size: 2rem; color: var(--primary);"></i>
                    <p class="mb-0 mt-2">Skip The Line</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="text-center">
                    <i class="bi bi-shield-check" style="font-size: 2rem; color: var(--primary);"></i>
                    <p class="mb-0 mt-2">Secure Payment</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="text-center">
                    <i class="bi bi-phone" style="font-size: 2rem; color: var(--primary);"></i>
                    <p class="mb-0 mt-2">Digital Queue</p>
                </div>
            </div>
        </div>
        <!-- Search & Filter Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="search-card p-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <livewire:date-selector />
                        </div>
                        <div class="col-md-8">
                            <div class="position-relative">
                                <i class="bi bi-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: var(--primary);"></i>
                                <input type="search" 
                                       class="form-control search-input ps-5" 
                                       placeholder="Cari tiket berdasarkan nama atau lokasi..." 
                                       wire:model.live="search">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tickets Grid -->
        <div class="row g-4 mb-5">
            <!-- Debug Info (Remove this in production) -->
            <div class="col-12 mb-3">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Ditemukan {{ count($products) }} tiket tersedia
                    @if($search)
                        dengan pencarian "{{ $search }}"
                    @endif
                </small>
            </div>
            
            @forelse ($products as $product)
                <div class="col-lg-6 fade-in">
                    <div class="ticket-card h-100">
                        <!-- Promo Badge -->
                        @if($product->price < $product->price_before)
                            <div class="position-absolute top-0 start-0 m-3" style="z-index: 10;">
                                <div class="promo-badge">
                                    <i class="bi bi-fire me-1"></i>PROMO SPESIAL
                                </div>
                            </div>
                        @endif
                        
                        <div class="row g-0 h-100">
                            <!-- Ticket Image -->
                            <div class="col-md-5">
                                <div class="ticket-image-container h-100">
                                    <img src="{{ $product->getLogoUrl() }}" 
                                         class="img-fluid" 
                                         style="max-width: 140px; max-height: 100px; object-fit: contain;" 
                                         alt="{{ $product->name }}"
                                         onerror="this.src='{{ asset('img/default-placeholder.svg') }}'">
                                </div>
                            </div>
                            
                            <!-- Ticket Info -->
                            <div class="col-md-7">
                                <div class="p-4 d-flex flex-column h-100">
                                    <div class="flex-grow-1">
                                        <h4 class="fw-bold mb-2">{{ $product->name }}</h4>
                                        <p class="text-muted mb-3">
                                            <i class="bi bi-geo-alt me-1" style="color: var(--primary);"></i>{{ $product->location }}
                                        </p>
                                        
                                        <!-- Pricing -->
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="price-main">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </span>
                                                @if($product->price < $product->price_before)
                                                    <span class="price-old">
                                                        Rp {{ number_format($product->price_before, 0, ',', '.') }}
                                                    </span>
                                                @endif
                                            </div>
                                            @if($product->price < $product->price_before)
                                                <small class="text-success fw-semibold">
                                                    Hemat Rp {{ number_format($product->price_before - $product->price, 0, ',', '.') }}!
                                                </small>
                                            @endif
                                        </div>
                                        
                                        <!-- Benefits -->
                                        <div class="mb-3">
                                            <div class="benefit-item">
                                                <i class="bi bi-check-circle-fill me-2"></i>Akses semua wahana seru
                                            </div>
                                            <div class="benefit-item">
                                                <i class="bi bi-check-circle-fill me-2"></i>Akses semua restoran premium
                                            </div>
                                            <div class="benefit-item">
                                                <i class="bi bi-check-circle-fill me-2"></i>Sistem antrian digital pintar
                                            </div>
                                            <div class="benefit-item">
                                                <i class="bi bi-check-circle-fill me-2"></i>Free Wi-Fi sepanjang hari
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                        <button class="btn btn-outline-custom btn-sm" type="button" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#ticketModal-{{ $product->id }}">
                                            <i class="bi bi-info-circle me-1"></i>Detail Tiket
                                        </button>
                                        <div class="flex-grow-1 text-end">
                                            <livewire:product-card :product="$product" :key="$product->id" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-ticket-perforated display-1"></i>
                        <h3 class="text-muted mt-3">Oops! Tidak ada tiket ditemukan</h3>
                        <p class="text-muted">Coba ubah kata kunci pencarian atau filter tanggal Anda</p>
                        <button class="btn btn-primary-custom mt-3" onclick="window.location.reload()">
                            <i class="bi bi-arrow-clockwise me-2"></i>Muat Ulang
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Ticket Detail Modals -->
        @foreach($products as $product)
            <div class="modal fade" id="ticketModal-{{ $product->id }}" tabindex="-1" aria-labelledby="ticketModalLabel-{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
                        <!-- Modal Header with Gradient -->
                        <div class="modal-header position-relative" style="background: linear-gradient(135deg, var(--primary), #3a9d94); color: white; border: none; padding: 2rem;">
                            <div class="d-flex align-items-center w-100">
                                <div class="me-4">
                                    <div class="bg-white bg-opacity-20 rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                        <img src="{{ $product->getLogoUrl() }}" 
                                             class="img-fluid" 
                                             style="max-width: 50px; max-height: 50px; object-fit: contain;" 
                                             alt="{{ $product->name }}"
                                             onerror="this.src='{{ asset('img/default-placeholder.svg') }}'">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="modal-title fw-bold mb-2" id="ticketModalLabel-{{ $product->id }}">
                                        {{ $product->name }}
                                    </h4>
                                    <p class="mb-0 opacity-90">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $product->location }}
                                    </p>
                                </div>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <!-- Promo Badge in Modal -->
                            @if($product->price < $product->price_before)
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-danger bg-opacity-90" style="font-size: 0.75rem; padding: 6px 12px;">
                                        <i class="bi bi-fire me-1"></i>PROMO SPESIAL
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Modal Body -->
                        <div class="modal-body p-4">
                            <!-- Pricing Section -->
                            <div class="mb-4 p-3 rounded-3" style="background: linear-gradient(135deg, #f8f9fa, var(--light)); border: 1px solid #e9ecef;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-2">
                                            <span class="h3 mb-0 fw-bold" style="color: var(--primary);">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                            @if($product->price < $product->price_before)
                                                <span class="text-decoration-line-through text-muted">
                                                    Rp {{ number_format($product->price_before, 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>
                                        @if($product->price < $product->price_before)
                                            <small class="text-success fw-semibold">
                                                <i class="bi bi-arrow-down me-1"></i>
                                                Hemat Rp {{ number_format($product->price_before - $product->price, 0, ',', '.') }}!
                                            </small>
                                        @endif
                                    </div>
                                    <div class="text-end">
                                        <livewire:product-card :product="$product" :key="'modal-'.$product->id" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Benefits Section -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">
                                    <i class="bi bi-star-fill me-2" style="color: var(--warning);"></i>Keuntungan Tiket
                                </h6>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-check-circle-fill me-2" style="color: var(--primary);"></i>
                                            <span class="small">Akses semua wahana seru</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-check-circle-fill me-2" style="color: var(--primary);"></i>
                                            <span class="small">Akses semua restoran premium</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-check-circle-fill me-2" style="color: var(--primary);"></i>
                                            <span class="small">Sistem antrian digital pintar</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-check-circle-fill me-2" style="color: var(--primary);"></i>
                                            <span class="small">Free Wi-Fi sepanjang hari</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Terms and Conditions -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3" style="color: var(--primary);">
                                    <i class="bi bi-file-text me-2"></i>Syarat & Ketentuan
                                </h6>
                                <div class="p-3 rounded-3" style="background: linear-gradient(135deg, #f8f9fa, #ffffff); border-left: 4px solid var(--primary);">
                                    @if($product->terms_and_conditions)
                                        <p class="mb-0 text-dark small" style="line-height: 1.6;">
                                            {{ $product->terms_and_conditions }}
                                        </p>
                                    @else
                                        <p class="mb-0 text-muted small" style="font-style: italic;">
                                            Syarat dan ketentuan akan diinformasikan lebih lanjut setelah pembelian tiket.
                                        </p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Usage Instructions -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3" style="color: var(--secondary);">
                                    <i class="bi bi-lightbulb me-2"></i>Cara Penggunaan
                                </h6>
                                <div class="p-3 rounded-3" style="background: linear-gradient(135deg, var(--bs-warning-bg-subtle), var(--bs-body-bg)); border-left: 4px solid var(--bs-secondary);">
                                    @if($product->usage)
                                        <p class="mb-0 text-dark small" style="line-height: 1.6;">
                                            {{ $product->usage }}
                                        </p>
                                    @else
                                        <p class="mb-0 text-muted small" style="font-style: italic;">
                                            Panduan penggunaan tiket akan diberikan setelah pembelian.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer border-0 p-4 pt-0">
                            <div class="d-flex justify-content-center w-100">
                                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                    <i class="bi bi-arrow-left me-2"></i>Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Cart Actions -->
        @if(count($products) > 0)
        <div class="cart-section">
            <div class="text-center mb-4">
                <h3 class="fw-bold">Siap untuk petualangan seru?</h3>
                <p class="text-muted">Lihat keranjang belanja atau langsung checkout untuk mendapatkan tiketmu!</p>
            </div>
            <div class="row g-3 justify-content-center">
                <div class="col-md-4">
                    <a href="/cartPage" class="btn btn-outline-custom w-100 py-3 d-flex align-items-center justify-content-center" wire:navigate>
                        <i class="bi bi-cart3 me-2"></i>
                        <span>Lihat Keranjang</span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/cart-checkout" class="btn btn-primary-custom w-100 py-3 d-flex align-items-center justify-content-center" wire:navigate>
                        <i class="bi bi-credit-card me-2"></i>
                        <span>Checkout Sekarang</span>
                    </a>
                </div>
            </div>
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="bi bi-shield-check me-1"></i>
                    Pembayaran 100% aman dengan enkripsi SSL
                </small>
            </div>
        </div>
        @endif
    </div>
</div>
