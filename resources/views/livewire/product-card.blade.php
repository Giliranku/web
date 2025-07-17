<div>
    <div class="quantity-widget">

        <a href="#" wire:click.prevent="addToCart" class="btn btn-primary" style="width: 120px; color: white;"
            x-show="$wire.quantity == 0">
            Tambah
        </a>

        <div class="input-group quantity-stepper" style="width: auto;" x-show="$wire.quantity > 0" x-cloak>

            <button wire:click="decrease" class="btn btn-primary" style="color: white;">
                &minus;
            </button>

            <input type="text" wire:model.live="quantity" class="form-control text-center quantity-input"
                style="width: 50px;" readonly>

            <button wire:click="increase" class="btn btn-primary" style="color:white;">
                &plus;
            </button>
        </div>
    </div>
</div>
