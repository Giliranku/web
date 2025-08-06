<script>
// Define navbarData immediately for Alpine.js
window.navbarData = function() {
  return {
    isScrolled: false,
    init() {
      // Initialize scroll listener only
      
      // Listen for cart updates from ProductCard
      window.addEventListener('cart-updated', () => {
        // Trigger Livewire refresh for cart count
        @this.call('refreshCartCount');
      });
      
      // Also listen for Livewire cartUpdated event
      document.addEventListener('livewire:init', () => {
        Livewire.on('cartUpdated', () => {
          @this.call('refreshCartCount');
        });
      });
    },
    logout() {
      if (confirm('Apakah Anda yakin ingin keluar?')) {
        document.getElementById('logout-form')?.submit();
      }
    }
  };
};
</script>

<div x-data="navbarData()" x-init="init()" @scroll.window="isScrolled = window.scrollY > 50">
<nav class="navbar navbar-expand-lg sticky-top" :class="{ 'scrolled': isScrolled }">
  <div class="container-fluid px-4">
    <a wire:navigate class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('img/logo-giliranku.png') }}" alt="Logo Giliranku">
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Mobile User Welcome Section -->
      <div class="mobile-welcome-section d-lg-none">
        @auth
        <div class="mobile-user-card">
          <div class="user-avatar-section">
            @if(Auth::user()->avatar)
              @if(str_contains(Auth::user()->avatar, 'http'))
                <img src="{{ Auth::user()->avatar }}" alt="Profile" class="user-avatar">
              @else
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile" class="user-avatar">
              @endif
            @else
              <div class="user-avatar-placeholder">
                <i class="bi bi-person-fill"></i>
              </div>
            @endif
            <div class="user-status-indicator"></div>
          </div>
          <div class="user-info-section">
            <h6 class="user-name">{{ Auth::user()->name }}</h6>
            <p class="user-email">{{ Auth::user()->email }}</p>
            <span class="user-badge">Member Aktif</span>
          </div>
        </div>
        @else
        <div class="mobile-guest-card">
          <div class="guest-icon">
            <i class="bi bi-person-plus"></i>
          </div>
          <div class="guest-info">
            <h6 class="guest-title">Selamat Datang di Giliranku!</h6>
            <p class="guest-subtitle">Masuk untuk mendapatkan pengalaman terbaik</p>
          </div>
        </div>
        @endauth
      </div>
      
      <!-- Navigation Menu -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" wire:navigate>
            <i class="bi bi-house-door"></i>
            <span>Beranda</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('tiket-ecommerce') ? 'active' : '' }}" href="{{ route('tiket-ecommerce') }}" wire:navigate>
            <i class="bi bi-ticket-perforated"></i>
            <span>Beli Tiket</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('queues.index') ? 'active' : '' }}" href="{{ route('queues.index') }}" wire:navigate>
            <i class="bi bi-clock-history"></i>
            <span>Pesan Antrian</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('news.index') ? 'active' : '' }}" href="{{ route('news.index') }}" wire:navigate>
            <i class="bi bi-newspaper"></i>
            <span>Berita</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}" wire:navigate>
            <i class="bi bi-info-circle"></i>
            <span>Tentang Kami</span>
          </a>
        </li>
      </ul>
      
      <!-- Mobile Quick Actions (only visible in mobile menu) -->
      <div class="mobile-quick-actions d-lg-none">
        @auth
        <div class="quick-action-grid">
          <a href="{{ route('cart-page') }}" class="quick-action-item" wire:navigate>
            <div class="action-icon cart">
              <i class="bi bi-cart3"></i>
              @if($cartCount > 0)
                <span class="action-badge">{{ $cartCount }}</span>
              @endif
            </div>
            <span class="action-label">Keranjang</span>
          </a>
          
          <a href="{{ route('userprofile') }}" class="quick-action-item" wire:navigate>
            <div class="action-icon profile">
              <i class="bi bi-person"></i>
            </div>
            <span class="action-label">Profil</span>
          </a>
          
          <a href="{{ route('history') }}" class="quick-action-item" wire:navigate>
            <div class="action-icon history">
              <i class="bi bi-clock-history"></i>
            </div>
            <span class="action-label">Riwayat</span>
          </a>
          
          <button @click="logout()" class="quick-action-item logout-action">
            <div class="action-icon logout">
              <i class="bi bi-box-arrow-right"></i>
            </div>
            <span class="action-label">Keluar</span>
          </button>
        </div>
        @else
        <div class="guest-action-section">
          <a href="{{ route('login') }}" class="guest-action-btn primary" wire:navigate>
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Masuk ke Akun</span>
          </a>
          <a href="{{ route('register') }}" class="guest-action-btn secondary" wire:navigate>
            <i class="bi bi-person-plus"></i>
            <span>Daftar Sekarang</span>
          </a>
        </div>
        @endauth
      </div>

      <!-- Desktop Actions (hidden on mobile) -->
      <div class="d-none d-lg-flex align-items-center gap-3">
        {{-- Desktop Cart Icon - Only show when authenticated --}}
        @auth
        <a href="{{ route('cart-page') }}" 
           wire:navigate 
           class="cart-icon text-decoration-none" 
           title="Cart ({{ $cartCount }} items)"
           style="pointer-events: auto !important; z-index: 999 !important;"
           onclick="console.log('Cart clicked!'); return true;">
          <i class="bi bi-cart-fill" style="pointer-events: none;"></i>
          @if($cartCount > 0)
            <span class="cart-badge" style="pointer-events: none;">{{ $cartCount }}</span>
          @endif
        </a>

        <div class="navbar-divider d-none d-lg-block"></div>
        @endauth

        @auth
          {{-- Desktop Profile Dropdown --}}
          <div class="profile-dropdown" x-data="{ open: false }" @click.away="open = false">
            @if(Auth::user()->avatar)
              @if(str_contains(Auth::user()->avatar, 'http'))
                <img src="{{ Auth::user()->avatar }}" 
                     alt="Profile" 
                     class="profile-avatar"
                     @click="open = !open">
              @else
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                     alt="Profile" 
                     class="profile-avatar"
                     @click="open = !open">
              @endif
            @else
              <div class="profile-avatar d-flex align-items-center justify-content-center bg-body-secondary" @click="open = !open">
                <i class="bi bi-person-fill text-body-secondary" style="font-size: 1.2rem;"></i>
              </div>
            @endif
            
            <div class="profile-menu" :class="{ 'show': open }">
              <div class="profile-header">
                <p class="profile-name">{{ Auth::user()->name }}</p>
                <p class="profile-email">{{ Auth::user()->email }}</p>
              </div>
              
              <a href="{{ route('userprofile') }}" class="profile-menu-item" wire:navigate>
                <i class="bi bi-person"></i>
                Profil Saya
              </a>
              
              <a href="{{ route('history') }}" class="profile-menu-item" wire:navigate>
                <i class="bi bi-clock-history"></i>
                Riwayat Pemesanan
              </a>
              
              <a href="{{ route('cart-page') }}" class="profile-menu-item" wire:navigate>
                <i class="bi bi-cart"></i>
                Keranjang Belanja
              </a>
              
              <hr class="my-2">
              
              <button @click="logout()" class="profile-menu-item text-danger">
                <i class="bi bi-box-arrow-right"></i>
                Keluar
              </button>
            </div>
          </div>
        @else
          {{-- Desktop Login Button --}}
          <a href="{{ route('login') }}" class="login-btn" wire:navigate>
            <i class="bi bi-person"></i>
            Masuk
          </a>
        @endauth
      </div>
    </div>
  </div>
</nav>

{{-- Hidden logout form --}}
@auth
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
@endauth
</div>