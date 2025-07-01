<div class="container pt-3 pb-5 justify-content-center" style="max-width: 90vw">
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="mb-5 justify-content-center d-none d-md-flex align-items-center">
        <div class="bg-primary text-white px-5 py-3 rounded-4 shadow-sm d-flex align-items-center gap-2 fs-4 justify-content-center" >
            <img src="{{asset('img/VectorCentang.png')}}" alt="Centang" class="h-1 img-fluid " style="min-height: 1vw; max-height: 2vw;">
            <span class="ms-4">Pembayaran Berhasil</span>
        </div>
    </div>

    <div class="mb-5 justify-content-center d-md-none align-items-center"> 
        <div class="bg-primary text-white px-5 py-3 rounded-4 shadow-sm d-flex align-items-center gap-2 fs-5 justify-content-center" >
            <img src="{{asset('img/VectorCentang.png')}}" alt="Centang" class="h-1 img-fluid " style="min-height: 3vw; max-height: 4vw;">
            <span class="ms-4">Pembayaran Berhasil</span>
        </div>
    </div>

    <div class="bg-white p-4 rounded-3 shadow-sm border border-dark">
        <div class="d-flex justify-content-between align-items-start mb-3 d-none d-md-flex ">
            <div>
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('img/logo-giliranku.png') }}" alt="icon" style="width:4vw" >
                    <div >
                        <div class="fw-bold fs-1">Giliranku - Inclusive Theme Park</div>
                        <div class="small text-muted fs-4">Tiket Elektronik</div>
                    </div>
                </div>
            </div>
            <div>
                <img src="{{ asset('img/barcode.png') }}" alt="barcode" class="w-100">
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-start mb-3 d-block d-md-none">
            <div>
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('img/logo-giliranku.png') }}" alt="icon" style="width:6vw" >
                    <div >
                        <div class="fw-bold fs-3">Giliranku - Inclusive Theme Park</div>
                        <div class="small text-muted fs-5">Tiket Elektronik</div>
                    </div>
                </div>
            </div>
            <div>
                <img src="{{ asset('img/barcode.png') }}" alt="barcode" style="width: 30vw">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-6 small text-muted">Nomor Referal</div>
            <div class="col-6 text-end small">392387498347242</div>
        </div>
        <div class="row my-3">
            <div class="col-6 small text-muted">Tanggal Pembelian</div>
            <div class="col-6 text-end small">2 Mei 2025</div>
        </div>
        <div class="row my-3">
            <div class="col-6 small text-muted">Metode Pembayaran</div>
            <div class="col-6 text-end small">Qris</div>
        </div>
        <hr>
        <div class="row my-3">
            <div class="col-7">Ticket Wahana Kura Kura (1x)</div>
            <div class="col-5 text-end">Rp. 100.000</div>
        </div>
        <div class="row my-3">
            <div class="col-7">Ticket Wahana Angin Angin (1x)</div>
            <div class="col-5 text-end">Rp. 200.000</div>
        </div>
        <div class="row my-3">
            <div class="col-7">Ticket Wahana Angin Angin (1x)</div>
            <div class="col-5 text-end">Rp. 200.000</div>
        </div>
        <hr>
        <div class="row mb-5">
            <div class="col-7 fw-bold">Total Harga</div>
            <div class="col-5 text-end fw-bold">Rp. 500.000</div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <button type="button" class="btn btn-warning w-100 fs-4 rounded-4">Kembali</button>
    </div>
</div>
