<?php

namespace App\Livewire\Pages;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Ticket;
use App\Models\Invoice;

class CartPageCheckout extends Component
{
    public string $payment_method = '';
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

     protected $rules = [
        'payment_method' => 'required|in:credit_card,ovo',
        'namaLengkap' => 'required|string|min:3',
        'email' => 'required|email',
        'noTelp' => 'required|numeric',
        'cardNumber' => 'required_if:metode,credit_card|numeric',
        'cardExpiry' => 'required_if:metode,credit_card|date_format:m/y',
        'cvv' => 'required_if:metode,credit_card|numeric|digits:3',
        'ovoPhone' => 'required_if:metode,ovo|numeric',
    ];

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

    public function save($validatedData) {
        $validatedData['user_id'] = auth()->user()->id; // Set user_id from authenticated user
        $validatedData['total_price'] = $this->totalAmount;
        $validatedData['updated_at'] = now();
        $validatedData['created_at'] = now();


        Invoice::create($validatedData);
    }

    public function mount()
    {
        // Initial calculation on page load
        $this->refreshCart(); 
    }


    public function madePayment()
    {
        // FIX: Baris ini WAJIB diaktifkan untuk menjalankan semua aturan validasi di atas.
        $validated = $this->validate();

        $this->save($validated);

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