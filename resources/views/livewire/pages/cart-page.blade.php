@push('styles')
    @vite(['resources/css/yoga.css'])
@endpush

<div class="d-flex gap-4 flex-column">
    <img src="./arrowLeft.png" alt="Back" style="width: 40px; height: 40px; margin-top: 5vh; margin-left: 2vw">
    <div class="container d-flex gap-3 flex-column">
        <h1>Keranjang Saya</h1>
        <livewire:date-selector />
        @forelse ($cartItems as $item)
            <div class="row">
                <div class="column-md-6">
                    <div class="card border-dark rounded-5">
                        <div class="d-flex flex-row">
                            <div class="d-flex align-items-center p-5">
                                <img src="./ancolMini.png" style="width: 100px; height: 40px;" class="card-img-top"
                                    alt="...">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $item['product']->name }}</h5>
                                <p class="card-text">Rp {{ number_format($item['subtotal']) }}</p>
                                <div class="d-flex flex-row justify-content-between">
                                    <a href="#" class="opacity-50 text-decoration-none text-dark">Lihat detail
                                        tiket
                                        ></a>
                                    <div>
                                        <div class="product-item" wire:key="item-{{ $item['product']->id }}">

                                            <livewire:product-card :product="$item['product']" :key="$item['product']->id" />
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
                Keranjang Anda kosong.
            </div>
        @endforelse
        <div class="d-flex justify-content-end align-items-end flex-column">
            <h3 style="text-align: end;">
                <strong>Total Harga :</strong>Rp {{ number_format($totalAmount) }}
            </h3>
        </div>

        <a href="/cartPage2">
            <button class="btn btn-warning border rounded-3" style="width: 100%;">Lanjutkan Ke Pembayaran</button>
        </a>
    </div>
</div>
