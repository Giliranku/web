<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use Livewire\Attributes\On;

class ProductCard extends Component
{
    public Ticket $product;
    public int $quantity = 0;

    public function mount()
    {
        // Load the quantity for this specific product from the session
        $this->quantity = session('cart.' . $this->product->id . '.quantity', 0);
    }

    #[On('cartUpdated')] 
    public function refreshQuantity()
    {
        // Sync quantity from session when cart is updated from other components
        $this->quantity = session('cart.' . $this->product->id . '.quantity', 0);
    }

    public function addToCart()
    {
        // This is called only when the quantity is 0
        $this->quantity = 1;
        $this->updateSession();
    }
    
    public function increase()
    {
        $this->quantity++;
        $this->updateSession();
    }

    public function decrease()
    {
        $this->quantity--;
        if ($this->quantity <= 0) {
            // If quantity is zero or less, remove it from the cart
            session()->forget('cart.' . $this->product->id);
            $this->quantity = 0;
        } else {
            $this->updateSession();
        }
    }

    private function updateSession()
    {
        // Update the session for this single product
        session()->put('cart.' . $this->product->id, [
            'product_id' => $this->product->id,
            'quantity' => $this->quantity
        ]);

        // Tell other components (like the main cart total) that an update happened
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
