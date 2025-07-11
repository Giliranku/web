<div class="d-flex gap-4 flex-column" style="margin-top: 8vh;">
    <link rel="stylesheet" href="./style.css">
    <div class="d-flex flex-row justify-content-evenly align-items-center">
        <div class="dropdown border border-dark rounded-3">
            <button
                class="btn btn-light dropdown-toggle custom-dropdown-button d-flex justify-content-between align-items-center"
                type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                style="width: 24vw; height: 6.7vh;">
                <div class="d-flex p-3">
                    <img src="./calendar.png" alt="">
                </div>
                <div class="kotak d-flex flex-column gap-1">
                    <p class="text-start opacity-50" style="margin-bottom: 0px;">Tanggal Kedatangan</p>
                    <h5>29 Desember 2025</h5>
                </div>
                <ul class="dropdown-menu">
                    <div id="calendar"></div>
                </ul>
            </button>
        </div>

        <div class="dropdown border border-dark rounded-3">
            <button
                class="btn btn-light dropdown-toggle custom-dropdown-button d-flex justify-content-between align-items-center"
                type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                style="width: 24vw; height: 6.7vh;">
                <div class="d-flex p-3">
                    <img src="./ferrisWheel.png" alt="">
                </div>
                <div class="kotak d-flex flex-column text-start" style="width: 20vw;">
                    <p class="opacity-50" style="margin-bottom: 0px;">Unit Rekreasi</p>
                    <h5>Ancol</h5>
                </div>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
        </div>
        <div class="search" style="width: 25vw;">
            <form class="d-flex border border-dark rounded-3">
                <button class="btn" type="submit">
                    <img src="./search.png" alt="">
                </button>
                <input class="form-control border border-light" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
    </div>
    <div class="container d-flex gap-3 flex-column">
        <div class="row">
            <div class="column-md-6">
                <div class="card border-dark rounded-5">
                    <div class="d-flex flex-row">
                        <div class="d-flex align-items-center p-5">
                            <img src="./ancolMini.png" style="width: 100px; height: 40px;" class="card-img-top"
                                alt="...">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Tiket Orang Masuk Ancol</h5>
                            <p class="card-text">Rp 35.000</p>
                            <div class="d-flex flex-row justify-content-between">
                                <a href="#" class="opacity-50 text-decoration-none text-dark">Lihat detail tiket
                                    ></a>
                                <div class="quantity-widget">
                                    <a href="#" class="btn btn-primary" id="tambah"
                                        style="width: 120px; color: white;">Tambah</a>
                                    <div class="input-group quantity-stepper d-none" style="width: auto;">
                                        <button class="btn btn-primary quantity-minus" id="minus" type="button"
                                            aria-label="Kurangi jumlah" style="color: white;">&minus;</button>
                                        <input type="text" class="form-control text-center quantity-input"
                                            value="1" readonly aria-label="Jumlah" style="width: 50px;">
                                        <button class="btn btn-primary quantity-plus" id="add"
                                            style="color:white;" type="button"
                                            aria-label="Tambah jumlah">&plus;</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column-md-6">
                <div class="card border-dark rounded-5">
                    <div class="d-flex flex-row">
                        <div class="d-flex align-items-center p-5 flex-column">
                            <div style="position: absolute; top: 10px; left: 17px;">
                                <div class="d-flex bg-secondary rounded-pill text-light"
                                    style="padding: 1px; padding-right: 20px; padding-left: 20px; font-size: 12px;">
                                    Promo
                                </div>
                            </div>
                            <img src="./ancolMini.png" style="width: 100px; height: 40px;" class="card-img-top"
                                alt="...">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Tiket Orang Masuk Ancol</h5>
                            <div class="d-flex flex-row gap-2">
                                <p class="card-text">Rp 10.000</p>
                                <p class="card-text text-decoration-line-through opacity-50">Rp 15.000</p>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <a href="#" class="opacity-50 text-decoration-none text-dark">Lihat detail tiket
                                    ></a>
                                <div class="quantity-widget">
                                    <a href="#" class="btn btn-primary" id="tambah"
                                        style="width: 120px; color: white;">Tambah</a>
                                    <div class="input-group quantity-stepper d-none" style="width: auto;">
                                        <button class="btn btn-primary quantity-minus" id="minus" type="button"
                                            aria-label="Kurangi jumlah" style="color: white;">&minus;</button>
                                        <input type="text" class="form-control text-center quantity-input"
                                            value="1" readonly aria-label="Jumlah" style="width: 50px;">
                                        <button class="btn btn-primary quantity-plus" id="add"
                                            style="color:white;" type="button"
                                            aria-label="Tambah jumlah">&plus;</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="column-md-6 d-flex flex-row gap-3">
                <button class="btn btn-primary" style="width: 100%; color:white;">Lihat Keranjang</button>
                <button class="btn btn-warning border rounded-3" style="width: 100%;">Checkout</button>
            </div>
        </div>
    </div>
</div>
