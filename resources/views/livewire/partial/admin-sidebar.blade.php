<div x-data :style="$store.sidebar.collapsed ? 'width: 80px; height: 100vh;' : 'width: 250px; height: 100vh;'"
    class="bg-body text-body border-end position-fixed top-0 start-0 d-flex flex-column shadow"
    style="transition: width 0.3s; z-index: 1030;">
    <div class="d-flex justify-content-end p-2">
        <button class="btn btn-sm" @click="$store.sidebar.collapsed = !$store.sidebar.collapsed">
            <i class="bi" :class="$store.sidebar.collapsed ? 'bi-chevron-right' : 'bi-chevron-left'"></i>
        </button>
    </div>

    <!-- Logo dan Judul -->
    <div class="border-bottom flex-shrink-0 d-flex align-items-center position-relative"
        :class="$store.sidebar.collapsed ? 'justify-content-center py-3 flex-column' : 'p-3 ms-3'"
        style="transition: all 0.3s; min-height: 60px;">
        <img src="{{ asset('img/logo-giliranku.png') }}" alt="Logo Giliranku" class="giliranku-sidebar"
            style="height:30px; transition: all 0.3s;" :class="$store.sidebar.collapsed ? 'mx-auto d-block' : ''">
        <span x-cloak x-show="!$store.sidebar.collapsed" x-transition:enter="transition-opacity duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="sidebar-title" style="
                position: absolute;
                left: 60px;
                opacity: 1;
                transition: opacity 0.3s;
            ">Giliranku</span>
    </div>

    <!-- Scrollable menu area -->
    <div class="flex-grow-1 d-flex flex-column" style="min-height:0;">
        <ul class="nav flex-column p-2 flex-grow-1 overflow-x-hidden" style="min-height:0;">
            <li class="nav-item">
                <a href="/admin/dashboard" wire:navigate class="nav-link d-flex align-items-center {{ request()->is('admin/dashboard') ? 'active' : 'text-body-secondary' }}">
                    <i class="bi bi-house"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak
                        class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/manage-users" wire:navigate class="nav-link d-flex align-items-center {{ request()->is('admin/manage-users') ? 'active' : 'text-body-secondary' }}">
                    <i class="bi bi-people-fill"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak
                        class="menu-text">Pengunjung</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/manage-ticket" wire:navigate class="nav-link d-flex align-items-center {{ request()->is('admin/manage-ticket*') ? 'active' : 'text-body-secondary' }}">
                    <i class="fas fa-ticket-alt"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Tiket</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/manage-attractions" wire:navigate class="nav-link d-flex align-items-center {{ request()->is('admin/manage-attractions*') ? 'active' : 'text-body-secondary' }}">
                    <i class="fas fa-star"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Wahana</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/manage-restaurants" wire:navigate class="nav-link d-flex align-items-center {{ request()->is('admin/manage-restaurants*') ? 'active' : 'text-body-secondary' }}">
                    <i class="fas fa-utensils"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak
                        class="menu-text">Restoran</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/manage-staff" wire:navigate class="nav-link d-flex align-items-center {{ request()->is('admin/manage-staff*') ? 'active' : 'text-body-secondary' }}">
                    <i class="fas fa-users"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Staff</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/manage-news" wire:navigate class="nav-link d-flex align-items-center {{ request()->is('admin/manage-news*') ? 'active' : 'text-body-secondary' }}">
                    <i class="bi bi-newspaper"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak
                        class="menu-text">Berita</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/manage-payments" wire:navigate class="nav-link d-flex align-items-center {{ request()->is('admin/manage-payments*') ? 'active' : 'text-body-secondary' }}">
                    <i class="bi bi-credit-card"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak
                        class="menu-text">Pembayaran</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Fixed bottom area -->
    <div 
        class="border-top p-2 d-flex flex-column gap-2 flex-shrink-0"
        :class="$store.sidebar.collapsed ? 'align-items-center' : ''"
        class="sidebar-bg-fix">
        <a 
            href="/admin/manage-support" 
            wire:navigate
            class="btn d-flex align-items-center w-100"
            :class="$store.sidebar.collapsed ? 'justify-content-center px-0' : ''"
            style="transition: all 0.3s;"
        >
            <i class="bi bi-question-circle" :class="$store.sidebar.collapsed ? '' : 'me-2'"></i>
            <span x-cloak style="display:inline-block; overflow:hidden; transition: max-width 0.3s, opacity 0.2s;"
                :style="$store.sidebar.collapsed 
                    ? 'max-width:0; opacity:0; margin-left:0;' 
                    : 'max-width:130px; opacity:1; margin-left:0;'">Kelola Bantuan</span>
        </a>
        <a href="/admin/profile" wire:navigate class="btn d-flex align-items-center w-100"
            :class="$store.sidebar.collapsed ? 'justify-content-center px-0' : ''" style="transition: all 0.3s;">
            <i class="bi bi-person-circle" :class="$store.sidebar.collapsed ? '' : 'me-2'"></i>
            <span x-cloak style="display:inline-block; overflow:hidden; transition: max-width 0.3s, opacity 0.1s;"
                :style="$store.sidebar.collapsed 
                    ? 'max-width:0; opacity:0; margin-left:0;' 
                    : 'max-width:120px; opacity:1; margin-left:0;'">Profile</span>
        </a>
        <button class="btn d-flex align-items-center w-100"
            :class="$store.sidebar.collapsed ? 'justify-content-center px-0' : ''" 
            style="transition: all 0.3s;"
            onclick="if(confirm('Apakah Anda yakin ingin keluar?')) { document.getElementById('logout-form').submit(); }">
            <i class="bi bi-box-arrow-right" :class="$store.sidebar.collapsed ? '' : 'me-2'"></i>
            <span x-cloak style="display:inline-block; overflow:hidden; transition: max-width 0.3s, opacity 0.1s;"
                :style="$store.sidebar.collapsed 
                    ? 'max-width:0; opacity:0; margin-left:0;' 
                    : 'max-width:120px; opacity:1; margin-left:0;'">Keluar</span>
        </button>
        
        <form id="logout-form" action="/admin/logout" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>