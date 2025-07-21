<div class="product-card-wrapper">
    <div class="quantity-control-modern">
        <!-- Add Button -->
        <button wire:click.prevent="addToCart" 
                class="btn-add-modern" 
                x-show="$wire.quantity == 0">
            <i class="fas fa-plus"></i>
            <span class="btn-text">Tambah</span>
        </button>

        <!-- Quantity Stepper -->
        <div class="quantity-stepper-modern" x-show="$wire.quantity > 0" x-cloak>
            <button wire:click="decrease" class="quantity-btn decrease-btn">
                <span class="btn-symbol">−</span>
            </button>
            
            <span class="quantity-display">{{ $quantity }}</span>
            
            <button wire:click="increase" class="quantity-btn increase-btn">
                <span class="btn-symbol">+</span>
            </button>
        </div>
    </div>
</div>

@push('styles')
<style>
.product-card-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
}

.quantity-control-modern {
    position: relative;
}

.btn-add-modern {
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    color: white;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    font-weight: 600;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-add-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s;
}

.btn-add-modern:hover::before {
    left: 100%;
}

.btn-add-modern:hover {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    transform: translateY(-2px);
}

.btn-add-modern:active {
    transform: translateY(0);
}

.btn-add-modern i {
    font-size: 0.9rem;
    font-weight: bold;
}

.quantity-stepper-modern {
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 25px;
    display: flex;
    align-items: center;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.quantity-stepper-modern:hover {
    border-color: #2563eb;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}

.quantity-btn {
    background: #f1f5f9;
    border: none;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #475569;
    transition: all 0.3s ease;
    cursor: pointer;
    font-weight: bold;
}

.quantity-btn:hover {
    background: #2563eb;
    color: white;
}

.quantity-btn:active {
    transform: scale(0.95);
}

.quantity-btn i {
    font-size: 0.9rem;
    font-weight: bold;
    line-height: 1;
}

.btn-symbol {
    font-size: 1.1rem;
    font-weight: bold;
    line-height: 1;
    user-select: none;
}

.decrease-btn:hover {
    background: #dc2626;
}

.increase-btn:hover {
    background: #059669;
}

.quantity-display {
    background: #2563eb;
    color: white;
    font-weight: 700;
    font-size: 0.875rem;
    padding: 0 16px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 50px;
    position: relative;
}

.quantity-display::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    z-index: -1;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .btn-add-modern {
        font-size: 0.8rem;
        padding: 8px 16px;
    }
    
    .btn-text {
        display: none;
    }
    
    .quantity-btn {
        width: 32px;
        height: 32px;
    }
    
    .quantity-btn i {
        font-size: 0.8rem;
    }
    
    .quantity-display {
        height: 32px;
        padding: 0 12px;
        font-size: 0.8rem;
    }
}

/* Animation for quantity changes */
@keyframes quantityChange {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.quantity-display {
    animation: quantityChange 0.3s ease-out;
}
</style>
@endpush
