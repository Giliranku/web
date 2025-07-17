@push('styles')
    @vite(['resources/css/yoga.css'])
@endpush

<div class="d-flex gap-4 flex-column" style="margin-top: 8vh;">
    <link rel="stylesheet" href="./style.css">
    <div class="d-flex flex-row justify-content-evenly align-items-center">
        <livewire:date-selector />

        <div class="dropdown border border-dark rounded-3">
            <button
                class="btn btn-light dropdown-toggle custom-dropdown-button d-flex justify-content-between align-items-center"
                type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                style="width: 24vw; height: 6.7vh;">
                <div class="d-flex p-3">
                    <img src="{{ asset('img/ferrisWheel.png') }}" alt="">
                </div>
                <div class="kotak d-flex flex-column text-start" style="width: 20vw;">
                    <p class="opacity-50" style="margin-bottom: 0px;">Unit Rekreasi</p>
                    <h5>Ancol</h5>
                </div>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Seaworld</a></li>
                <li><a class="dropdown-item" href="#">Jungeland</a></li>

            </ul>
        </div>
        <div class="search" style="width: 25vw;">
            <form class="d-flex border border-dark rounded-3">
                <button class="btn" type="submit">
                    <img src="./search.png" alt="">
                </button>
                <input class="form-control border border-light" type="search" placeholder="Search" aria-label="Search"
                    wire:model.live="search">
            </form>
        </div>
    </div>
    <div class="container d-flex gap-3 flex-column">
        @forelse ($products as $product)
            <div class="row">
                <div class="column-md-6">
                    <div class="card border-dark rounded-5">
                        <div class="d-flex flex-row">
                            <div class="d-flex align-items-center p-5">
                                <div style="position: absolute; top: 10px; left: 17px;">
                                    <div class="d-flex bg-secondary rounded-pill text-light"
                                        style="padding: 1px; padding-right: 20px; padding-left: 20px; font-size: 12px;">
                                        Promo
                                    </div>
                                </div>
                                <img src="img/{{ $product->logo }}" style="width: 150px; height: 80px;"
                                    class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->price }}</p>
                                <div class="d-flex flex-row justify-content-between">
                                    <a href="/detail-tiket" class="opacity-50 text-decoration-none text-dark">Lihat
                                        detail
                                        tiket
                                        ></a>
                                    <div>
                                        <div class="product-item">

                                            <livewire:product-card :product="$product" :key="$product->id" />
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">
                Tidak ada produk yang tersedia.
            </div>
        @endforelse
    </div>
    <div class="container">
        <div class="row">
            <div class="column-md-6 d-flex flex-row gap-3">
                <a href="/cartPage" class="w-100" wire:navigate>
                    <button class="btn btn-primary" style="width: 100%; color:white;">
                        Lihat Keranjang
                    </button>
                </a>
                <a href="/cartPage2" class="w-100" wire:navigate>
                    <button class="btn btn-warning border rounded-3" style="width: 100%;">Checkout</button>
                </a>
            </div>
        </div>
    </div>
</div>
