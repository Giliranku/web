<div>
    {{-- Desktop Version --}}
    <div class="d-none d-md-flex justify-content-center align-items-start"
        style="min-height:100vh; padding:2rem; background:#f8f9fa;">
        <div class="card my-5 w-100"
            style="max-width:900px; border-radius:12px; padding:2rem; box-shadow:0 2px 8px rgba(0,0,0,.1);">
            <div class="d-flex align-items-center mb-4">
                <div style="width:4px; height:24px; background:#FFC107; border-radius:2px;"></div>
                <h2 class="ms-2 mb-0">Tambahkan Wahana</h2>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form wire:submit.prevent="save" class="d-flex flex-column gap-4">
                {{-- Upload + Input --}}
                <div class="d-flex gap-4">
                    {{-- Upload Foto --}}
                    <div class="d-flex flex-column" style="width:40%;">
                        {{-- Cover utama --}}
                        @if($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="w-100 rounded-3"
                                style="height:200px; object-fit:cover;" />
                        @else
                            <label for="photo"
                                class="border rounded-3 d-flex flex-column align-items-center justify-content-center"
                                style="width:100%; height:200px; cursor:pointer;">
                                <i class="bi bi-camera" style="font-size:2.5rem;"></i>
                                <span class="mt-2">Upload Foto</span>
                                <input type="file" id="photo" wire:model="photo" class="d-none" />
                            </label>
                        @endif
                        @error('photo') <div class="text-danger small mt-2">{{ $message }}</div> @enderror

                        {{-- Thumbnail bawah --}}
                        <div class="d-flex justify-content-between mt-3">
                            @for($i = 1; $i <= 3; $i++)
                                @php $img = 'img' . $i; @endphp
                                <div class="border rounded-3 position-relative"
                                    style="width:70px; height:60px; cursor:pointer;">
                                    @if(isset($$img) && $$img instanceof \Livewire\TemporaryUploadedFile)
                                        <img src="{{ $$img->temporaryUrl() }}"
                                            style="width:100%; height:100%; object-fit:cover; border-radius:3px;" />
                                    @else
                                        <i class="bi bi-camera d-block text-center mt-3"></i>
                                    @endif
                                    <input type="file" id="img{{ $i }}" wire:model="img{{ $i }}" class="d-none" />
                                    <label for="img{{ $i }}" class="position-absolute w-100 h-100 top-0 start-0"></label>
                                    <i class="bi bi-pencil position-absolute text-black"
                                        style="bottom:2px; right:4px; font-size:.8rem;"></i>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Form Input --}}
                    <div class="d-flex flex-column w-100 gap-3">
                        <div>
                            <label class="form-label">Nama Wahana</label>
                            <div class="position-relative">
                                <input type="text" wire:model="name" class="form-control rounded-3 ps-4 pe-5"
                                    placeholder="Nama Wahana" />
                                <i
                                    class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y me-3 text-black"></i>
                            </div>
                            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="form-label">Deskripsi</label>
                            <div class="position-relative">
                                <textarea wire:model.defer="description" rows="4"
                                    class="form-control rounded-3 ps-4 pe-5" placeholder="Deskripsi"></textarea>
                                <i class="bi bi-pencil position-absolute top-0 end-0 mt-2 me-3 text-black"></i>
                            </div>
                            @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex gap-3">
                            <div class="flex-fill">
                                <label class="form-label">Kapasitas</label>
                                <div class="position-relative">
                                    <input type="number" wire:model="capacity" class="form-control rounded-3 ps-4 pe-5"
                                        placeholder="Kapasitas" />
                                    <i
                                        class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y me-3 text-black"></i>
                                </div>
                                @error('capacity') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            <div class="flex-fill">
                                <label class="form-label">Durasi Main (jam)</label>
                                <div class="position-relative">
                                    <input type="number" step="0.1" wire:model="duration"
                                        class="form-control rounded-3 ps-4 pe-5" placeholder="Durasi Main (jam)" />
                                    <i
                                        class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y me-3 text-black"></i>
                                </div>
                                @error('duration') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Submit di bawah seluruh form --}}
                <div class="d-flex justify-content-center mt-3 w-100">
                    <button type="submit" class="btn text-light w-50 rounded-4"
                        style="background-color:#3BC9AE; font-weight:600; padding:.75rem 1.5rem;">
                        Tambahkan Wahana
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>