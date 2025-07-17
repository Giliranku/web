<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Ticket;
use Livewire\Attributes\On;

class CartPage extends Component
{
    public $cartItems = [];
    public $totalQuantity = 0;
    public $totalAmount = 0;

    // Listen for the 'cartUpdated' event dispatched by any ProductCard
    #[On('cartUpdated')] 
    public function refreshCart()
    {
        $cartSession = session('cart', []);
        $this->totalQuantity = 0;
        $this->totalAmount = 0;
        $this->cartItems = [];

        if (empty($cartSession)) {
            return; // Exit if the cart is empty
        }

        // Get all product details in one query
        $productIds = array_keys($cartSession);
        $products = Ticket::findMany($productIds);

        foreach ($products as $product) {
            $quantity = $cartSession[$product->id]['quantity'];
            $this->cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity
            ];
            $this->totalQuantity += $quantity;
            $this->totalAmount += $product->price * $quantity;
        }
    }

    public function mount()
    {
        // Initial calculation on page load
        $this->refreshCart(); 
    }

    public function render()
    {
        return view('livewire.pages.cart-page');
    }
}