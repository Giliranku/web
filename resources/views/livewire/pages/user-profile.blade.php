<!-- Tambahkan ini di <head> -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="justify-content-center d-flex">
        <div>
            <img src="{{ asset('img/bgmelar.png') }}" alt="" style="width: 100%">
        </div>
    </div>

    <div class="justify-content-center d-flex flex-row">
        <div class="d-flex flex-row w-50 justify-content-center" style="margin-top: -9vw;">
            <div class="d-flex flex-column align-items-center w-50">
                <div class="d-flex position-relative mb-3 flex-row" style="margin-top: 1vw; margin-left: 2vw;">
                    <img src="{{ asset('img/userphoto.png') }}" class="rounded-circle border border-2 w-100"
                        style="object-fit:cover;">
                    <button class="d-flex btn  position-absolute "
                        style=" margin-left: 17vw;margin-top:9vw; height: 5vw; width: 5vw;">
                        <img src="{{ asset('img/pencil-edit-icon.png') }}" alt="" style="height: 3vw">
                    </button>
                </div>
                <div class="w-100 d-flex flex-column align-items-center">
                    <div class="accordion w-100" id="profileAccordion">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button border border-dark rounded"
                                    style="background:#f9d778; color:#444;" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-activity" aria-expanded="true">
                                    Aktivitas Anda
                                </button>
                            </h2>
                            <div id="flush-activity" class="accordion-collapse collapse show">
                                <div class="accordion-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item" style="background: #ffe8ad;">
                                            <a href="#"
                                                class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                                Wahana
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item" style="background: #ffe8ad;">
                                            <a href="#"
                                                class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                                Restoran
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item" style="background: #ffe8ad;">
                                            <a href="#"
                                                class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                                Aksesibilitas
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex ms-5 flex-column w-100 mt-3">
            <!-- NAMA -->
            <div 
                x-data="{ edit: false, value: 'Riyadth Bierskert', temp: '' }"
                class="ps-3 my-2 d-flex justify-content-between flex-row w-100"
            >
                <div class="d-flex justify-content-start flex-column field-form-group">
                    <h3 class="ms-2">Nama</h3>
                    <!-- Display -->
                    <span 
                        x-show="!edit" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="ms-2 fs-5 field-display" 
                        style="border-radius: 2vw; font-family: 'Georgia', serif;"
                        x-text="value"
                    ></span>
                    <!-- Input -->
                    <input 
                        x-show="edit"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-model="temp"
                        @keydown.enter="value = temp; edit = false"
                        @blur="value = temp; edit = false"
                        class="fs-5 ms-3 field-input"
                        style="display: block; border-radius: 10px; padding: 6px 20px; font-family: 'Georgia', serif; color: #444;"
                    >
                </div>
                <div class="justify-content-center edit-field-btn" style="width: 5vw; margin-right: 17vw">
                    <button class="btn"  type="button"
                        @click="
                            if(!edit){
                                temp = value;
                                edit = true;
                                $nextTick(() => $el.closest('div').querySelector('input').focus());
                            } else {
                                value = temp;
                                edit = false;
                            }
                        "
                    >
                        <template x-if="!edit">
                            <img src="{{ asset('img/arrow-kanan.png') }}" alt="">
                        </template>
                        <template x-if="edit">
                            <span class="fw-bold" style="display: flex;height:5vw;color:#b89c6c;justify-content:center; align-items:center;">Simpan</span>
                        </template>
                    </button>
                </div>
            </div>
            <hr class="w-75">

            <!-- EMAIL -->
            <div 
                x-data="{ edit: false, value: 'riyadthbierskert@gmail.com', temp: '' }"
                class="ps-3 my-2 d-flex justify-content-between flex-row w-100"
            >
                <div class="d-flex justify-content-start flex-column field-form-group">
                    <h3 class="ms-2">Email</h3>
                    <span 
                        x-show="!edit"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="ms-2 fs-5 field-display" 
                        style="border-radius: 2vw; font-family: 'Georgia', serif;"
                        x-text="value"
                    ></span>
                    <input 
                        x-show="edit"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-model="temp"
                        @keydown.enter="value = temp; edit = false"
                        @blur="value = temp; edit = false"
                        class="fs-5 ms-3 field-input"
                        style="display: block; border-radius: 10px; padding: 6px 20px; font-family: 'Georgia', serif; color: #444;"
                    >
                </div>
                <div class="justify-content-center edit-field-btn" style="width: 5vw; margin-right: 17vw">
                    <button class="btn"  type="button"
                        @click="
                            if(!edit){
                                temp = value;
                                edit = true;
                                $nextTick(() => $el.closest('div').querySelector('input').focus());
                            } else {
                                value = temp;
                                edit = false;
                            }
                        "
                    >
                        <template x-if="!edit">
                            <img src="{{ asset('img/arrow-kanan.png') }}" alt="">
                        </template>
                        <template x-if="edit">
                            <span class="fw-bold" style="display: flex;margin-top:1.5vw;height:5vw;color:#b89c6c;justify-content:center;">Simpan</span>
                        </template>
                    </button>
                </div>
            </div>
            <hr class="w-75">

            <!-- NOMOR TELEPON -->
            <div 
                x-data="{ edit: false, value: '+086 - 7819381', temp: '' }"
                class="ps-3 my-2 d-flex justify-content-between flex-row w-100"
            >
                <div class="d-flex justify-content-start flex-column field-form-group">
                    <h3 class="ms-2">Nomor Telepon</h3>
                    <span 
                        x-show="!edit"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="ms-2 fs-5 field-display" 
                        style="border-radius: 2vw; font-family: 'Georgia', serif;"
                        x-text="value"
                    ></span>
                    <input 
                        x-show="edit"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-model="temp"
                        @keydown.enter="value = temp; edit = false"
                        @blur="value = temp; edit = false"
                        class="fs-5 ms-3 field-input"
                        style="display: block; border-radius: 10px; padding: 6px 20px; font-family: 'Georgia', serif; color: #444;"
                    >
                </div>
                <div class="justify-content-center edit-field-btn" style="width: 5vw; margin-right: 17vw">
                    <button class="btn"  type="button"
                        @click="
                            if(!edit){
                                temp = value;
                                edit = true;
                                $nextTick(() => $el.closest('div').querySelector('input').focus());
                            } else {
                                value = temp;
                                edit = false;
                            }
                        "
                    >
                        <template x-if="!edit">
                            <img src="{{ asset('img/arrow-kanan.png') }}" alt="">
                        </template>
                        <template x-if="edit">
                            <span class="fw-bold" style="display: flex;margin-top:1.5vw;height:5vw;color:#b89c6c;justify-content:center;">Simpan</span>
                        </template>
                    </button>
                </div>
            </div>
            <hr class="w-75">

            <!-- LOKASI -->
            <div 
                x-data="{ edit: false, value: 'Respsijg, India', temp: '' }"
                class="ps-3 my-2 d-flex justify-content-between flex-row w-100"
            >
                <div class="d-flex justify-content-start flex-column field-form-group">
                    <h3 class="ms-2">Lokasi</h3>
                    <span 
                        x-show="!edit"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="ms-2 fs-5 field-display" 
                        style="border-radius: 2vw; font-family: 'Georgia', serif;"
                        x-text="value"
                    ></span>
                    <input 
                        x-show="edit"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-model="temp"
                        @keydown.enter="value = temp; edit = false"
                        @blur="value = temp; edit = false"
                        class="fs-5 ms-3 field-input"
                        style="display: block; border-radius: 10px; padding: 6px 20px; font-family: 'Georgia', serif; color: #444;"
                    >
                </div>
                <div class="justify-content-center edit-field-btn" style="width: 5vw; margin-right: 17vw">
                    <button class="btn"  type="button"
                        @click="
                            if(!edit){
                                temp = value;
                                edit = true;
                                $nextTick(() => $el.closest('div').querySelector('input').focus());
                            } else {
                                value = temp;
                                edit = false;
                            }
                        "
                    >
                        <template x-if="!edit">
                            <img src="{{ asset('img/arrow-kanan.png') }}" alt="">
                        </template>
                        <template x-if="edit">
                            <span class="fw-bold" style="display: flex;margin-top:1.5vw;height:5vw;color:#b89c6c;justify-content:center;">Simpan</span>
                        </template>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
