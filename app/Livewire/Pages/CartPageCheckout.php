<?php

namespace App\Livewire\Pages;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Ticket;

class CartPageCheckout extends Component
{
    public string $metode = '';
    public string $namaLengkap = '';
    public string $email = '';
    public string $noTelp = '';
    public string $cardNumber = '';
    public string $cardExpiry = '';
    public string $cvv = '';
    public string $ovoPhone = '';

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


    public function madePayment()
    {
        // FIX: Baris ini WAJIB diaktifkan untuk menjalankan semua aturan validasi di atas.
        $this->validate();

        //
        // Logika untuk memproses pembayaran Anda letakkan di sini...
        //

        session()->flash('success', 'Detail Pembayaran Berhasil di Submit!');

        // Reset semua field form setelah berhasil submit
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.cart-page-checkout');
    }
}