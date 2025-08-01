<div class="min-vh-100 d-flex align-items-center justify-content-center modern-login-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="login-card">
                    <!-- Logo and Title -->
                    <div class="text-center mb-4">
                        <div class="logo-container mb-3">
                            <img src="{{ asset('img/logo-giliranku.png') }}" alt="Giliranku" class="login-logo">
                        </div>
                        <h1 class="login-title">Admin Panel</h1>
                        <p class="login-subtitle">Masuk ke dashboard administratif</p>
                    </div>

                    <form wire:submit="login" class="login-form">
                        <!-- Error Alert -->
                        @if ($error)
                            <div class="modern-alert error mb-4">
                                <div class="alert-icon">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div class="alert-content">
                                    <span>{{ $error }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Email Input -->
                        <div class="modern-input-group mb-3">
                            <label for="email" class="modern-label">Email Administrator</label>
                            <div class="modern-input-wrapper">
                                <div class="input-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <input 
                                    type="email" 
                                    class="modern-input @error('email') error @enderror" 
                                    id="email"
                                    wire:model="email" 
                                    placeholder="Masukkan email"
                                    required>
                            </div>
                            @error('email')
                                <div class="input-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="modern-input-group mb-4">
                            <label for="password" class="modern-label">Kata Sandi</label>
                            <div class="modern-input-wrapper">
                                <div class="input-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <input 
                                    type="password" 
                                    class="modern-input @error('password') error @enderror" 
                                    id="password"
                                    wire:model="password" 
                                    placeholder="Masukkan kata sandi"
                                    required>
                                <button 
                                    type="button" 
                                    class="password-toggle"
                                    onclick="togglePassword()"
                                    tabindex="-1">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="input-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="modern-btn primary w-100 mb-4">
                            <span class="btn-text">Masuk ke Admin Panel</span>
                            <i class="fas fa-arrow-right btn-icon"></i>
                        </button>
                    </form>

                    <!-- Footer -->
                    <div class="login-footer">
                        <p>&copy; 2025 Giliranku Theme Park</p>
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
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Add ripple effect to buttons
document.addEventListener('livewire:navigated', function() {
    const buttons = document.querySelectorAll('.modern-btn');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.height, rect.width);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});
</script>
@endpush

@push('styles')
<style>
/* Modern Login Styles using Giliranku Color Palette */

.modern-login-bg {
    background: linear-gradient(135deg, #4ABDAC 0%, #36A394 50%, #2A8A7E 100%);
    position: relative;
    overflow: hidden;
}

.modern-login-bg::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: 
        radial-gradient(circle at 20% 20%, rgba(252, 74, 26, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(247, 183, 51, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    33% { transform: translate(30px, -30px) rotate(120deg); }
    66% { transform: translate(-20px, 20px) rotate(240deg); }
}

.login-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 3rem 2.5rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.1),
        0 1px 3px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.6);
    position: relative;
    max-width: 450px;
    margin: 0 auto;
}

.logo-container {
    position: relative;
}

.login-logo {
    width: 80px;
    height: 80px;
    object-fit: contain;
    filter: drop-shadow(0 4px 8px rgba(74, 189, 172, 0.3));
}

.login-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2A8A7E;
    margin: 0;
    letter-spacing: -0.02em;
}

.login-subtitle {
    color: #6c757d;
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
    font-weight: 400;
}

.modern-input-group {
    position: relative;
}

.modern-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #4ABDAC;
    margin-bottom: 0.5rem;
    letter-spacing: 0.025em;
}

.modern-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon {
    position: absolute;
    left: 1rem;
    z-index: 2;
    color: #4ABDAC;
    font-size: 1rem;
}

.modern-input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 500;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    color: #000000;
}

.modern-input:focus {
    outline: none;
    border-color: #4ABDAC;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 0 0 3px rgba(74, 189, 172, 0.1);
    transform: translateY(-1px);
}

.modern-input.error {
    border-color: #FC4A1A;
    background: rgba(252, 74, 26, 0.05);
}

.modern-input.error:focus {
    border-color: #FC4A1A;
    box-shadow: 0 0 0 3px rgba(252, 74, 26, 0.1);
}

.password-toggle {
    position: absolute;
    right: 1rem;
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 6px;
    transition: all 0.2s ease;
    z-index: 2;
}

.password-toggle:hover {
    color: #4ABDAC;
    background: rgba(74, 189, 172, 0.1);
}

.input-error {
    color: #FC4A1A;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 500;
}

.modern-alert {
    padding: 1rem;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
}

.modern-alert.error {
    background: rgba(252, 74, 26, 0.1);
    border: 1px solid rgba(252, 74, 26, 0.2);
    color: #FC4A1A;
}

.alert-icon {
    font-size: 1.25rem;
}

.alert-content {
    flex: 1;
}

.modern-btn {
    position: relative;
    overflow: hidden;
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
    letter-spacing: 0.025em;
}

.modern-btn.primary {
    background: linear-gradient(135deg, #4ABDAC 0%, #36A394 100%);
    color: #FFFFFF;
    box-shadow: 
        0 4px 15px rgba(74, 189, 172, 0.4),
        0 1px 3px rgba(0, 0, 0, 0.1);
}

.modern-btn.primary:hover {
    transform: translateY(-2px);
    box-shadow: 
        0 8px 25px rgba(74, 189, 172, 0.5),
        0 3px 6px rgba(0, 0, 0, 0.15);
}

.modern-btn.primary:active {
    transform: translateY(0);
}

.btn-icon {
    transition: transform 0.3s ease;
}

.modern-btn:hover .btn-icon {
    transform: translateX(3px);
}

.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
    transform: scale(0);
    animation: ripple-animation 0.6s linear;
    pointer-events: none;
}

@keyframes ripple-animation {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

.login-footer {
    text-align: center;
    margin-top: 2rem;
}

.login-footer p {
    color: #6c757d;
    font-size: 0.875rem;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .login-card {
        padding: 2rem 1.5rem;
        margin: 1rem;
        border-radius: 20px;
    }
    
    .login-title {
        font-size: 1.75rem;
    }
    
    .modern-input {
        padding: 0.875rem 0.875rem 0.875rem 2.75rem;
    }
    
    .input-icon {
        left: 0.875rem;
    }
    
    .password-toggle {
        right: 0.875rem;
    }
}

@media (max-width: 480px) {
    .modern-login-bg {
        padding: 1rem 0;
    }
    
    .login-card {
        padding: 1.5rem 1rem;
        margin: 0.5rem;
    }
    
    .login-title {
        font-size: 1.5rem;
    }
}
</style>
@endpush
