<div >
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="d-none d-md-flex flex-row p-3">
        <div  class="position-relative w-100" >
            <div class="d-flex justify-content-center">
                <img class="gambar-login object-fit-cover " src="{{asset('img/gambar_hebat.png')}}" alt="Gambar-restoran">
            </div>
            <div class="position-absolute top-0 end-0" style="margin-top: 50px; margin-right: 60px">
                <button class="btn button-color-custom  text-light">Masuk</button>
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
                    <input type="Email" class="form-control" wire:model="email" placeholder="Email">
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
                        <button id="atur_wrapping" type="button" class="btn border border-dark w-50">Masuk Dengan Google  <img class="w-1" src="{{asset('img/Google-G-logo.png')}}" alt="Logo Google"></button>
                    </div>
                    
                    <div class="d-grid gap-2 col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary w-50 rounded-pill fs-5 button-styling text-light">Masuk</button>
                    </div>

                </div>
                <div class="mb-3 text-center d-flex flex-row justify-content-center">
                        <p class="text-start fs-6">Belum ada akun?</p>
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
    
    
    {{-- MOBILE ONLY (xs, sm) --}}
    <div class="d-block d-md-none bg-dark">
        <div class="container-fluid px-0" style="position: relative">
            <div class="ms-3 mt-3" style="position: absolute; z-index:2;">
                <img src="{{asset('/img/logo-giliranku.png')}}" alt="Logo" style="max-width: 7vw;">
            </div>
            <div class="w-100 bg-white " style="position: relative; z-index:1;">
                <div class="d-flex justify-content-center" style=" position: relative;z-index: 1;overflow: hidden; height:50vw; width: 100%">
                    <img src="{{ asset('img/imagehape.png') }}" alt="ImageCover"  style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
            {{-- card --}}
            <div class="bg-white px-3 pt-3 pb-4" style="border-radius: 32px 32px 0 0; margin-top: -30px;position: relative; z-index:2;">
                <div class="d-flex flex-column align-items-center">
                    
                    <img src="{{ asset('img/ancol-logo.png') }}" alt="Logo Ancol" style="height:48px;">
                    
                    <div class="d-flex w-100 justify-content-center my-5 ">
                        <button class="btn borderborder-end border-dark" style="background:#60C1AA; color:#fff; min-width:110px; border-radius:10px 0 0 10px;">Masuk</button>
                        <button class="btn btn-outline-light" style="background:#eee; color:#222; min-width:110px; border-radius:0 10px 10px 0; border:1px solid #ccc;">Bergabung</button>
                    </div>
                    
                    <form class="w-100">
                        <div class="mb-3">
                            <input type="email" class="form-control rounded-pill px-4 py-2" placeholder="Email" style="font-size:1rem;">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control rounded-pill px-4 py-2" placeholder="Password" style="font-size:1rem;">
                        </div>
                        <div class="mb-3 text-end">
                            <a href="#" class="text-danger small text-secondary">Lupa password?</a>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn w-100 rounded-pill border border-dark py-2 bg-white" style="font-size: 1.1rem;">
                                Masuk dengan Google
                                <img class="ms-2" src="{{asset('img/Google-G-logo.png')}}" style="width:18px;" alt="Logo Google">
                            </button>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn w-100 rounded-pill fs-5" style="background:#FF4E1B; color:#fff; font-weight:600; padding: 12px 0;">Masuk</button>
                        </div>
                        <div class="text-center mb-3">
                            <span>Belum ada akun? <a href="#" class="text-danger fw-bold">Daftar sekarang!</a></span>
                        </div>
                    </form>
                    
                    <div class="d-flex flex-row align-items-center justify-content-center gap-3 mt-2 mb-1">
                        <img src="{{asset('img/linkedin-logo-b.png')}}" alt="" style="height:28px;">
                        <img src="{{asset('img/twitter-b.png')}}" alt="" style="height:28px;">
                        <img src="{{asset('img/facebook-logo-b.png')}}" alt="" style="height:28px;">
                        <img src="{{asset('img/instagram-b.png')}}" alt="" style="height:28px;">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
