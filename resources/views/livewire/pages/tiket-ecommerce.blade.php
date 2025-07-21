@push('styles')
@vite([
    'resources/sass/app.scss',
    'resources/js/app.js',
    'resources/css/main.css'
])
@endpush

<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="h2 fw-bold text-dark mb-3">Beli Tiket Giliranku</h1>
        <p class="text-muted lead">Satu tiket, akses semua wahana dan restoran!</p>
    </div>

    <!-- Search & Filter -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <livewire:date-selector />
                        <div class="flex-grow-1">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="search" 
                                       class="form-control border-start-0" 
                                       placeholder="Cari tiket..." 
                                       wire:model.live="search">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tickets Grid -->
    <div class="row g-4 mb-5">
        @forelse ($products as $product)
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <!-- Promo Badge -->
                    @if($product->price < $product->price_before)
                        <div class="position-absolute top-0 start-0 m-3 z-1">
                            <span class="badge bg-danger rounded-pill px-3 py-2">
                                <i class="bi bi-fire me-1"></i>Promo
                            </span>
                        </div>
                    @endif
                    
                    <div class="row g-0 h-100">
                        <!-- Ticket Image -->
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-4 bg-light">
                            <img src="{{ asset($product->logo) }}" 
                                 class="img-fluid rounded" 
                                 style="max-width: 120px; max-height: 80px; object-fit: contain;" 
                                 alt="{{ $product->name }}">
                        </div>
                        
                        <!-- Ticket Info -->
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column h-100">
                                <div class="flex-grow-1">
                                    <h5 class="card-title fw-bold text-dark mb-2">{{ $product->name }}</h5>
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $product->location }}
                                    </p>
                                    
                                    <!-- Pricing -->
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="h5 fw-bold text-primary mb-0">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                            @if($product->price < $product->price_before)
                                                <span class="text-muted text-decoration-line-through small">
                                                    Rp {{ number_format($product->price_before, 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Benefits -->
                                    <div class="mb-3">
                                        <small class="text-success d-block">
                                            <i class="bi bi-check-circle-fill me-1"></i>Akses semua wahana
                                        </small>
                                        <small class="text-success d-block">
                                            <i class="bi bi-check-circle-fill me-1"></i>Akses semua restoran
                                        </small>
                                        <small class="text-success d-block">
                                            <i class="bi bi-check-circle-fill me-1"></i>Sistem antrian digital
                                        </small>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" 
                                            data-bs-toggle="collapse" data-bs-target="#details-{{ $product->id }}">
                                        <i class="bi bi-info-circle me-1"></i>Detail
                                    </button>
                                    <livewire:product-card :product="$product" :key="$product->id" />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Collapsible Details -->
                    <div class="collapse" id="details-{{ $product->id }}">
                        <div class="card-footer bg-light border-0">
                            <h6 class="fw-semibold mb-2">Syarat & Ketentuan:</h6>
                            <p class="small text-muted mb-2">{{ Str::limit($product->terms_and_conditions, 150) }}</p>
                            <h6 class="fw-semibold mb-2">Cara Penggunaan:</h6>
                            <p class="small text-muted mb-0">{{ Str::limit($product->usage, 150) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-ticket-perforated display-1 text-muted"></i>
                    <h4 class="text-muted mt-3">Tidak ada tiket yang tersedia</h4>
                    <p class="text-muted">Coba ubah kriteria pencarian Anda</p>
                </div>
            </div>
        @endforelse
    </div>
    <!-- Cart Actions -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="/cartPage" class="btn btn-outline-primary w-100 py-3" wire:navigate>
                                <i class="bi bi-cart3 me-2"></i>Lihat Keranjang
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="/cart-checkout" class="btn btn-primary w-100 py-3" wire:navigate>
                                <i class="bi bi-credit-card me-2"></i>Checkout Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
