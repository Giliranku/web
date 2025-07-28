<div class="product-card-wrapper">
    <div class="quantity-control-modern">
        <!-- Add Button -->
        @if($quantity == 0)
            <button wire:click.prevent="addToCart" 
                    wire:loading.attr="disabled"
                    class="btn-add-modern">
                <span wire:loading.remove wire:target="addToCart">
                    <i class="bi bi-plus-circle me-2"></i>
                    <span class="btn-text">Tambah ke Keranjang</span>
                </span>
                <span wire:loading wire:target="addToCart">
                    <i class="bi bi-arrow-repeat me-2 spin-animation"></i>
                    <span class="btn-text">Menambahkan...</span>
                </span>
            </button>
        @endif

        <!-- Quantity Stepper -->
        @if($quantity > 0)
            <div class="quantity-stepper-modern">
                <button wire:click="decrease" 
                        wire:loading.attr="disabled"
                        class="quantity-btn decrease-btn">
                    <span wire:loading.remove wire:target="decrease">
                        <i class="bi bi-dash"></i>
                    </span>
                    <span wire:loading wire:target="decrease">
                        <i class="bi bi-arrow-repeat spin-animation"></i>
                    </span>
                </button>
                
                <span class="quantity-display">{{ $quantity }}</span>
                
                <button wire:click="increase" 
                        wire:loading.attr="disabled"
                        class="quantity-btn increase-btn">
                    <span wire:loading.remove wire:target="increase">
                        <i class="bi bi-plus"></i>
                    </span>
                    <span wire:loading wire:target="increase">
                        <i class="bi bi-arrow-repeat spin-animation"></i>
                    </span>
                </button>
            </div>
        @endif
    </div>
</div>

@push('styles')
@vite(['resources/css/product-card.css'])
@endpush
