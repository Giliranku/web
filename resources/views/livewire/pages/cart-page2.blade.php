 <div class="d-flex m-5 flex-column justify-content-between align-items-center">
     <div class="d-flex" style="width: 100%;">
         <img src="./arrowLeft.png" alt="Back" style="width: 40px; height: 40px; margin-top: 5vh; margin-left: 2vw">
     </div>
     <link rel="stylesheet" href="style3.css">
     <div class="d-flex flex-row gap-5">
         <div class="d-flex flex-column">
             <h1>Detail Pembayaran</h1>
             <form wire:submit="submitBayar">

                 @if (session('success'))
                     <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
                 @endif

                 <div class="mb-3">
                     <label for="exampleInputName" class="form-label text-secondary fw-bold">Nama Lengkap</label>
                     <input type="text" wire:model="namaLengkap" class="form-control" id="exampleInputEmail1"
                         aria-describedby="emailHelp">
                     @error('name')
                         <span style="color: red;">{{ $message }}</span>
                     @enderror
                 </div>
                 <div class="mb-3">
                     <label for="exampleInputEmail" class="form-label text-secondary fw-bold">Email</label>
                     <input type="email" wire:model="email" class="form-control" id="exampleInputPassword1">
                     @error('email')
                         <span style="color: red;">{{ $message }}</span>
                     @enderror
                 </div>
                 <div class="mb-3">
                     <label for="exampleInputPhone" class="form-label text-secondary fw-bold">Nomor Telepon</label>
                     <input type="tel" wire:model="noTelp" class="form-control" id="exampleInputPassword1">
                     @error('noTelp')
                         <span style="color: red;">{{ $message }}</span>
                     @enderror
                 </div>
                 <h1>Metode Pembayaran</h1>
                 <div class="d-flex flex-row gap-3" style="width: 32vw; height: 100px;">
                     <div style="width: 100%; height: 100%;">
                         <input class="form-check-input" id="mastercard" type="radio" wire:model.live="metode"
                             value="mastercard" aria-label="...">
                     </div>
                     <div style="width: 100%; height: 100%;">
                         <input class="form-check-input" id="ovo" type="radio" wire:model.live="metode"
                             value="ovo" aria-label="...">
                     </div>
                     <div style="width: 100%; height: 100%;">
                         <input class="form-check-input" id="bca" type="radio" wire:model.live="metode"
                             value="bca" aria-label="...">
                     </div>
                 </div>
                 @if ($metode === 'mastercard')
                     <div id="mastercard-form">
                         <div class="mb-3 d-flex flex-column">
                             <label for="ccn" class="form-label text-secondary fw-bold">Nomor
                                 Kartu</label>
                             <input id="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}"
                                 autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx" required
                                 class="form-control" wire:model="cardNumber">
                         </div>
                         <div class="d-flex flex-row gap-3">
                             <div class="mb-3">
                                 <label for="tanggal" class="form-label text-secondary fw-bold">Tanggal</label>
                                 <input type="date" wire:model="cardExpiry" class="form-control"
                                     id="exampleInputPassword1">
                             </div>
                             <div class="mb-3">
                                 <label for="exampleInputEmail" class="form-label text-secondary fw-bold">CVV</label>
                                 <input type="number" wire:model="cvv" class="form-control" id="exampleInputPassword1">
                             </div>
                         </div>
                     </div>
                 @endif
                 @if ($metode === 'ovo')
                     <div id="ovo-form">
                         <div class="mb-3">
                             <label for="exampleInputPhone" class="form-label text-secondary fw-bold">Nomor
                                 Nomor Telepon OVO</label>
                             <input type="tel" wire:model="ovoPhone" class="form-control"
                                 id="exampleInputPassword1">
                             @error('ovoPhone')
                                 <span style="color: red;">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                 @endif
                 @if ($metode === 'bca')
                     <div id="bca-form">
                         <p>Nomor BCA Virtual Account akan muncul setelah melakukan checkout</p>
                     </div>
                 @endif
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
     </form>
 </div>
