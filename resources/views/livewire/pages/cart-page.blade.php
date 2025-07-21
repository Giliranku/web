@push('styles')
    @vite(['resources/sass/app.scss', 'resources/css/main.css', 'resources/css/cart-modern.css'])
@endpush

<div class="cart-container">
    <div class="container-fluid px-4">
        <!-- Modern Header -->
        <div class="cart-card mb-4 animate-fade-in">
            <div class="cart-header">
                <div class="d-flex align-items-center">
                    <a href="{{ url()->previous() }}" class="back-button me-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h2 class="mb-0">Keranjang Belanja</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <!-- Date Selector -->
                <div class="date-selector-card cart-card mb-4 animate-slide-in-up" style="animation-delay: 0.1s;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-calendar-alt text-primary me-2 fs-5"></i>
                            <h6 class="mb-0 fw-bold text-gray-800">Pilih Tanggal Kunjungan</h6>
                        </div>
                        <livewire:date-selector />
                    </div>
                </div>

                <!-- Cart Items -->
                @forelse ($cartItems as $index => $item)
                    <div class="cart-item animate-slide-in-up" style="animation-delay: {{ 0.2 + ($index * 0.1) }}s;" wire:key="cart-{{ $item['product']->id }}">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center mb-3 mb-md-0">
                                    <div class="ticket-icon-wrapper mx-auto">
                                        <i class="fas fa-ticket-alt ticket-icon"></i>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3 mb-md-0">
                                    <div class="item-details">
                                        <h5 class="mb-1">{{ $item['product']->name }}</h5>
                                        <p class="item-subtitle">
                                            <i class="fas fa-infinity text-primary me-1"></i>
                                            Akses semua wahana & restoran
                                        </p>
                                        <div class="d-flex align-items-center mt-2">
                                            <span class="badge bg-success-subtle text-success me-2">
                                                <i class="fas fa-check me-1"></i>Digital Queue
                                            </span>
                                            <span class="badge bg-info-subtle text-info">
                                                <i class="fas fa-clock me-1"></i>Full Day Access
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center mb-3 mb-md-0">
                                    <div class="item-price">
                                        Rp {{ number_format($item['product']->price) }}
                                    </div>
                                    <small class="text-muted">per tiket</small>
                                </div>
                                <div class="col-md-2 text-end">
                                    <livewire:product-card :product="$item['product']" :key="$item['product']->id" />
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-cart animate-fade-in">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h4>Keranjang Masih Kosong</h4>
                        <p>Yuk mulai jelajahi berbagai tiket menarik yang tersedia!</p>
                                                <a href="{{ route('tiket-ecommerce') }}" wire:navigate class="btn btn-cart-primary">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Tiket
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary animate-slide-in-up" style="animation-delay: 0.4s;">
                    <div class="order-summary-header">
                        <h5><i class="fas fa-receipt me-2"></i>Ringkasan Pesanan</h5>
                    </div>
                    <div class="order-summary-body">
                        @if(!empty($cartItems))
                            @foreach($cartItems as $item)
                                <div class="summary-row">
                                    <span class="text-muted">{{ $item['product']->name }} ({{ $item['quantity'] }}x)</span>
                                    <span class="fw-medium">Rp {{ number_format($item['subtotal']) }}</span>
                                </div>
                            @endforeach
                            <hr class="my-3">
                            <div class="summary-row">
                                <span class="text-muted">Subtotal</span>
                                <span class="fw-medium">Rp {{ number_format($totalAmount) }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="text-muted">Biaya Admin</span>
                                <span class="fw-medium text-success">Gratis</span>
                            </div>
                            <div class="summary-row summary-total">
                                <span class="fw-bold">Total Pembayaran</span>
                                <span class="fw-bold">Rp {{ number_format($totalAmount) }}</span>
                            </div>
                            
                            <div class="mt-4">
                                                                <a href="{{ route('cart-page-checkout') }}" wire:navigate class="btn btn-cart-primary w-100 py-3 fw-bold">
                                    <i class="fas fa-credit-card me-2"></i>
                                    Lanjutkan Pembayaran
                                </a>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-shopping-cart text-muted mb-3 fs-1"></i>
                                <p class="text-muted mb-3">Belum ada item di keranjang</p>
                                <a href="{{ route('tiket-ecommerce') }}" class="btn btn-cart-secondary">
                                    Mulai Belanja
                                </a>
                            </div>
                        @endif

                        <!-- Trust Indicators -->
                        <div class="mt-4 pt-4 border-top">
                            <div class="row text-center">
                                <div class="col-4">
                                    <i class="fas fa-shield-alt text-success mb-2 fs-4"></i>
                                    <small class="d-block text-muted fw-medium">Pembayaran Aman</small>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-mobile-alt text-primary mb-2 fs-4"></i>
                                    <small class="d-block text-muted fw-medium">E-Ticket</small>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-headset text-warning mb-2 fs-4"></i>
                                    <small class="d-block text-muted fw-medium">24/7 Support</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
