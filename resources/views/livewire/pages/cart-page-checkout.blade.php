@push('styles')
    @vite(['resources/sass/app.scss', 'resources/css/main.css', 'resources/css/cart-modern.css'])
@endpush

<div class="cart-container">
    <div class="container-fluid px-4">
        <!-- Modern Header -->
        <div class="cart-card mb-4 animate-fade-in">
            <div class="cart-header">
                <div class="d-flex align-items-center">
                    <a href="{{ route('cart-page') }}" wire:navigate class="back-button me-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h2 class="mb-0">Checkout Pembayaran</h2>
                </div>
                <p class="mb-0 mt-2 opacity-90">
                    <i class="fas fa-lock me-2"></i>Transaksi Anda dilindungi dengan keamanan tingkat tinggi
                </p>
            </div>
        </div>

        <div class="row">
            <!-- Payment Form -->
            <div class="col-lg-8 mb-4">
                <form wire:submit="madePayment" class="animate-slide-in-up" style="animation-delay: 0.1s;">
                    @if (session('success'))
                        <div class="alert alert-success alert-modern animate-fade-in" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-modern animate-fade-in" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    <!-- Contact Information -->
                    <div class="form-section animate-slide-in-up" style="animation-delay: 0.2s;">
                        <div class="form-section-header">
                            <h5>
                                <i class="fas fa-user text-primary"></i>
                                Informasi Kontak
                            </h5>
                            @auth
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Data diambil dari profil Anda, dapat diubah jika diperlukan
                            </small>
                            @endauth
                        </div>
                        <div class="form-section-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="namaLengkap" class="form-label">
                                        <i class="fas fa-id-card me-1"></i>Nama Lengkap
                                        @auth
                                        <span class="badge bg-info-subtle text-info ms-2 small">
                                            <i class="fas fa-user-check me-1"></i>Dari Profil
                                        </span>
                                        @endauth
                                    </label>
                                    <input type="text" wire:model="namaLengkap" class="form-control" id="namaLengkap" 
                                           placeholder="Masukkan nama lengkap Anda">
                                    @error('namaLengkap')
                                        <div class="text-danger small mt-1">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-1"></i>Email
                                        @auth
                                        <span class="badge bg-info-subtle text-info ms-2 small">
                                            <i class="fas fa-user-check me-1"></i>Dari Profil
                                        </span>
                                        @endauth
                                    </label>
                                    <input type="email" wire:model="email" class="form-control" id="email" 
                                           placeholder="contoh@email.com">
                                    @error('email')
                                        <div class="text-danger small mt-1">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="noTelp" class="form-label">
                                        <i class="fas fa-phone me-1"></i>Nomor Telepon
                                        @auth
                                        <span class="badge bg-info-subtle text-info ms-2 small">
                                            <i class="fas fa-user-check me-1"></i>Dari Profil
                                        </span>
                                        @endauth
                                    </label>
                                    <input type="tel" wire:model="noTelp" class="form-control" id="noTelp" 
                                           placeholder="08xxxxxxxxxx">
                                    @error('noTelp')
                                        <div class="text-danger small mt-1">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                @auth
                                <div class="col-md-6 mb-3 d-flex align-items-end">
                                    <div class="alert alert-info alert-modern w-100 mb-0">
                                        <i class="fas fa-lightbulb me-2"></i>
                                        <small><strong>Tips:</strong> Pastikan data kontak akurat untuk konfirmasi tiket</small>
                                    </div>
                                </div>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="form-section animate-slide-in-up" style="animation-delay: 0.3s;">
                        <div class="form-section-header">
                            <h5>
                                <i class="fas fa-credit-card text-primary"></i>
                                Pilih Metode Pembayaran
                            </h5>
                        </div>
                        <div class="form-section-body">
                            <div class="payment-method-grid">
                                <div class="payment-method">
                                    <input wire:model.live="metode" class="form-check-input d-none" id="mastercard" 
                                           type="radio" value="mastercard" name="metode" />
                                    <label for="mastercard" class="payment-card">
                                        <div class="payment-icon-wrapper">
                                            <i class="fab fa-cc-mastercard payment-icon" style="color: var(--bs-danger); font-size: 2rem;"></i>
                                        </div>
                                        <div class="payment-info">
                                            <h6 class="payment-label mb-1">Mastercard</h6>
                                            <small class="text-muted">Kartu kredit/debit</small>
                                        </div>
                                        <div class="payment-check">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                                <div class="payment-method">
                                    <input wire:model.live="metode" class="form-check-input d-none" id="ovo" 
                                           type="radio" name="metode" value="ovo" />
                                    <label for="ovo" class="payment-card">
                                        <div class="payment-icon-wrapper">
                                            <i class="fas fa-mobile-alt payment-icon" style="color: var(--bs-primary); font-size: 2rem;"></i>
                                        </div>
                                        <div class="payment-info">
                                            <h6 class="payment-label mb-1">OVO</h6>
                                            <small class="text-muted">E-wallet digital</small>
                                        </div>
                                        <div class="payment-check">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                                <div class="payment-method">
                                    <input wire:model.live="metode" class="form-check-input d-none" id="bca" 
                                           type="radio" name="metode" value="bca" />
                                    <label for="bca" class="payment-card">
                                        <div class="payment-icon-wrapper">
                                            <i class="fas fa-university payment-icon" style="color: var(--bs-info); font-size: 2rem;"></i>
                                        </div>
                                        <div class="payment-info">
                                            <h6 class="payment-label mb-1">BCA Virtual Account</h6>
                                            <small class="text-muted">Transfer bank instan</small>
                                        </div>
                                        <div class="payment-check">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @error('metode')
                                <div class="alert alert-danger alert-modern">
                                    <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment Method Details -->
                    @if ($metode === 'mastercard')
                        <div class="form-section animate-slide-in-up" style="animation-delay: 0.4s;">
                            <div class="form-section-header">
                                <h6 class="mb-0 fw-bold text-warning">
                                    <i class="fab fa-cc-mastercard me-2"></i>Detail Kartu Mastercard
                                </h6>
                            </div>
                            <div class="form-section-body">
                                <div class="alert alert-info alert-modern mb-4">
                                    <i class="fas fa-shield-alt me-2"></i>
                                    Informasi kartu Anda dilindungi dengan enkripsi SSL 256-bit
                                </div>
                                <div class="mb-3">
                                    <label for="ccn" class="form-label">
                                        <i class="fas fa-credit-card me-1"></i>Nomor Kartu
                                    </label>
                                    <input id="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}"
                                        autocomplete="cc-number" maxlength="19" placeholder="1234 5678 9012 3456"
                                        class="form-control" wire:model="cardNumber">
                                    @error('cardNumber')
                                        <div class="text-danger small mt-1">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal" class="form-label">
                                            <i class="fas fa-calendar me-1"></i>Berlaku Hingga
                                        </label>
                                        <input type="month" wire:model="cardExpiry" class="form-control" id="tanggal">
                                        @error('cardExpiry')
                                            <div class="text-danger small mt-1">
                                                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cvv" class="form-label">
                                            <i class="fas fa-lock me-1"></i>CVV
                                        </label>
                                        <input type="password" wire:model="cvv" class="form-control" id="cvv" 
                                               maxlength="4" placeholder="•••">
                                        @error('cvv')
                                            <div class="text-danger small mt-1">
                                                <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($metode === 'ovo')
                        <div class="form-section animate-slide-in-up" style="animation-delay: 0.4s;">
                            <div class="form-section-header">
                                <h6 class="mb-0 fw-bold" style="color: var(--bs-primary);">
                                    <i class="fas fa-mobile-alt me-2"></i>Detail OVO
                                </h6>
                            </div>
                            <div class="form-section-body">
                                <div class="alert alert-info alert-modern mb-4">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Pastikan nomor telepon Anda terdaftar di aplikasi OVO
                                </div>
                                <div class="mb-3">
                                    <label for="ovoPhone" class="form-label">
                                        <i class="fas fa-phone me-1"></i>Nomor Telepon OVO
                                        @auth
                                        <span class="badge bg-primary-subtle text-primary ms-2 small">
                                            <i class="fas fa-sync me-1"></i>Auto-filled
                                        </span>
                                        @endauth
                                    </label>
                                    <input type="tel" wire:model="ovoPhone" class="form-control" id="ovoPhone" 
                                           placeholder="08xxxxxxxxxx">
                                    @auth
                                    <small class="text-muted mt-1 d-block">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Nomor diambil dari profil Anda, ubah jika nomor OVO berbeda
                                    </small>
                                    @endauth
                                    @error('ovoPhone')
                                        <div class="text-danger small mt-1">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @elseif ($metode === 'bca')
                        <div class="form-section animate-slide-in-up" style="animation-delay: 0.4s;">
                            <div class="form-section-header">
                                <h6 class="mb-0 fw-bold text-primary">
                                    <i class="fas fa-university me-2"></i>BCA Virtual Account
                                </h6>
                            </div>
                            <div class="form-section-body">
                                <div class="alert alert-info alert-modern">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Mudah dan Cepat!</strong><br>
                                    Nomor Virtual Account akan otomatis dibuat setelah konfirmasi pesanan. 
                                    Transfer dapat dilakukan melalui ATM, Internet Banking, atau Mobile Banking BCA.
                                </div>
                                <div class="row text-center mt-4">
                                    <div class="col-4">
                                        <i class="fas fa-university text-primary mb-2 fs-4"></i>
                                        <small class="d-block text-muted fw-medium">ATM BCA</small>
                                    </div>
                                    <div class="col-4">
                                        <i class="fas fa-laptop text-primary mb-2 fs-4"></i>
                                        <small class="d-block text-muted fw-medium">KlikBCA</small>
                                    </div>
                                    <div class="col-4">
                                        <i class="fas fa-mobile-alt text-primary mb-2 fs-4"></i>
                                        <small class="d-block text-muted fw-medium">myBCA</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="animate-slide-in-up" style="animation-delay: 0.5s;">
                        <button type="submit" class="btn btn-cart-primary w-100 py-3 fw-bold fs-5">
                            <i class="fas fa-lock me-2"></i>Bayar Sekarang - Rp {{ number_format($totalAmount) }}
                        </button>
                        <p class="text-center mt-3 text-muted small">
                            <i class="fas fa-shield-alt me-1"></i>
                            Dengan melanjutkan, Anda menyetujui syarat dan ketentuan kami
                        </p>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary animate-slide-in-up" style="animation-delay: 0.6s;">
                    <div class="order-summary-header">
                        <h5><i class="fas fa-receipt me-2"></i>Detail Pesanan</h5>
                    </div>
                    <div class="order-summary-body">
                        @foreach ($cartItems as $item)
                            <div class="d-flex align-items-center mb-3 pb-3 border-bottom" wire:key="checkout-{{ $item['product']->id }}">
                                <div class="ticket-icon-wrapper me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-ticket-alt ticket-icon" style="font-size: 1.2rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold">{{ $item['product']->name }}</h6>
                                    <small class="text-muted">{{ $item['quantity'] }}x tiket</small>
                                    <div class="mt-1">
                                        <span class="badge bg-success-subtle text-success small">
                                            <i class="fas fa-check me-1"></i>Full Access
                                        </span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold text-primary">Rp {{ number_format($item['subtotal']) }}</div>
                                </div>
                            </div>
                        @endforeach

                        <div class="summary-row">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-medium">Rp {{ number_format($totalAmount) }}</span>
                        </div>
                        <div class="summary-row">
                            <span class="text-muted">Biaya Admin</span>
                            <span class="fw-medium text-success">Gratis</span>
                        </div>
                        <div class="summary-row">
                            <span class="text-muted">Biaya Layanan</span>
                            <span class="fw-medium text-success">Gratis</span>
                        </div>
                        <hr class="my-3">
                        <div class="summary-row summary-total">
                            <span class="fw-bold">Total Pembayaran</span>
                            <span class="fw-bold">Rp {{ number_format($totalAmount) }}</span>
                        </div>

                        <!-- Trust Indicators -->
                        <div class="mt-4 pt-4 border-top">
                            <h6 class="fw-bold mb-3 text-center">Keamanan Terjamin</h6>
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <i class="fas fa-shield-alt text-success mb-2 fs-4"></i>
                                    <small class="d-block text-muted fw-medium">SSL Encryption</small>
                                </div>
                                <div class="col-6 mb-3">
                                    <i class="fas fa-lock text-primary mb-2 fs-4"></i>
                                    <small class="d-block text-muted fw-medium">Secure Payment</small>
                                </div>
                                <div class="col-6">
                                    <i class="fas fa-ticket-alt text-warning mb-2 fs-4"></i>
                                    <small class="d-block text-muted fw-medium">Instant E-Ticket</small>
                                </div>
                                <div class="col-6">
                                    <i class="fas fa-headset text-info mb-2 fs-4"></i>
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

@push('scripts')
<script>
document.addEventListener('livewire:navigated', function() {
    // Auto format credit card number
    const cardInput = document.getElementById('ccn');
    if (cardInput) {
        cardInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            if (formattedValue !== value) {
                e.target.value = formattedValue;
            }
        });
    }
});
</script>
@endpush
