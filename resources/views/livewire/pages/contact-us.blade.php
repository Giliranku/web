@vite([
        'resources/css/jesselyn.css'
        ])
<div class="mb-6">
    <div class="d-flex flex-column align-items-center mt-5">
        <img src="{{asset('img/logo-icon.png')}}" class="w-25" alt="Logo Giliranku">

        <div class="mx-5">
            <h2 class="fw-bolder text-center">Taman Hiburan Giliranku</h2>
            <p class="text-center mt-4 fs-5">Nikmati sensasi petualangan tak terlupakan di Taman Hiburan Giliranku, destinasi seru yang cocok untuk segala usia, mulai dari keluarga, teman-teman, hingga para pencari adrenalin sejati. Dengan beragam wahana ekstrem yang memacu jantung, zona anak yang aman dan menyenangkan, serta berbagai spot foto Instagramable, setiap sudut taman ini dirancang untuk memberikan pengalaman yang tak terlupakan!</p>
        </div>

        <div class="d-flex flex-md-column-contact-us flex-row mt-5 align-items-center justify-content-center">
            <div class="mx-5">
                <h3 class="fw-bolder text-center">500.000+</h3>
                <p class="text-center fs-5">Pengunjung setiap harinya</p>
            </div>
            <div class="vertical-line"></div>
            <div class="mx-5">
                <h3 class="fw-bolder text-center">30+</h3>
                <p class="text-center fs-5">Wahana unik</p>
            </div>
            <div class="vertical-line"></div>
            <div class="mx-5">
                <h3 class="fw-bolder text-center">10+</h3>
                <p class="text-center fs-5">Promo setiap bulan</p>
            </div>
        </div>

        <div class="bg-warning w-100 mt-6 mb-6 p-5">
            <h4 class="fw-bolder text-center">Layanan Kami</h4>
            
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-service">
                <div class="card w-18 w-lg-15 h-18 h-lg-15 mt-5 rounded-circle align-items-center justify-content-center shadow p-md-3 mb-md-5 bg-body rounded">
                    <i class="bi bi-ticket icon-size-home"></i>
                    <p class="mt-2 fs-7 text-center">Pembelian Tiket Online</p>
                </div>
                <div class="card w-18 w-lg-15 h-18 h-lg-15 mt-5 rounded-circle align-items-center justify-content-center shadow p-md-3 mb-md-5 bg-body rounded">
                    <i class="bi bi-people icon-size-home"></i>
                    <p class="mt-2 fs-7 text-center">Pesan Antrian Online</p>
                </div>
                <div class="card w-18 w-lg-15 h-18 h-lg-15 mt-5 rounded-circle align-items-center justify-content-center shadow p-md-3 mb-md-5 bg-body rounded">
                    <i class="bi bi-info-circle icon-size-home"></i>
                    <p class="mt-2 fs-7 text-center">Informasi yang Lengkap</p>
                </div>
            </div>
        </div>

            <h4 class="text-center">Kontribusi Kami terhadap <span class="fw-bolder">SDGs</span></h4>
            <div class="d-flex gap-sdgs my-3 ms-6 me-6 align-items-start align-content-start flex-column flex-md-row">
                <div class="d-flex flex-sm-row gap-md-5 align-items-start align-content-start">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <img src="{{asset('img/sdgs-03.png')}}" class="w-75" alt="Logo SDGs 3">
                        <p class="text-center fs-7 w-75">Dapat membantu mengurangi stres dan kelelahan akibat antrian panjang</p>
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <img src="{{asset('img/sdgs-08.png')}}" class="w-75" alt="Logo SDGs 8">
                        <p class="text-center fs-7 w-75">Dapat membuka peluang kerja serta memperkuat industri pariwisata dan hiburan</p>
                    </div>
                </div>
                <div class="d-flex flex-sm-row gap-md-5 align-items-start align-content-start">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <img src="{{asset('img/sdgs-09.png')}}" class="w-75" alt="Logo SDGs 9">
                        <p class="text-center fs-7 w-75">Dapat menyediakan inovasi digital di industri hiburan di era digital</p>
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <img src="{{asset('img/sdgs-10.png')}}" class="w-75" alt="Logo SDGs 10">
                        <p class="text-center fs-7 w-75">Dapat menyediakan fitur yang ramah untuk siapapun dan integrasi sistem online</p>
                    </div>
                </div>
            </div>

    </div>
</div>
