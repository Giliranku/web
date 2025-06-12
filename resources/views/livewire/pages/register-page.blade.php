<div class="d-flex flex-row p-3">
    {{-- The whole world belongs to you. --}}
    <div  class="position-relative w-100" >
        <div class="d-flex justify-content-center">
            <img class="gambar-register object-fit-cover " src="{{asset('img/gambar_hebat.png')}}" alt="Gambar-restoran">
        </div>
        <div class="position-absolute top-0 end-0" style="margin-top: 50px; margin-right: 60px">
            <button class="btn button-color-custom-register  text-light">Masuk</button>
            <button class="btn btn-outline-light me-2 ">Bergabung</button>
        </div>
        <div class="position-absolute top-0 start-0" style="margin-top: 30px; margin-left: 60px">
            <img src="{{asset('img/logo-giliranku.png')}}" alt="Logo Giliranku">
        </div>
    </div>
    
    <div class="ps-3 pe-3 w-100 d-flex flex-column justify-content-center gap-5">
        <div class="d-flex align-items-center justify-content-center mb-5">
            <img src="{{asset('img/ancol-logo.png')}}" alt="Logo Ancol">
        </div>
        <form class="justify-content-center align-items-center d-flex flex-column">
            <div class="mb-3 w-50 h-100">
                <input type="text" class="form-control" wire:model="text" placeholder="Nama Depan">
            </div>
            <div class="mb-3 w-50 h-100">
                <input type="text" class="form-control" wire:model="text" placeholder="Nama Belakang">
            </div>
            <div class="mb-3 w-50 h-100">
                <input type="email" class="form-control" wire:model="email" placeholder="Email">
            </div>
            <div class="mb-3 w-50 h-100 rounded-3">
                <input type="password" class="form-control" wire:model="password" placeholder="Password">
            </div>
            <div class="mb-3 w-50 text-end">
                <a href="#" class="text-danger small text-secondary">Lupa password?</a>
            </div>
        </form>
            
        <div>
            <div class="d-grid gap-5 align-items-center d-flex flex-column justify-content-center">
                
                <div class="d-grid gap-2 col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-secondary w-50 rounded-pill fs-5 button-styling text-light">Masuk</button>
                </div>

            </div>
            <div class="mb-3 text-center d-flex flex-row justify-content-center">
                    <p class="text-start fs-6">Sudah Punya Akun?</p>
                    <a href="#" class="text-end text-secondary fs-6 ">Daftar Sekarang!</a>
            </div>
        </div>
        <div class="d-flex flex-row align-items-center justify-content-center gap-2">
            <img src="{{asset('img/linkedin-logo-b.png')}}" alt="">
            <img src="{{asset('img/twitter-b.png')}}" alt="">
            <img src="{{asset('img/facebook-logo-b.png')}}" alt="">
            <img src="{{asset('img/instagram-b.png')}}" alt="">
        </div>
    </div>
</div>
