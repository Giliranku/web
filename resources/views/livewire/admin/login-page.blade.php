<div class="container-fluid vh-100">
    <div class="row h-100">
        <!-- Left side - Image/Brand -->
        <div class="col-md-6 d-none d-md-flex bg-primary bg-gradient align-items-center justify-content-center">
            <div class="text-center text-white">
                <img src="{{ asset('img/logo-giliranku.png') }}" alt="Logo Giliranku" class="mb-4" style="max-width: 200px;">
                <h2 class="mb-3">Admin Panel</h2>
                <p class="lead">Selamat datang di dashboard admin Giliranku</p>
            </div>
        </div>

        <!-- Right side - Login form -->
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="w-100" style="max-width: 400px;">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <!-- Mobile logo -->
                        <div class="text-center d-md-none mb-4">
                            <img src="{{ asset('img/logo-giliranku.png') }}" alt="Logo Giliranku" style="max-width: 120px;">
                        </div>

                        <h3 class="text-center mb-4 fw-bold">Login Admin</h3>

                        <form wire:submit.prevent="login">
                            <!-- Error Alert -->
                            @if ($error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    {{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input 
                                        type="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        id="email"
                                        wire:model="email" 
                                        placeholder="Masukkan email admin"
                                        required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input 
                                        type="password" 
                                        class="form-control @error('password') is-invalid @enderror" 
                                        id="password"
                                        wire:model="password" 
                                        placeholder="Masukkan password"
                                        required>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword()"
                                        tabindex="-1">
                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Login Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Masuk
                                </button>
                            </div>
                        </form>

                        <!-- Footer -->
                        <div class="text-center mt-4">
                            <small class="text-muted">© 2025 Giliranku Admin Panel</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}
</script>
@endpush



@push('styles')
<style>
.card {
    border-radius: 15px;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.btn-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border: none;
    padding: 12px 0;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
}

.bg-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
}

@media (max-width: 768px) {
    .card-body {
        padding: 2rem !important;
    }
}
</style>
@endpush
