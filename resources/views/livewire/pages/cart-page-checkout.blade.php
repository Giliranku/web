@push('styles')
    @vite(['resources/css/yoga.css'])
@endpush
<div class="d-flex m-5 flex-column justify-content-between align-items-center">
    <div class="d-flex" style="width: 100%;">
        <a href="/cartPage" wire:navigate>
            <img src="{{ asset('img/arrowLeft.png') }}" alt="Back"
                style="width: 40px; height: 40px; margin-top: 5vh; margin-left: 2vw">
        </a>

    </div>
    <div class="d-flex flex-row gap-5">
        <div class="d-flex flex-column">
            <h1>Detail Pembayaran</h1>

            <form wire:submit="madePayment">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="namaLengkap" class="form-label text-secondary fw-bold">Nama Lengkap</label>
                    <input type="text" wire:model="namaLengkap" class="form-control" id="namaLengkap">
                    @error('namaLengkap')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary fw-bold">Email</label>
                    <input type="email" wire:model="email" class="form-control" id="email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="noTelp" class="form-label text-secondary fw-bold">Nomor Telepon</label>
                    <input type="tel" wire:model="noTelp" class="form-control" id="noTelp">
                    @error('noTelp')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <h1>Metode Pembayaran</h1>
                <div class="d-flex flex-row gap-3" style="width: 32vw; height: 100px;">
                    <div style="width: 100%; height: 100%;">
                        <input wire:model.live="payment_method" class="form-check-input" id="mastercard" type="radio"
                            value="mastercard" name="payment_method" />
                    </div>
                    <div style="width: 100%; height: 100%;">
                        <input wire:model.live="payment_method" class="form-check-input" id="ovo" type="radio"
                            name="payment_method" value="ovo" />
                    </div>
                    <div style="width: 100%; height: 100%;">
                        <input wire:model.live="payment_method" class="form-check-input" id="bca" type="radio"
                            name="payment_method" value="bca" />
                    </div>
                </div>
                @error('payment_method')
                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                @enderror

                @if ($payment_method === 'mastercard')
                    <div id="mastercard-form">
                        <div class="mb-3 d-flex flex-column">
                            <label for="ccn" class="form-label text-secondary fw-bold">Nomor Kartu</label>
                            <input id="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}"
                                autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx" required
                                class="form-control" wire:model="cardNumber">
                            @error('cardNumber')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex flex-row gap-3">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label text-secondary fw-bold">Tanggal</label>
                                <input type="date" wire:model="cardExpiry" class="form-control" id="tanggal">
                                @error('cardExpiry')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cvv" class="form-label text-secondary fw-bold">CVV</label>
                                <input type="number" wire:model="cvv" class="form-control" id="cvv">
                                @error('cvv')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @elseif ($payment_method === 'ovo')
                    <div id="ovo-form">
                        <div class="mb-3">
                            <label for="ovoPhone" class="form-label text-secondary fw-bold">Nomor Telepon OVO</label>
                            <input type="tel" wire:model="ovoPhone" class="form-control" id="ovoPhone">
                            @error('ovoPhone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @elseif ($payment_method === 'bca')
                    <div id="bca-form">
                        <p>Nomor BCA Virtual Account akan muncul setelah melakukan checkout.</p>
                    </div>
                @endif
                <button type="submit" class="btn btn-warning mt-3">Selesaikan Pembayaran</button>
            </form>
        </div>

        <div class="d-flex flex-column">
            <h3>Detail Pemesanan</h3>
            <div class="d-flex flex-column border border-dark rounded-4 p-3">
                @foreach ($cartItems as $item)
                    <div class="d-flex flex-row align-items-center gap-5">
                        <div>
                            <img src="./ancolMini.png" alt="">
                            <p>{{ $item['product']->name }}</p>
                            <p>Rp {{ number_format($item['subtotal']) }}</p>
                        </div>
                        <div>
                            <h5>{{ $item['quantity'] }}x</h5>
                        </div>
                    </div>
                    <hr style="width: 100%; border: none; border-top: 1.5px solid black;">
                @endforeach

                <div class="d-flex flex-row gap-2">
                    <h6 class="fw-bold">Total Harga: </h6>
                    <h6>Rp {{ number_format($totalAmount) }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
