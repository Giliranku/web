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
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" wire:navigate
             @mouseenter="$el.style.transform = 'translateY(-2px)'"
             @mouseleave="$el.style.transform = 'translateY(0)'">
            <i class="bi bi-house me-1"></i>Beranda
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('tiket-ecommerce') ? 'active' : '' }}" href="{{ route('tiket-ecommerce') }}" wire:navigate
             @mouseenter="$el.style.transform = 'translateY(-2px)'"
             @mouseleave="$el.style.transform = 'translateY(0)'">
            <i class="bi bi-ticket-perforated me-1"></i>Beli Tiket
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('queues.index') ? 'active' : '' }}" href="{{ route('queues.index') }}" wire:navigate
             @mouseenter="$el.style.transform = 'translateY(-2px)'"
             @mouseleave="$el.style.transform = 'translateY(0)'">
            <i class="bi bi-clock-history me-1"></i>Pesan Antrian
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('news.index') ? 'active' : '' }}" href="{{ route('news.index') }}" wire:navigate
             @mouseenter="$el.style.transform = 'translateY(-2px)'"
             @mouseleave="$el.style.transform = 'translateY(0)'">
            <i class="bi bi-newspaper me-1"></i>Berita
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}" wire:navigate
             @mouseenter="$el.style.transform = 'translateY(-2px)'"
             @mouseleave="$el.style.transform = 'translateY(0)'">
            <i class="bi bi-info-circle me-1"></i>Tentang Kami
          </a>
        </li>
      </ul>
      
      <div class="d-flex align-items-center gap-3">
        {{-- Cart Icon --}}
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
        @else
        <a href="{{ route('login') }}" 
           wire:navigate 
           class="cart-icon text-decoration-none" 
           title="Login to shop"
           style="pointer-events: auto !important; z-index: 999 !important;"
           onclick="console.log('Login clicked!'); return true;">
          <i class="bi bi-cart-fill" style="pointer-events: none;"></i>
          @if($cartCount > 0)
            <span class="cart-badge" style="pointer-events: none;">{{ $cartCount }}</span>
          @endif
        </a>
        @endauth

        <div class="navbar-divider d-none d-lg-block"></div>

        @auth
          {{-- Profile Dropdown --}}
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
          {{-- Login Button --}}
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