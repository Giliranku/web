<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="{{ asset('img/logo-giliranku.png') }}" alt="Logo Giliranku"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Beli Tiket</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pesan Antrian</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Berita</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tentang Kami</a>
          </li>
        </ul>
        <div class="d-flex navbar-right-font justify-content-center align-items-center me-4 gap-2">
          <i class="bi bi-cart-fill"></i>
          {{-- Create a div separator like | --}}
          <span class="mx-2">|</span>
          <a href="/login" wire:navigate>Masuk</a>
        </div>
      </div>
    </div>
  </nav>