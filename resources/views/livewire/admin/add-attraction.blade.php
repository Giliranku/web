@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
@endpush

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-100 h-100" style="max-width: 1400px;">
        <div class="modal-content p-4 shadow rounded">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                    <span class="border-start border-warning border-4 ps-2">
                        <i class="fas fa-star me-2"></i>Tambah Wahana
                    </span>
                </h5>
                <a href="{{ route('admin.attractions.index') }}" class="btn-close"></a>
            </div>

            <!-- Form -->
            <form wire:submit="save" enctype="multipart/form-data">
                <div class="row mb-4">
                    <!-- Cover Image Upload -->
                    <div class="col-md-4 text-center position-relative">
                        <label for="cover">
                            <div class="border rounded d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                                style="width: 100%; height: 200px; cursor: pointer; background-color: #f9f9f9;">
                                @if ($cover)
                                    <img src="{{ $cover->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                @else
                                    <i class="fas fa-image fs-1 text-muted"></i>
                                @endif
                            </div>
                        </label>

                        <button type="button"
                            class="btn btn-light p-1 position-absolute"
                            style="bottom: 160px; right: 10px;"
                            onclick="document.getElementById('cover').click()"
                            title="Unggah cover">
                            <i class="fas fa-camera fs-5"></i>
                        </button>

                        <input type="file" wire:model="cover" class="d-none" id="cover" accept="image/*">
                        @error('cover')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror

                        <p class="text-muted small mt-2">
                            Cover image wahana. Format PNG, JPG. Max size 2 MB.
                        </p>

                        <!-- Additional Images -->
                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="img1">
                                    <div class="border rounded d-flex justify-content-center align-items-center overflow-hidden"
                                        style="width: 100%; height: 80px; cursor: pointer; background-color: #f9f9f9;">
                                        @if ($img1)
                                            <img src="{{ $img1->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                        @else
                                            <i class="fas fa-plus text-muted"></i>
                                        @endif
                                    </div>
                                </label>
                                <input type="file" wire:model="img1" class="d-none" id="img1" accept="image/*">
                            </div>
                            <div class="col-4">
                                <label for="img2">
                                    <div class="border rounded d-flex justify-content-center align-items-center overflow-hidden"
                                        style="width: 100%; height: 80px; cursor: pointer; background-color: #f9f9f9;">
                                        @if ($img2)
                                            <img src="{{ $img2->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                        @else
                                            <i class="fas fa-plus text-muted"></i>
                                        @endif
                                    </div>
                                </label>
                                <input type="file" wire:model="img2" class="d-none" id="img2" accept="image/*">
                            </div>
                            <div class="col-4">
                                <label for="img3">
                                    <div class="border rounded d-flex justify-content-center align-items-center overflow-hidden"
                                        style="width: 100%; height: 80px; cursor: pointer; background-color: #f9f9f9;">
                                        @if ($img3)
                                            <img src="{{ $img3->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                        @else
                                            <i class="fas fa-plus text-muted"></i>
                                        @endif
                                    </div>
                                </label>
                                <input type="file" wire:model="img3" class="d-none" id="img3" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <!-- Form fields -->
                    <div class="col-md-8">
                        <!-- Nama Wahana -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Wahana</label>
                            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Nama Wahana">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="location" class="form-label fw-semibold">Lokasi</label>
                                <select wire:model="location" class="form-select" id="location">
                                    <option value="">Pilih Lokasi</option>
                                    <option value="Ancol">Ancol</option>
                                    <option value="Dufan Ancol">Dufan Ancol</option>
                                    <option value="Sea World Ancol">Sea World Ancol</option>
                                    <option value="Atlantis Ancol">Atlantis Ancol</option>
                                    <option value="Samudra Ancol">Samudra Ancol</option>
                                    <option value="Putri Duyung Ancol">Putri Duyung Ancol</option>
                                    <option value="Jakarta Bird Land Ancol">Jakarta Bird Land Ancol</option>
                                </select>
                                @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Kapasitas dan Estimasi Waktu -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="capacity" class="form-label fw-semibold">Kapasitas (orang)</label>
                                <input wire:model="capacity" type="number" class="form-control" id="capacity" placeholder="0" min="1">
                                @error('capacity') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="time_estimation" class="form-label fw-semibold">Estimasi Waktu (menit)</label>
                                <input wire:model="time_estimation" type="number" class="form-control" id="time_estimation" placeholder="0" min="1">
                                @error('time_estimation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Staff Assignment -->
                        <div class="mb-3">
                            <label for="staff_id" class="form-label fw-semibold">Staff Pengelola (Opsional)</label>
                            <select wire:model="staff_id" class="form-select" id="staff_id">
                                <option value="">Pilih Staff</option>
                                @foreach($staff as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }} - {{ $member->role }}</option>
                                @endforeach
                            </select>
                            @error('staff_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Deskripsi</label>
                            <textarea wire:model="description" class="form-control" id="description" rows="4" placeholder="Deskripsi wahana..."></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Simpan Wahana
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
