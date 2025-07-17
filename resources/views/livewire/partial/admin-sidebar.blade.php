<div x-data :style="$store.sidebar.collapsed ? 'width: 80px; height: 100vh;' : 'width: 250px; height: 100vh;'"
    class="bg-white text-dark border-end position-fixed top-0 start-0 d-flex flex-column shadow"
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
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="bi bi-house"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak
                        class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="bi bi-people-fill"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak
                        class="menu-text">Pengunjung</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="bi bi-ticket-perforated"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Tiket</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="bi bi-egg-fried"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak
                        class="menu-text">Restoran</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="bi bi-person"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Staff</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="bi bi-newspaper"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak
                        class="menu-text">Berita</span>
                </a>
            </li>
        </ul>

        {{-- kalau udah siap pake backend, nyalain yg di comment ini ya, trs apus yg atas. tp nt ajah tunggu klo dh kelar: -jes- --}}

        {{-- <ul class="nav flex-column p-2 flex-grow-1 overflow-x-hidden" style="min-height:0;">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pengunjung.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.pengunjung.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Pengunjung</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.tiket.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.tiket.*') ? 'active' : '' }}">
                    <i class="bi bi-ticket-perforated"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Tiket</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.restoran.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.restoran.*') ? 'active' : '' }}">
                    <i class="bi bi-egg-fried"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Restoran</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.staff.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
                    <i class="bi bi-person"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Staff</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.berita.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i>
                    <span x-show="!$store.sidebar.collapsed" x-transition.opacity x-cloak class="menu-text">Berita</span>
                </a>
            </li>
        </ul> --}}
    </div>

    <!-- Fixed bottom area -->
    <div 
        class="border-top p-2 d-flex flex-column gap-2 flex-shrink-0"
        :class="$store.sidebar.collapsed ? 'align-items-center' : ''"
        class="sidebar-bg-fix">
        <button 
            class="btn d-flex align-items-center w-100"
            :class="$store.sidebar.collapsed ? 'justify-content-center px-0' : ''"
            style="transition: all 0.3s;"
        >
            <i class="bi bi-question-circle" :class="$store.sidebar.collapsed ? '' : 'me-2'"></i>
            <span x-cloak style="display:inline-block; overflow:hidden; transition: max-width 0.3s, opacity 0.2s;"
                :style="$store.sidebar.collapsed 
                    ? 'max-width:0; opacity:0; margin-left:0;' 
                    : 'max-width:130px; opacity:1; margin-left:0;'">Bantuan</span>
        </button>
        <button class="btn d-flex align-items-center w-100"
            :class="$store.sidebar.collapsed ? 'justify-content-center px-0' : ''" style="transition: all 0.3s;">
            <i class="bi bi-person-circle" :class="$store.sidebar.collapsed ? '' : 'me-2'"></i>
            <span x-cloak style="display:inline-block; overflow:hidden; transition: max-width 0.3s, opacity 0.1s;"
                :style="$store.sidebar.collapsed 
                    ? 'max-width:0; opacity:0; margin-left:0;' 
                    : 'max-width:120px; opacity:1; margin-left:0;'">Profile</span>
        </button>
        <button class="btn d-flex align-items-center w-100"
            :class="$store.sidebar.collapsed ? 'justify-content-center px-0' : ''" style="transition: all 0.3s;">
            <i class="bi bi-box-arrow-right" :class="$store.sidebar.collapsed ? '' : 'me-2'"></i>
            <span x-cloak style="display:inline-block; overflow:hidden; transition: max-width 0.3s, opacity 0.1s;"
                :style="$store.sidebar.collapsed 
                    ? 'max-width:0; opacity:0; margin-left:0;' 
                    : 'max-width:120px; opacity:1; margin-left:0;'">Keluar</span>
        </button>
    </div>
</div>