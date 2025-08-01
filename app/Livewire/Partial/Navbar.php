<?php

namespace App\Livewire\Partial;

use Livewire\Component;
use Livewire\Attributes\On;

class Navbar extends Component
{
    public $cartCount = 0;

    public function mount()
    {
        $this->refreshCartCount();
    }

    #[On('cartUpdated')]
    public function refreshCartCount()
    {
        $cartSession = session('cart', []);
        $this->cartCount = 0;
        
        foreach ($cartSession as $item) {
            if (isset($item['quantity'])) {
                $this->cartCount += $item['quantity'];
            }
        }
        
        // Debug for development
        if (config('app.debug')) {
            \Log::info('Cart count updated: ' . $this->cartCount);
        }
    }

    public function goToCart()
    {
        try {
            if (auth()->check()) {
                return $this->redirect(route('cart-page'), navigate: true);
            } else {
                return $this->redirect(route('login'), navigate: true);
            }
        } catch (\Exception $e) {
            // Fallback to normal redirect if Livewire redirect fails
            if (auth()->check()) {
                return redirect()->route('cart-page');
            } else {
                return redirect()->route('login');
            }
        }
    }

    public function render()
    {
        return view('livewire.partial.navbar');
    }
}
