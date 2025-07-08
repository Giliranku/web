<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('img/logo-giliranku.png') }}" alt="Logo Giliranku">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
            aria-current="page" href="{{ route('home') }}">
            Beranda
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('tickets.*') ? 'active' : '' }}"
            href="{{ route('tickets.index') }}">
            Beli Tiket
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('queues.*') ? 'active' : '' }}"
            href="{{ route('queues.index') }}">
            Pesan Antrian
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}"
            href="{{ route('news.index') }}">
            Berita
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
            href="{{ route('about') }}">
            Tentang Kami
          </a>
        </li>

      </ul>

      <div class="d-flex navbar-right-font justify-content-center align-items-center me-4 gap-2">
        <i class="bi bi-cart-fill"></i>
        <span class="mx-2">|</span>
        <a href="" class="text-dark text-decoration-none">Masuk</a>
      </div>
    </div>
  </div>
</nav>
