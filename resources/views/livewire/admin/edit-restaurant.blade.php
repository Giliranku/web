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
                        <i class="fas fa-utensils me-2"></i>Edit Restoran
                    </span>
                </h5>
                <a href="{{ route('admin.restaurants.index') }}" class="btn-close"></a>
            </div>

            <!-- Form -->
            <form wire:submit="update" enctype="multipart/form-data">
                <div class="row mb-4">
                    <!-- Cover Image Upload -->
                    <div class="col-md-4 text-center position-relative">
                        <label for="cover">
                            <div class="border rounded d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                                style="width: 100%; height: 200px; cursor: pointer; background-color: #f9f9f9;">
                                @if ($new_cover)
                                    <img src="{{ $new_cover->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                @elseif($restaurant->cover)
                                    <img src="{{ asset('storage/' . $restaurant->cover) }}" alt="Current Cover" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                @else
                                    <i class="fas fa-utensils fs-1 text-muted"></i>
                                @endif
                            </div>
                        </label>

                        <button type="button"
                            class="btn btn-light p-1 position-absolute"
                            style="bottom: 160px; right: 10px;"
                            onclick="document.getElementById('cover').click()"
                            title="Ubah cover">
                            <i class="fas fa-camera  fs-5"></i>
                        </button>

                        <input type="file" wire:model="new_cover" class="d-none" id="cover" accept="image/*">
                        @error('new_cover')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror

                        <p class="text-muted small mt-2">
                            Cover image restoran. Format PNG, JPG. Max size 2 MB.
                        </p>

                        <!-- Additional Images -->
                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="img1">
                                    <div class="border rounded d-flex justify-content-center align-items-center overflow-hidden"
                                        style="width: 100%; height: 80px; cursor: pointer; background-color: #f9f9f9;">
                                        @if ($new_img1)
                                            <img src="{{ $new_img1->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                        @elseif($restaurant->img1)
                                            <img src="{{ asset('storage/' . $restaurant->img1) }}" alt="Current Image" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                        @else
                                            <i class="fas fa-plus text-muted"></i>
                                        @endif
                                    </div>
                                </label>
                                <input type="file" wire:model="new_img1" class="d-none" id="img1" accept="image/*">
                            </div>
                            <div class="col-4">
                                <label for="img2">
                                    <div class="border rounded d-flex justify-content-center align-items-center overflow-hidden"
                                        style="width: 100%; height: 80px; cursor: pointer; background-color: #f9f9f9;">
                                        @if ($new_img2)
                                            <img src="{{ $new_img2->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                        @elseif($restaurant->img2)
                                            <img src="{{ asset('storage/' . $restaurant->img2) }}" alt="Current Image" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                        @else
                                            <i class="fas fa-plus text-muted"></i>
                                        @endif
                                    </div>
                                </label>
                                <input type="file" wire:model="new_img2" class="d-none" id="img2" accept="image/*">
                            </div>
                            <div class="col-4">
                                <label for="img3">
                                    <div class="border rounded d-flex justify-content-center align-items-center overflow-hidden"
                                        style="width: 100%; height: 80px; cursor: pointer; background-color: #f9f9f9;">
                                        @if ($new_img3)
                                            <img src="{{ $new_img3->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                        @elseif($restaurant->img3)
                                            <img src="{{ asset('storage/' . $restaurant->img3) }}" alt="Current Image" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                        @else
                                            <i class="fas fa-plus text-muted"></i>
                                        @endif
                                    </div>
                                </label>
                                <input type="file" wire:model="new_img3" class="d-none" id="img3" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <!-- Form fields -->
                    <div class="col-md-8">
                        <!-- Nama Restoran -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Restoran</label>
                            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Nama Restoran">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Lokasi dan Kategori -->
                        <div class="row mb-3">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="category" class="form-label fw-semibold">Kategori</label>
                                <select wire:model="category" class="form-select" id="category">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Fast Food">Fast Food</option>
                                    <option value="Casual Dining">Casual Dining</option>
                                    <option value="Fine Dining">Fine Dining</option>
                                    <option value="Café">Café</option>
                                    <option value="Seafood">Seafood</option>
                                    <option value="Indonesian">Indonesian</option>
                                    <option value="International">International</option>
                                    <option value="Snack & Beverage">Snack & Beverage</option>
                                </select>
                                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
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
                                <label for="time_estimation" class="form-label fw-semibold">Estimasi Waktu Makan (menit)</label>
                                <input wire:model="time_estimation" type="number" class="form-control" id="time_estimation" placeholder="0" min="1">
                                @error('time_estimation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Queue Management Settings -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="players_per_round" class="form-label fw-semibold">Jumlah Tamu per Giliran</label>
                                <input wire:model="players_per_round" type="number" class="form-control" id="players_per_round" placeholder="1" min="1">
                                @error('players_per_round') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="form-text">Berapa orang yang bisa dilayani dalam 1 giliran</div>
                            </div>
                            <div class="col-md-6">
                                <label for="estimated_time_per_round" class="form-label fw-semibold">Waktu per Giliran (menit)</label>
                                <input wire:model="estimated_time_per_round" type="number" class="form-control" id="estimated_time_per_round" placeholder="30" min="1">
                                @error('estimated_time_per_round') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="form-text">Estimasi waktu untuk 1 giliran makan</div>
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
                            <textarea wire:model="description" class="form-control" id="description" rows="4" placeholder="Deskripsi restoran..."></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Update Restoran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
