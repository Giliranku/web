@vite(['resources/sass/app.scss',
        'resources/js/app.js',
        'resources/css/main.css',
        'resources/css/jesselyn.css'
        ])
<div class="overflow-x-hidden">
   <div class="m-4">
      <div class="search-container mx-auto">
         <i class="bi bi-search search-icon"></i>
         <input type="text" class="form-control search-input" placeholder="Cari">
      </div>
   </div>
   
   <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active" data-bs-interval="10000">
            <img src="{{asset('img/promobanner1.jpg')}}" class="d-block w-100" alt="Gambar Acara Berkemah di Bawah Laut">
         </div>
         <div class="carousel-item" data-bs-interval="2000">
            <img src="{{asset('img/promobanner2.jpg')}}" class="d-block w-100" alt="Gambar Acara Pertunjukan Robot">
         </div>
         <div class="carousel-item">
            <img src="{{asset('img/promobanner3.jpg')}}" class="d-block w-100" alt="Gambar Promo Gratis Minuman">
         </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Next</span>
      </button>
   </div>

   <h4 class="mt-6 text-center">Selamat datang di Giliranku - Wahana Seru Sepuasnya!</h4>

   <div class="d-flex flex-md-row align-items-center mt-3 flex-column p-5">
      <img src="{{asset('img/logo-icon.png')}}" class="w-logo-home" alt="Logo Giliranku">

      <div class="mx-1">
         <h2 class="fw-bolder text-center-responsive-home">Taman Hiburan Giliranku</h2>
         <p class="mt-4 me-4 fs-5 text-center-responsive-home">Nikmati sensasi petualangan tak terlupakan di Taman Hiburan Giliranku, destinasi seru yang cocok untuk segala usia, mulai dari keluarga, teman-teman, hingga para pencari adrenalin sejati. Dengan beragam wahana ekstrem yang memacu jantung, zona anak yang aman dan menyenangkan, serta berbagai spot foto Instagramable, setiap sudut taman ini dirancang untuk memberikan pengalaman yang tak terlupakan!</p>
      </div>
   </div>
   <div class="d-flex flex-row mt-0 align-items-center justify-content-center flex-md-column-contact-us">
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

   <div class="bg-secondary w-100 mt-6 p-6">
      <h2 class="text-center font-dark">Beli <span class="fw-bolder">Tiket</span> Sekarang!</h2>
      <a class="btn btn-dark fw-bolder d-grid gap-2 col-6 mx-auto w-50 mt-5 py-3" href="#" role="button">Beli Tiket</a>
   </div>

   <div class="mt-6">
      <h3 class="text-center p-3"><span class="fw-bolder">Sudah punya tiket</span> dan mau menikmati semua wahana?</h3>
      <p class="mt-4 text-center fs-5">Yuk coba sistem antrian online kami!</p>

      <div class="mt-1 p-5">          
         <div class="d-flex gap-7 flex-column flex-md-row justify-content-center align-items-center gap-mdm-3">
            <a href="" class="text-decoration-none">
               <div class="card w-18 h-18 rounded align-items-center justify-content-center shadow p-md-3 mb-md-5 bg-body rounded">
                  <p class="fs-5 text-decoration-none">Kamu bisa ngantri disini!</p>
                  <i class="bi bi-car-front-fill icon-size-home"></i>
                  <h4 class="text-decoration-none">Wahana</h4>
               </div>
            </a>
            
            <a href="" class="text-decoration-none">
                  <div class="card w-18 h-18 rounded align-items-center justify-content-center shadow p-md-3 mb-md-5 bg-body rounded">
                  <p class="fs-5 text-decoration-none">Bisa juga ngantri disini!</p>
                  <i class="bi bi-house-door icon-size-home"></i>
                  <h4 class="text-decoration-none">Restoran</h4>
               </div>
            </a>
         </div>
      </div>
   </div>
   <div class="mt-4">
      <h3 class="text-center p-3">Giliranku punya banyak <span class="fw-bolder">wahana</span> lho!</h3>
      <div id="wahanaCarousel" class="carousel slide ms-6 me-6 mt-5" data-bs-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="d-flex justify-content-center gap-5">
               <div class="d-flex flex-column align-items-center">
                  <img src="{{ asset('img/halilintar.jpg') }}" class="w-20 rounded" alt="Gambar Wahana Halilintar">
                  <h4 class="mt-2">Halilintar</h4>
               </div>
               <div class="d-flex flex-column align-items-center">
                  <img src="{{ asset('img/arung-jeram.jpg') }}" class="w-20 rounded" alt="Gambar Wahana Arung Jeram">
                  <h4 class="mt-2">Arung Jeram</h4>
               </div>
               <div class="d-flex flex-column align-items-center">
                  <img src="{{ asset('img/bianglala.jpg') }}" class="w-20 rounded" alt="Gambar Wahana Bianglala">
                  <h4 class="mt-2">Bianglala</h4>
               </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="d-flex justify-content-center gap-5">
               <div class="d-flex flex-column align-items-center">
                  <img src="{{ asset('img/ice-age.jpg') }}" class="w-20 rounded" alt="Gambar Wahana Ice Age">
                  <h4 class="mt-2">Ice Age</h4>
               </div>
               <div class="d-flex flex-column align-items-center">
                  <img src="{{ asset('img/kora-kora.jpg') }}" class="w-20 rounded" alt="Gambar Wahana Kora Kora">
                  <h4 class="mt-2">Kora Kora</h4>
               </div>
               <div class="d-flex flex-column align-items-center">
                  <img src="{{ asset('img/ontang-anting.jpg') }}" class="w-20 rounded" alt="Gambar Wahana Ontang Anting">
                  <h4 class="mt-2">Ontang Anting</h4>
               </div>
               </div>
            </div>
         </div>

         <button class="carousel-control-prev circle-btn bg-dark start-0" type="button" data-bs-target="#wahanaCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
         </button>

         <button class="carousel-control-next circle-btn bg-dark end-0" type="button" data-bs-target="#wahanaCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
         </button>
      </div>
   </div>

   <div class="mt-6">
      <h3 class="text-center">Tersedia pula banyak <span class="fw-bolder">tempat makan</span> disini!</h3>   
      <div id="restoranCarousel" class="carousel slide ms-6 me-6 mt-5 position-relative" data-bs-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="d-flex justify-content-center align-items-center gap-5">
                  <div class="d-flex flex-column align-items-center">
                     <img src="{{ asset('img/aw.png') }}" class="img-fluid rounded" style="max-width:130px;"  alt="Gambar Restoran A&W">
                     <h4 class="mt-2">A&W</h4>
                  </div>
                  <div class="d-flex flex-column align-items-center">
                     <img src="{{ asset('img/chatime.png') }}" class="img-fluid rounded" style="max-width:130px;" alt="Gambar Minuman Chatime">
                     <h4 class="mt-2">Chatime</h4>
                  </div>
                  <div class="d-flex flex-column align-items-center">
                     <img src="{{ asset('img/kfc.webp') }}" class="img-fluid rounded" style="max-width:130px;" alt="Gambar Restoran KFC">
                     <h4 class="mt-2">KFC</h4>
                  </div>
                  <div class="d-flex flex-column align-items-center">
                     <img src="{{ asset('img/mcd.png') }}" class="w-10 rounded" alt="Gambar Restoran McDonald">
                     <h4 class="mt-2">McDonald</h4>
                  </div>
               </div>
            </div>

            <div class="carousel-item">
               <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
                  <div class="d-flex flex-column align-items-center">
                     <img src="{{ asset('img/pizza-hut.png') }}" class="w-10 rounded" alt="Gambar Restoran Pizza Hut">
                     <h4 class="mt-2">Pizza Hut</h4>
                  </div>
                  <div class="d-flex flex-column align-items-center">
                     <img src="{{ asset('img/raa-cha.webp') }}" class="w-10 rounded" alt="Gambar Restoran Raa Cha">
                     <h4 class="mt-2">Raa Cha</h4>
                  </div>
                  <div class="d-flex flex-column align-items-center">
                     <img src="{{ asset('img/roti-o.png') }}" class="w-10 rounded" alt="Gambar Restoran Roti O">
                     <h4 class="mt-2">Roti O</h4>
                  </div>
               </div>
            </div>
         </div>

         <button class="carousel-control-prev circle-btn bg-dark position-absolute top-50 start-0" type="button" data-bs-target="#restoranCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
         </button>

         <button class="carousel-control-next circle-btn bg-dark position-absolute top-50 end-0" type="button" data-bs-target="#restoranCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
         </button>
      </div>
   </div>

   <div class="bg-primary w-100 mt-6 p-6">
      <h2 class="text-center font-dark">Pesan <span class="fw-bolder">Antrianmu</span> Sekarang!</h2>
      <a class="btn btn-dark fw-bolder d-grid gap-2 col-6 mx-auto w-50 mt-5 py-3" href="#" role="button">Pesan Antrian</a>
   </div>

   <div class="mt-5">
      <h3 class="p-5 text-center">Kegiatan Seru Disini</h3>
      <div class="d-flex flex-column align-items-center justify-content-center">
         <a href="" class="text-decoration-none">
            <div class="d-flex flex-column align-items-center">
               <img src="{{asset('img/kegiatanseru1.jpg')}}" class="w-75-responsive-home rounded" alt="Gambar Acara Pertunjukan Robot">
               <p class="mt-2 mb-3 fs-5 text-center text-decoration-none font-dark">Robot Show Dufan</p>
            </div>
         </a>
         <div class="d-flex align-items-center justify-content-center mt-3 gap-5-home flex-xl-row flex-column">
            <a href="" class="text-decoration-none">
               <div class="d-flex flex-column align-items-center">
                  <img src="{{asset('img/kegiatanseru2.jpg')}}" class="w-20 rounded" alt="Gambar Acara Layangan Jakarta">
                  <p class="mt-2 mb-3 fs-5 text-center text-decoration-none font-dark">Bertualang Seru</p>
               </div>
            </a>
            <a href="" class="text-decoration-none">
               <div class="d-flex flex-column align-items-center">
                  <img src="{{asset('img/kegiatanseru3.jpg')}}" class="w-20 rounded" alt="Gambar Acara Layangan Jakarta">
                  <p class="mt-2 mb-3 fs-5 text-center text-decoration-none font-dark">Bermain Layangan</p>
               </div>
            </a>
            <a href="" class="text-decoration-none">
               <div class="d-flex flex-column align-items-center">
                  <img src="{{asset('img/kegiatanseru4.jpg')}}" class="w-20 rounded" alt="Gambar Acara Layangan Jakarta">
                  <p class="mt-2 mb-3 fs-5 text-center text-decoration-none font-dark">Menyelam</p>
               </div>
            </a>
         </div>
      </div>
      <div class="d-flex justify-content-center mt-4 me-6 justify-content-xl-end">
         <a class="text-decoration-none link-font btn-outline-dark btn" href="#">
            Lihat kegiatan seru lainnya >
         </a>
      </div>
   </div>

   <div class="mt-5">
      <h3 class="p-5 text-center">Promo Spesial</h3>
      <div class="d-flex flex-column align-items-center justify-content-center">
         <div class="d-flex align-items-center justify-content-center mt-3 gap-5-home flex-xl-row flex-column">
            <a href="" class="text-decoration-none">
               <div class="d-flex flex-column align-items-center">
                  <img src="{{asset('img/atlantis.jpeg')}}" class="w-20 rounded" alt="Gambar Acara Layangan Jakarta">
                  <p class="mt-2 mb-3 fs-5 text-center text-decoration-none font-dark">Berenang paling HEMAT<br>cuman di ATLANTIS!</p>
               </div>
            </a>
            <a href="" class="text-decoration-none">
               <div class="d-flex flex-column align-items-center">
                  <img src="{{asset('img/dufan.jpeg')}}" class="w-20 rounded" alt="Gambar Acara Layangan Jakarta">
                  <p class="mt-2 mb-3 fs-5 text-center text-decoration-none font-dark">Main sambil belajar di<br>SEAWORLD HEMAT!</p>
               </div>
            </a>
            <a href="" class="text-decoration-none">
               <div class="d-flex flex-column align-items-center">
                  <img src="{{asset('img/seaworld.jpeg')}}" class="w-20 rounded" alt="Gambar Acara Layangan Jakarta">
                  <p class="mt-2 mb-3 fs-5 text-center text-decoration-none font-dark">Main di DUFAN,<br>HEMAT sepuasnya!</p>
               </div>
            </a>
            
         </div>
      </div>
      <div class="d-flex justify-content-center mt-4 me-6 justify-content-xl-end">
         <a class="text-decoration-none link-font btn-outline-dark btn" href="#">
            Lihat promo lainnya >
         </a>
      </div>
   </div>

   <div class="mt-5">
      <h3 class="p-5 text-center">Info Giliranku</h3>
      <div class="d-flex flex-column align-items-center justify-content-center">
         <a href="" class="text-decoration-none">
            <div class="d-flex flex-column align-items-center">
               <img src="{{asset('img/info1.jpg')}}" class="w-75-responsive-home rounded" alt="Gambar Pantai Ancol">
               <p class="mt-2 mb-3 fs-5 text-center text-decoration-none font-dark">Kenapa Harus ke Ancol?</p>
            </div>
         </a>
         <div class="d-flex align-items-center justify-content-center mt-3 gap-5-home flex-xl-row flex-column">
            <a href="" class="text-decoration-none">
               <div class="d-flex flex-column align-items-center">
                  <img src="{{asset('img/info2.jpg')}}" class="w-20 rounded" alt="Gambar Wahana Dufan">
                  <p class="mt-2 mb-3 fs-5 text-center text-decoration-none font-dark">Klarifikasi Tornado Tutup</p>
               </div>
            </a>
            <a href="" class="text-decoration-none">
               <div class="d-flex flex-column align-items-center">
                  <img src="{{asset('img/info3.jpg')}}" class="w-20 rounded" alt="Gambar Konser Ancol">
                  <p class="mt-2 mb-3 fs-5 text-center text-decoration-none font-dark">Merayakan Konser di Tengah Pantai Ancol</p>
               </div>
            </a>
         </div>
      </div>
      <div class="d-flex justify-content-center mt-4 me-6 mb-6 justify-content-xl-end">
         <a class="text-decoration-none link-font btn-outline-dark btn" href="#">
            Lihat kegiatan seru lainnya >
         </a>
      </div>
   </div>

   {{-- <div class="mt-5">
      <h3 class="p-5 text-center">Info Ancol</h3>
      <div class="d-flex flex-column align-items-center justify-content-center">
         <div class="w-75">
            <img src="{{asset('img/info1.jpg')}}" class="w-100 rounded" alt="Gambar Pantai Ancol">
            <div class="text-center mt-3">
               <p class="fw-bolder fs-4 mb-0">Kenapa Harus ke Ancol?</p>
               <a href="" class="mt-1 mb-0 text-decoration-none fs-5">Baca selengkapnya ></a>
            </div>
         </div>

         <div class="w-75 mt-5">
            <a href="" class="text-decoration-none w-100">
               <div class="d-flex align-items-center mt-5">
                  <img src="{{asset('img/info2.jpg')}}" class="rounded w-50" alt="Gambar Konser Ancol">
                  <div class="ms-0 d-flex flex-column justify-content-center">
                     <p class="fw-bolder fs-5 mb-0 font-dark">Klarifikasi Wahana Tornado tutup</p>
                     <a href="" class="mt-1 mb-0 text-decoration-none fs-5">Baca selengkapnya ></a>
                  </div>
               </div>
            </a>
            <a href="" class="text-decoration-none w-100">
               <div class="d-flex align-items-center mt-5">
                  <img src="{{asset('img/info3.jpg')}}" class="rounded w-50" alt="Gambar Konser Ancol">
                  <div class="ms-0 d-flex flex-column justify-content-center">
                     <p class="fw-bolder fs-5 mb-0 font-dark">Merayakan konser di tengah Pantai Ancol</p>
                     <a href="" class="mt-1 mb-0 text-decoration-none fs-5">Baca selengkapnya ></a>
                  </div>
               </div>
            </a>
         </div>
      </div>
      <div class="d-flex justify-content-center mt-5 me-6 mb-6 justify-content-xl-end">
         <a class="text-decoration-none link-font btn-outline-dark btn" href="#">
            Lihat informasi lainnya >
         </a>
      </div>
   </div> --}}
</div>