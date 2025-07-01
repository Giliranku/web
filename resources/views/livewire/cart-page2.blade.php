 <div class="d-flex m-5 flex-column justify-content-between align-items-center">
     <div class="d-flex" style="width: 100%;">
         <img src="./arrowLeft.png" alt="Back" style="width: 40px; height: 40px; margin-top: 5vh; margin-left: 2vw">
     </div>
     <link rel="stylesheet" href="style3.css">
     <div class="d-flex flex-row gap-5">
         <div class="d-flex flex-column">
             <h1>Detail Pembayaran</h1>
             <form>
                 <div class="mb-3">
                     <label for="exampleInputName" class="form-label text-secondary fw-bold">Nama Lengkap</label>
                     <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                 </div>
                 <div class="mb-3">
                     <label for="exampleInputEmail" class="form-label text-secondary fw-bold">Email</label>
                     <input type="email" class="form-control" id="exampleInputPassword1">
                 </div>
                 <div class="mb-3">
                     <label for="exampleInputEmail" class="form-label text-secondary fw-bold">Nomor Telepon</label>
                     <input type="email" class="form-control" id="exampleInputPassword1">
                 </div>

             </form>
             <h1>Metode Pembayaran</h1>
             <form>
                 <div class="d-flex flex-row gap-3" style="width: 32vw; height: 100px;">
                     <div style="width: 100%; height: 100%;">
                         <input class="form-check-input" id="mastercard" type="checkbox" id="checkboxNoLabel"
                             value="" aria-label="...">
                     </div>
                     <div style="width: 100%; height: 100%;">
                         <input class="form-check-input" id="ovo" type="checkbox" id="checkboxNoLabel"
                             value="" aria-label="...">
                     </div>
                     <div style="width: 100%; height: 100%;">
                         <input class="form-check-input" id="bca" type="checkbox" id="checkboxNoLabel"
                             value="" aria-label="...">
                     </div>
                 </div>
                 <div class="mb-3">
                     <label for="exampleInputName" class="form-label text-secondary fw-bold">Nama Lengkap</label>
                     <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                 </div>
                 <div class="mb-3">
                     <label for="exampleInputEmail" class="form-label text-secondary fw-bold">Nomor Kartu</label>
                     <input type="email" class="form-control" id="exampleInputPassword1">
                 </div>
                 <div class="d-flex flex-row gap-3">
                     <div class="mb-3">
                         <label for="exampleInputEmail" class="form-label text-secondary fw-bold">Tanggal</label>
                         <input type="email" class="form-control" id="exampleInputPassword1">
                     </div>
                     <div class="mb-3">
                         <label for="exampleInputEmail" class="form-label text-secondary fw-bold">CVV</label>
                         <input type="email" class="form-control" id="exampleInputPassword1">
                     </div>
                 </div>
             </form>
         </div>
         <div class="d-flex flex-column">
             <h3>Detail Pemesanan</h3>
             <div class="d-flex flex-column border border-dark rounded-4 p-3">
                 <div class="d-flex flex-row align-items-center gap-5">
                     <div>
                         <img src="./ancolMini.png" alt="">
                         <p>Tiket Orang Masuk Ancol</p>
                         <p>Rp 35.000</p>
                     </div>
                     <div>
                         <h5>1x</h5>
                     </div>
                 </div>
                 <hr style="width: 100%; border: none; border-top: 1.5px solid black;">
                 <div class="d-flex flex-row align-items-center gap-5">
                     <div>
                         <img src="./ancolMini.png" alt="">
                         <p>Tiket Orang Masuk Ancol</p>
                         <p>Rp 35.000</p>
                     </div>
                     <div>
                         <h5>1x</h5>
                     </div>
                 </div>
                 <hr style="width: 100%; border: none; border-top: 1.5px solid black;">
                 <div class="d-flex flex-row align-items-center gap-5">
                     <div>
                         <img src="./ancolMini.png" alt="">
                         <p>Tiket Orang Masuk Ancol</p>
                         <p>Rp 35.000</p>
                     </div>
                     <div>
                         <h5>1x</h5>
                     </div>
                 </div>
                 <div class="d-flex flex-row gap-2">
                     <h6 class="fw-bold">Total Harga: </h6>
                     <h6>Rp 105.000</h6>
                 </div>
             </div>
         </div>
     </div>
     <button type="submit" class="btn btn-warning">Selesaikan Pembayaran</button>
 </div>
