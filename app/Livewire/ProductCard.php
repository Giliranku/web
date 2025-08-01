<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use App\Livewire\Partial\Navbar;
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

        // Dispatch global event for all components to listen
        $this->dispatch('cartUpdated');
        
        // Browser event as fallback for cross-component communication
        $this->js('window.dispatchEvent(new CustomEvent("cart-updated"))');
        
        // Force refresh navbar specifically
        $this->dispatch('cartUpdated')->to(Navbar::class);
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
