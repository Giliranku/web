@push('styles')
@vite([
    'resources/css/login-page.css',
    'resources/css/register-page.css',
])
<style>
    .login-container {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--bs-light) 0%, var(--bs-gray-300) 100%);
    }
    
    .login-card {
        background: var(--bs-body-bg);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px var(--bs-box-shadow-lg);
        border: 1px solid var(--bs-border-color-translucent);
    }
    
    .form-control {
        border: 2px solid var(--bs-border-color);
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: var(--bs-body-bg);
        color: var(--bs-body-color);
    }
    
    .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem var(--bs-primary-bg-subtle);
        background: var(--bs-body-bg);
        transform: translateY(-2px);
    }
    
    .btn-primary {
        /* background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary-dark) 100%); */
        border: none;
        border-radius: 12px;
        padding: 15px 30px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px var(--bs-primary-bg-subtle);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px var(--bs-primary-bg-subtle);
    }
    
    .btn-google {
        background: var(--bs-body-bg);
        border: 2px solid var(--bs-border-color);
        border-radius: 12px;
        padding: 15px 30px;
        color: var(--bs-body-color);
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px var(--bs-box-shadow);
    }
    
    .btn-google:hover {
        border-color: #4285f4;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(66, 133, 244, 0.2);
        color: #4285f4;
    }
    
    .password-toggle {
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--bs-secondary-color);
        font-size: 18px;
        transition: color 0.3s ease;
    }
    
    .password-toggle:hover {
        color: var(--bs-primary);
    }
    
    .divider {
        position: relative;
        text-align: center;
        margin: 30px 0;
    }
    
    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--bs-border-color), transparent);
    }
    
    .divider span {
        background: var(--bs-body-bg);
        padding: 0 20px;
        color: var(--bs-secondary-color);
        font-size: 14px;
    }
    
    .alert {
        border: none;
        border-radius: 12px;
        padding: 15px 20px;
        background: var(--bs-danger-bg-subtle);
        color: var(--bs-danger-text-emphasis);
        border-left: 4px solid var(--bs-danger);
    }
    
    .social-links {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 30px;
    }
    
    .social-links i {
        font-size: 20px;
        color: var(--bs-secondary-color);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .social-links i:hover {
        color: var(--bs-primary);
        transform: translateY(-2px);
    }

    /* Mobile styles */
    @media (max-width: 768px) {
        .mobile-header {
            background: linear-gradient(135deg, var(--bs-dark) 0%, var(--bs-gray-900) 100%);
        }
        
        .mobile-card {
            background: var(--bs-body-bg);
            border-radius: 30px 30px 0 0;
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }
        
        .tab-button {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .tab-active {
            background: #4f46e5;
            color: white;
        }
        
        .tab-inactive {
            background: #f3f4f6;
            color: #6b7280;
        }
    }
</style>
@endpush

@push('scripts')
    <script>
        // Password toggle functionality for desktop and mobile
        document.addEventListener('livewire:navigated', function() {
            // Desktop password toggle
            const togglePassword = document.getElementById('togglePassword');
            const inputPassword = document.getElementById('inputPassword');
            
            if (togglePassword && inputPassword) {
                togglePassword.addEventListener('click', function() {
                    const type = inputPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                    inputPassword.setAttribute('type', type);
                    
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }

            // Mobile password toggle
            const togglePasswordMobile = document.getElementById('togglePasswordMobile');
            const inputPasswordMobile = document.getElementById('inputPasswordMobile');
            
            if (togglePasswordMobile && inputPasswordMobile) {
                togglePasswordMobile.addEventListener('click', function() {
                    const type = inputPasswordMobile.getAttribute('type') === 'password' ? 'text' : 'password';
                    inputPasswordMobile.setAttribute('type', type);
                    
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }
        });
    </script>
@endpush

<div class="login-container">
    {{-- DESKTOP VIEW --}}
    <div class="d-none d-md-flex align-items-center justify-content-center min-vh-100 p-4">
        <div class="login-card p-5" style="width: 100%; max-width: 450px;">
            
            {{-- Logo --}}
            <div class="text-center mb-4">
                <a href="/" wire:navigate>
                    <img src="{{ asset('img/ancol-logo.png') }}" alt="Logo Ancol" style="height: 60px;">
                </a>
            </div>

            {{-- Title --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold  mb-2">Selamat Datang</h2>
                <p class="text-muted">Masuk ke akun Giliranku Anda</p>
            </div>

            {{-- Login Form --}}
            <form wire:submit="login">
                
                {{-- Error Alert --}}
                @if ($error)
                    <div class="alert alert-dismissible fade show mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Email Input --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold  mb-2">Email</label>
                    <input type="email" class="form-control" wire:model="email" placeholder="Masukkan email Anda">
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold  mb-2">Password</label>
                    <div class="position-relative">
                        <input type="password" id="inputPassword" class="form-control pe-5" wire:model="password" placeholder="Masukkan password Anda">
                        <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Forgot Password --}}
                <div class="text-end mb-4">
                    <a href="#" class="text-muted small text-decoration-none">Lupa password?</a>
                </div>

                {{-- Login Button --}}
                <button type="submit" class="btn btn-primary w-100 mb-4 text-light  " wire:loading.attr="disabled">
                    <span wire:loading.remove>Masuk</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                        Memproses...
                    </span>
                </button>

                {{-- Divider --}}
                <div class="divider">
                    <span>atau masuk dengan</span>
                </div>

                {{-- Google Login --}}
                <a href="{{ route('google.redirect') }}" class="btn btn-google w-100 d-flex align-items-center justify-content-center">
                    <img class="me-2" src="{{ asset('img/Google-G-logo.png') }}" style="width: 20px;" alt="Google">
                    Masuk dengan Google
                </a>

            </form>

            {{-- Register Link --}}
            <div class="text-center mt-4">
                <span class="text-muted">Belum punya akun?</span>
                <a href="/register" wire:navigate class="text-decoration-none fw-semibold" style="color: var(--bs-primary);">Daftar sekarang</a>
            </div>

            {{-- Social Links --}}
            <div class="social-links">
                <i class="bi bi-linkedin"></i>
                <i class="bi bi-twitter-x"></i>
                <i class="bi bi-facebook"></i>
                <i class="bi bi-instagram"></i>
            </div>
        </div>
    </div>

    {{-- MOBILE VIEW --}}
    <div class="d-block d-md-none mobile-header">
        <div class="container-fluid px-0">
            {{-- Header with logo --}}
            <div class="position-relative p-4">
                <a href="/" wire:navigate class="position-absolute top-0 start-0 m-3">
                    <img src="{{ asset('/img/logo-giliranku.png') }}" alt="Logo" style="height: 30px;">
                </a>
                <div class="d-flex justify-content-center" style="height: 200px; overflow: hidden;">
                    <img src="{{ asset('img/imagehape.png') }}" alt="Cover" 
                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 0 0 20px 20px;">
                </div>
            </div>

            {{-- Content Card --}}
            <div class="mobile-card px-4 pt-4 pb-5">
                <div class="d-flex flex-column align-items-center">
                    
                    {{-- Logo Ancol --}}
                    <img src="{{ asset('img/ancol-logo.png') }}" alt="Logo Ancol" class="mb-4" style="height: 50px;">

                    {{-- Tab Buttons --}}
                    <div class="d-flex w-100 justify-content-center mb-4">
                        <a href="/login" class="tab-button tab-active flex-fill text-center" wire:navigate>
                            Masuk
                        </a>
                        <a href="/register" class="tab-button tab-inactive flex-fill text-center" wire:navigate>
                            Bergabung
                        </a>
                    </div>

                    {{-- Login Form --}}
                    <form wire:submit="login" class="w-100">
                        
                        {{-- Error Alert --}}
                        @if ($error)
                            <div class="alert alert-dismissible fade show text-center mb-4">
                                <i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Email Input --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold  small">Email</label>
                            <input type="email" class="form-control rounded-pill px-4 py-3" 
                                   placeholder="Masukkan email Anda" wire:model="email">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password Input --}}
                        <div class="mb-3 position-relative">
                            <label class="form-label fw-semibold  small">Password</label>
                            <input type="password" id="inputPasswordMobile" 
                                   class="form-control rounded-pill px-4 py-3 pe-5" 
                                   placeholder="Masukkan password Anda" wire:model="password">
                            <i class="bi bi-eye-slash password-toggle" id="togglePasswordMobile" 
                               style="position: absolute; top: 60%; right: 20px; transform: translateY(-50%); cursor: pointer; color: var(--bs-secondary-color);"></i>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Forgot Password --}}
                        <div class="mb-3 text-end">
                            <a href="#" class="text-muted small">Lupa password?</a>
                        </div>

                        {{-- Login Button --}}
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-3" wire:loading.attr="disabled">
                                <span wire:loading.remove>Masuk</span>
                                <span wire:loading>
                                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                    Memproses...
                                </span>
                            </button>
                        </div>

                        {{-- Divider --}}
                        <div class="divider">
                            <span>atau masuk dengan</span>
                        </div>

                        {{-- Google Login --}}
                        <div class="mb-4">
                            <a href="{{ route('google.redirect') }}" 
                               class="btn btn-google w-100 rounded-pill py-3 d-flex align-items-center justify-content-center">
                                <img class="me-2" src="{{ asset('img/Google-G-logo.png') }}" style="width: 18px;" alt="Google">
                                Masuk dengan Google
                            </a>
                        </div>

                        {{-- Register Link --}}
                        <div class="text-center mb-3">
                            <span class="text-muted">Belum ada akun?</span>
                            <a href="/register" wire:navigate class="fw-semibold" style="color: var(--bs-primary);">Daftar sekarang!</a>
                        </div>
                    </form>

                    {{-- Social Links --}}
                    <div class="social-links">
                        <i class="bi bi-linkedin"></i>
                        <i class="bi bi-twitter-x"></i>
                        <i class="bi bi-facebook"></i>
                        <i class="bi bi-instagram"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>