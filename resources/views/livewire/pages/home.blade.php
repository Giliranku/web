<div>
   <div class="m-4">
      <form class="d-flex gap-1">
         <img src="{{asset('img/search.png')}}" alt="Gambar Cari">
         <input class="form-control me-2" type="search" placeholder="Cari" aria-label="Search">
         <button class="btn btn-outline-dark" type="submit">Cari</button>
      </form>
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

   <h5 class="mt-6 text-center">Selamat datang di Giliranku - Wahana Seru Sepuasnya!</h5>

   <div class="d-flex flex-row align-items-center mt-0">
      <img src="{{asset('img/logo-icon.png')}}" class="w-25" alt="Logo Giliranku">

      <div class="mx-1">
         <h3 class="fw-bolder">Taman Hiburan Giliranku</h3>
         <p class="mt-4 me-4">Nikmati sensasi petualangan tak terlupakan di Taman Hiburan Giliranku, destinasi seru yang cocok untuk segala usia, mulai dari keluarga, teman-teman, hingga para pencari adrenalin sejati. Dengan beragam wahana ekstrem yang memacu jantung, zona anak yang aman dan menyenangkan, serta berbagai spot foto Instagramable, setiap sudut taman ini dirancang untuk memberikan pengalaman yang tak terlupakan. Tak hanya itu, para penggemar kuliner juga akan dimanjakan dengan berbagai pilihan makanan dan minuman kekinian yang menggugah selera, dari camilan ringan hingga hidangan berat yang lezat. Dapatkan momen kebersamaan yang penuh tawa, kejutan, dan kenangan indah hanya di Giliranku, tempat di mana petualangan dimulai dan kebahagiaan tidak pernah berakhir!</p>
      </div>
   </div>
   <div class="d-flex flex-row mt-0 align-items-center justify-content-center">
      <div class="mx-5">
            <h4 class="fw-bolder text-center">500.000+</h4>
            <p class="text-center">Pengunjung setiap harinya</p>
      </div>
      <div class="vertical-line"></div>
      <div class="mx-5">
            <h4 class="fw-bolder text-center">30+</h4>
            <p class="text-center">Wahana unik</p>
      </div>
      <div class="vertical-line"></div>
      <div class="mx-5">
            <h4 class="fw-bolder text-center">10+</h4>
            <p class="text-center">Promo setiap bulan</p>
      </div>
   </div>

   <div class="bg-secondary w-100 mt-6 p-6">
      <h2 class="text-center font-dark">Beli <span class="fw-bolder">Tiket</span> Sekarang!</h2>
      <a class="btn btn-dark fw-bolder d-grid gap-2 col-6 mx-auto w-25 mt-5 py-3" href="#" role="button">Beli Tiket</a>
   </div>

   <div class="mt-6">
      <h3 class="text-center"><span class="fw-bolder">Sudah punya tiket</span> dan mau menikmati semua wahana?</h3>
      <p class="mt-4 text-center">Yuk coba sistem antrian online kami!</p>

      <div class="mt-1 p-5">          
            <div class="d-flex gap-6 flex-column flex-md-row justify-content-center align-items-center gap-mdm-3">
               <div class="card w-18 h-18 rounded align-items-center justify-content-center shadow p-md-3 mb-md-5 bg-body rounded">
                  <p>Kamu bisa ngantri disini!</p>
                  <img src="{{asset('img/attractions.png')}}" class="w-50" alt="Gambar Wahana">
                  <h4>Wahana</h4>
               </div>
               <div class="card w-18 h-18 rounded align-items-center justify-content-center shadow p-md-3 mb-md-5 bg-body rounded">
                  <p>Bisa juga ngantri disini!</p>
                  <img src="{{asset('img/fastfood.png')}}" class="w-50" alt="Gambar Restoran">
                  <h4>Restoran</h4>
               </div>
            </div>
        </div>
   </div>
   <div class="mt-4">
      <h3 class="text-center">Giliranku punya banyak <span class="fw-bolder">wahana</span> lho!</h3>
      
      <div class="mt-1 p-5 d-flex overflow-auto gap-5 mx-5">
         <div class="d-flex flex-column align-items-center">
            <img src="{{asset('img/halilintar.jpg')}}" class="w-20 rounded" alt="Gambar Wahana Halilintar">
            <h4 class="mt-2">Halilintar</h4>
         </div>
         <div class="d-flex flex-column align-items-center">
            <img src="{{asset('img/arung-jeram.jpg')}}" class="w-20 rounded" alt="Gambar Wahana Arung Jeram">
            <h4 class="mt-2">Arung Jeram</h4>
         </div>
         <div class="d-flex flex-column align-items-center">
            <img src="{{asset('img/bianglala.jpg')}}" class="w-20 rounded" alt="Gambar Wahana Bianglala">
            <h4 class="mt-2">Bianglala</h4>
         </div>
         <div class="d-flex flex-column align-items-center">
            <img src="{{asset('img/ice-age.jpg')}}" class="w-20 rounded" alt="Gambar Wahana Ice Age">
            <h4 class="mt-2">Ice Age</h4>
         </div>
         <div class="d-flex flex-column align-items-center">
            <img src="{{asset('img/kora-kora.jpg')}}" class="w-20 rounded" alt="Gambar Wahana Kora Kora">
            <h4 class="mt-2">Kora Kora</h4>
         </div>
         <div class="d-flex flex-column align-items-center">
            <img src="{{asset('img/ontang-anting.jpg')}}" class="w-20 rounded" alt="Gambar Wahana Ontang Anting">
            <h4 class="mt-2">Ontang Anting</h4>
         </div>
      </div>
   </div>
   <div class="mt-6">
      <h3 class="text-center">Tersedia pula banyak <span class="fw-bolder">tempat makan</span> disini!</h3>
      
      <div class="mt-1 p-5 d-flex overflow-auto gap-5 mx-5 align-items-center">
         <div class="d-flex flex-column align-items-center">
            <img src="{{asset('img/aw.png')}}" class="w-15 rounded" alt="Gambar Restoran A&W">
            <h4 class="mt-2">A&W</h4>
         </div>
         <div class="d-flex flex-column align-items-center ms-4">
            <img src="{{asset('img/chatime.png')}}" class="w-15 rounded" alt="Gambar Minuman Chatime">
            <h4 class="mt-0">Chatime</h4>
         </div>
         <div class="d-flex flex-column align-items-center">
            <img src="{{asset('img/kfc.webp')}}" class="w-15 rounded" alt="Gambar Restoran KFC">
            <h4 class="mt-0">KFC</h4>
         </div>
         <div class="d-flex flex-column align-items-center ms-4">
            <img src="{{asset('img/mcd.png')}}" class="w-10 rounded" alt="Gambar Restoran MCDonald">
            <h4 class="mt-2">MCDonald</h4>
         </div>
         <div class="d-flex flex-column align-items-center ms-4">
            <img src="{{asset('img/pizza-hut.png')}}" class="w-15 rounded" alt="Gambar Restoran Pizza Hut">
            <h4 class="mt-0">Pizza Hut</h4>
         </div>
         <div class="d-flex flex-column align-items-center ms-4">
            <img src="{{asset('img/raa-cha.webp')}}" class="w-10 rounded" alt="Gambar Restoran Raa Cha">
            <h4 class="mt-2">Raa Cha</h4>
         </div>
         <div class="d-flex flex-column align-items-center ms-5">
            <img src="{{asset('img/roti-o.png')}}" class="w-10 rounded" alt="Gambar Restoran Roti O">
            <h4 class="mt-2">Roti O</h4>
         </div>
      </div>
   </div>

   <div class="bg-primary w-100 mt-6 p-6">
      <h2 class="text-center font-dark">Pesan <span class="fw-bolder">Antrianmu</span> Sekarang!</h2>
      <a class="btn btn-dark fw-bolder d-grid gap-2 col-6 mx-auto w-25 mt-5 py-3" href="#" role="button">Pesan Antrian</a>
   </div>

   <div class="mt-5">
      <h3 class="p-5 text-center">Kegiatan Seru Disini</h3>
      <div class="d-flex flex-column align-items-center justify-content-center">
         <img src="{{asset('img/kegiatanseru1.jpg')}}" class="w-75 rounded" alt="Gambar Acara Pertunjukan Robot">
         <p class="mt-2 mb-3 fs-5">Robot Show Dufan</p>
         <div class="d-flex align-items-center justify-content-center mt-3 gap-5">
            <div class="d-flex flex-column align-items-center">
               <img src="{{asset('img/kegiatanseru2.jpg')}}" class="w-20 rounded" alt="Gambar Acara Berkemah di Bawah Laut">
               <p class="mt-2 mb-3 fs-5">Bertualang Seru</p>
            </div>
            <div class="d-flex flex-column align-items-center">
               <img src="{{asset('img/kegiatanseru3.jpg')}}" class="w-20 rounded" alt="Gambar Acara Tangkap Sinyal">
               <p class="mt-2 mb-3 fs-5">Bermain Layangan</p>
            </div>
            <div class="d-flex flex-column align-items-center">
               <img src="{{asset('img/kegiatanseru4.jpg')}}" class="w-20 rounded" alt="Gambar Acara Layangan Jakarta">
               <p class="mt-2 mb-3 fs-5">Menyelam</p>
            </div>
         </div>
      </div>
      <div class="d-flex justify-content-end mt-4 me-6">
         <a class="text-decoration-none link-font btn-outline-dark btn" href="#">
            Lihat kegiatan seru lainnya >
         </a>
      </div>
   </div>

   <div class="mt-5">
      <h3 class="p-5 text-center">Promo Spesial</h3>
      <div class="d-flex flex-column align-items-center justify-content-center">
         <div class="d-flex align-items-center justify-content-center mt-3 gap-5">
            <div class="d-flex flex-column align-items-center">
               <img src="{{asset('img/atlantis.jpeg')}}" class="w-20 rounded" alt="Gambar Acara Berkemah di Bawah Laut">
               <p class="mt-2 mb-3 fs-5 text-center">Berenang paling HEMAT<br>cuman di ATLANTIS!</p>
            </div>
            <div class="d-flex flex-column align-items-center">
               <img src="{{asset('img/dufan.jpeg')}}" class="w-20 rounded" alt="Gambar Acara Tangkap Sinyal">
               <p class="mt-2 mb-3 fs-5 text-center">Main sambil belajar di<br>SEAWORLD HEMAT!</p>
            </div>
            <div class="d-flex flex-column align-items-center">
               <img src="{{asset('img/seaworld.jpeg')}}" class="w-20 rounded" alt="Gambar Acara Layangan Jakarta">
               <p class="mt-2 mb-3 fs-5 text-center">Main di DUFAN,<br>HEMAT sepuasnya!</p>
            </div>
         </div>
      </div>
      <div class="d-flex justify-content-end mt-4 me-6">
         <a class="text-decoration-none link-font btn-outline-dark btn" href="#">
            Lihat promo lainnya >
         </a>
      </div>
   </div>

   <div class="mt-5">
      <h3 class="p-5 text-center">Info Ancol</h3>
      <div class="d-flex flex-column align-items-center justify-content-center">
         <div class="w-75">
            <img src="{{asset('img/info1.jpg')}}" class="w-100 rounded" alt="Gambar Pantai Ancol">
            <div class="text-center mt-3">
               <p class="fw-bolder fs-5 mb-0">Kenapa Harus ke Ancol?</p>
               <p class="mt-1">Baca selengkapnya ></p>
            </div>
         </div>

         <div class="w-75 mt-4">
            <div class="d-flex align-items-start">
               <img src="{{asset('img/info2.jpg')}}" class="rounded me-3" style="width: 150px;" alt="Gambar Wahana Dufan">
               <div class="ms-4">
                  <p class="fw-bolder fs-6 mb-0">Kenapa Harus ke Ancol?</p>
                  <p class="mt-1">Baca selengkapnya ></p>
               </div>
            </div>
         </div>
      </div>
      <div class="d-flex justify-content-end mt-4 me-6">
         <a class="text-decoration-none link-font btn-outline-dark btn" href="#">
            Lihat kegiatan seru lainnya >
         </a>
      </div>
   </div>
</div>