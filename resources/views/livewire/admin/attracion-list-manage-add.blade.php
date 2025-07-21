{{-- resources/views/livewire/admin/attracion-list-manage-add.blade.php --}}
<div>

    {{-- Desktop Version --}}
    {{-- resources/views/livewire/pages/add-attraction-page.blade.php --}}
    <div class="d-none d-md-flex justify-content-center align-items-start"
        style="min-height:100vh; padding:2rem; background:#f8f9fa;">
        <!-- Card Centered & Full‑Height -->
        <div class="d-flex card my-5"
            style="width:100%;max-width:900px;border-radius:12px;display:flex;flex-direction:column;padding:2rem;box-shadow:0 2px 8px rgba(0,0,0,.1);">
            <!-- Judul -->
            <div class="d-flex align-items-center mb-4">
                <div style="width:4px; height:24px; background:#FFC107; border-radius:2px;"></div>
                <h2 class="ms-2 mb-0">Tambahkan Wahana</h2>
            </div>
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Close"
                data-bs-dismiss="modal"></button>

            <!-- Konten Flex: Upload + Form -->
            <div class="d-flex mt-5" style="  gap:2rem;">

                <!-- Upload Foto (kiri) -->


                <!-- Form (kanan), flex‑column agar tombol di bawah -->
                <div class="d-flex  w-100" style="">

                    <form wire:submit="save" class="d-flex flex-column w-100" style="gap:2rem;">

                        {{-- Upload Foto Column --}}
                        <div class="d-flex flex-row w-100">
                            <div class="d-flex w-75 position-relative">
                                {{-- Cover besar --}}
                                @if($photo)
                                    <img src="{{ $photo->temporaryUrl() }}"
                                        style="width:100%; max-width:300px; height:200px; object-fit:cover; border-radius:3px;" />
                                @else
                                    <label for="photo"
                                        class="border rounded-3 d-flex flex-column align-items-center justify-content-center"
                                        style="width:100%; max-width:300px; height:200px; cursor:pointer;">
                                        <i class="bi bi-camera" style="font-size:2.5rem;"></i>
                                        <span class="mt-2">Upload Foto</span>
                                        <input type="file" id="photo" wire:model="photo" class="d-none" />
                                    </label>
                                @endif
                                <i class="bi bi-pencil position-absolute end-0 translate-middle text-black"
                                    style="margin-right:2vw; margin-top:28vh;"></i>
                                @error('photo') <div class="text-danger small mt-2">{{ $message }}</div> @enderror

                                {{-- Baris tiga upload kecil di bawah cover --}}
                                <div class="d-flex gap-2 position-absolute bottom-0 ms-1" style=" margin-bottom: 7vh;">
                                    @for($i = 1; $i <= 3; $i++)
                                        @php $prop = 'img' . $i; @endphp
                                        <div class="border rounded-3 d-flex align-items-center justify-content-center"
                                            style="width:90px; height:60px; position:relative; cursor:pointer;">
                                            @if(isset($$prop) && $$prop instanceof \Livewire\TemporaryUploadedFile)
                                                <img src="{{ $$prop->temporaryUrl() }}"
                                                    style="width:100%; height:100%; object-fit:cover; border-radius:3px;" />
                                            @else
                                                <i class="bi bi-camera" style="font-size:1.2rem;"></i>
                                            @endif

                                            <input type="file" id="img{{ $i }}" wire:model="img{{ $i }}" class="d-none" />
                                            <label for="img{{ $i }}"
                                                class="position-absolute w-100 h-100 top-0 start-0"></label>
                                            <i class="bi bi-pencil position-absolute text-black"
                                                style="bottom:2px; right:4px; font-size:.8rem;"></i>
                                            @error('img' . $i)
                                                <div class="text-danger small position-absolute" style="bottom:-1.2rem;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            {{-- Input Fields Column --}}
                            <div class="d-flex flex-column w-100" style=" gap:1rem;">

                                {{-- Nama Wahana --}}
                                <span>Nama Wahana</span>
                                <div class="position-relative">
                                    <input type="text" wire:model="name" placeholder="Nama Wahana"
                                        class="form-control border rounded-3 ps-4 pe-5" />
                                    <i
                                        class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y me-3 text-black"></i>
                                </div>
                                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror

                                {{-- Deskripsi --}}
                                <span>Deskripsi</span>
                                <div class="position-relative">
                                    <textarea wire:model.defer="description" placeholder="Deskripsi" rows="4" class="form-control border
                                                            rounded-3 ps-4 pe-5"></textarea>
                                    <i class="bi bi-pencil position-absolute top-0 end-0 mt-2 me-3 text-black"></i>
                                </div>
                                @error('description') <div class="text-danger small">{{ $message }}</div> @enderror

                                {{-- Row with Kapasitas & Durasi --}}
                                <div class="d-flex gap-3">
                                    <div class="flex-fill">
                                        <label class="form-label">Kapasitas</label>
                                        <div class="position-relative">
                                            <input type="number" wire:model="capacity" placeholder="Kapasitas"
                                                class="form-control border rounded-3 ps-4 pe-5" />
                                            <i
                                                class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y me-3 text-black"></i>
                                        </div>
                                        @error('capacity') <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex-fill">
                                        <label class="form-label">Durasi Main (jam)</label>
                                        <div class="position-relative">
                                            <input type="number" step="0.1" wire:model="duration"
                                                placeholder="Durasi Main (jam)"
                                                class="form-control border rounded-3 ps-4 pe-5" />
                                            <i
                                                class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y me-3 text-black"></i>
                                        </div>
                                        @error('duration') <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Submit Button Centered --}}



                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-4 w-100">
                            <button type="submit" class="btn btn-primary w-50 rounded-4 text-light mx-auto"
                                style="font-weight:600; padding:.75rem 1.5rem;">
                                Tambahkan Wahana
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Mobile Version --}}
    {{-- Mobile Version --}}
    <div class="d-block d-md-none" style="padding:1rem; background:#f8f9fa;">
        <div class="card mx-3 my-3 p-4 rounded-3" style="background:#fff;">
            <form wire:submit="save" class="d-flex flex-column gap-3">

                {{-- Upload Foto --}}
                <div class="position-relative">
                    <label class="form-label">Upload Foto</label>
                    <div class="border rounded-3 d-flex flex-column align-items-center justify-content-center mb-2"
                        style="width:100%; height:150px; cursor:pointer; position:relative;">
                        <i class="bi bi-camera" style="font-size:2rem; color:#FF4E1B;"></i>
                        <span style="color:#FF4E1B; margin-top:.5rem;">Upload Foto</span>
                        <input type="file" id="photoM" wire:model="photo" class="d-none" />
                        <i class="bi bi-pencil position-absolute bottom-0 end-0 me- mb-2 text-secondary"></i>
                    </div>
                    @error('photo') <div class="text-danger small text-center">{{ $message }}</div> @enderror
                </div>

                {{-- Nama Wahana --}}
                <div>
                    <label class="form-label">Nama Wahana</label>
                    <div class="position-relative">
                        <input type="text" wire:model="name" placeholder="Nama Wahana"
                            class="form-control border rounded-3 ps-4 pe-5" />
                        <i
                            class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"></i>
                    </div>
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="form-label">Deskripsi</label>
                    <div class="position-relative">
                        <textarea wire:model.defer="description" placeholder="Deskripsi" rows="4"
                            class="form-control border rounded-3 ps-4 pe-5"></textarea>
                        <i
                            class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"></i>
                    </div>
                    @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                {{-- Kapasitas --}}
                <div>
                    <label class="form-label">Kapasitas</label>
                    <div class="position-relative">
                        <input type="number" wire:model="capacity" placeholder="Kapasitas"
                            class="form-control border rounded-3 ps-4 pe-5" />
                        <i
                            class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"></i>
                    </div>
                    @error('capacity') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                {{-- Durasi Main --}}
                <div>
                    <label class="form-label">Durasi Main (jam)</label>
                    <div class="position-relative">
                        <input type="number" step="0.1" wire:model="duration" placeholder="Durasi Main (jam)"
                            class="form-control border rounded-3 ps-4 pe-5" />
                        <i
                            class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"></i>
                    </div>
                    @error('duration') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                {{-- Submit Button --}}
                <div class="d-flex justify-content-center mt-3 w-100">
                    <button type="submit" class="btn btn-success w-100 rounded-3 text-light"
                        style="font-weight:600; padding:.75rem 1.5rem;">
                        Tambahkan Wahana
                    </button>
                </div>

            </form>
        </div>


    </div>