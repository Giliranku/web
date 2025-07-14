<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="{{ asset('img/logo-giliranku.png') }}" alt="Logo Giliranku"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}" wire:navigate>Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" wire:navigate>Beli Tiket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('queues.index') }}" wire:navigate>Pesan Antrian</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('news.index') }}" wire:navigate>Berita</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('about') }}" wire:navigate>Tentang Kami</a>
        </li>
      </ul>
      <div class="d-flex navbar-right-font justify-content-center align-items-center me-4 gap-2">
        <i class="bi bi-cart-fill"></i>
        {{-- Create a div separator like | --}}
        <span class="mx-2">|</span>
        <a href="/login" class="text-dark text-decoration-none" wire:navigate>Masuk</a>
      </div>
    </div>
  </div>
</nav>
