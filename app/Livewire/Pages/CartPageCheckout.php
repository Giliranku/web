<?php

namespace App\Livewire\Pages;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Ticket;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    protected $rules = [
        'metode' => 'required|in:credit_card,debit_card,ovo,dana,gopay',
        'namaLengkap' => 'required|string|min:3|max:100',
        'email' => 'required|email|max:255',
        'noTelp' => 'required|string|min:10|max:15',
        'cardNumber' => 'required_if:metode,credit_card,debit_card|string|min:16|max:19',
        'cardExpiry' => 'required_if:metode,credit_card,debit_card|string|size:5',
        'cvv' => 'required_if:metode,credit_card,debit_card|string|size:3',
        'ovoPhone' => 'required_if:metode,ovo|string|min:10|max:15',
    ];

    protected $messages = [
        'metode.required' => 'Silakan pilih metode pembayaran.',
        'metode.in' => 'Metode pembayaran tidak valid.',
        'namaLengkap.required' => 'Nama lengkap wajib diisi.',
        'namaLengkap.min' => 'Nama lengkap minimal 3 karakter.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'noTelp.required' => 'Nomor telepon wajib diisi.',
        'noTelp.min' => 'Nomor telepon minimal 10 digit.',
        'cardNumber.required_if' => 'Nomor kartu wajib diisi untuk pembayaran kartu.',
        'cardNumber.min' => 'Nomor kartu minimal 16 digit.',
        'cardExpiry.required_if' => 'Tanggal expire kartu wajib diisi.',
        'cardExpiry.size' => 'Format tanggal expire tidak valid (MM/YY).',
        'cvv.required_if' => 'CVV kartu wajib diisi.',
        'cvv.size' => 'CVV harus 3 digit.',
        'ovoPhone.required_if' => 'Nomor OVO wajib diisi.',
        'ovoPhone.min' => 'Nomor OVO minimal 10 digit.',
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

    public function mount()
    {
        // Initial calculation on page load
        $this->refreshCart(); 
    }

    public function updatedMetode($value)
    {
        // Clear payment method specific fields when method changes
        if (!in_array($value, ['credit_card', 'debit_card'])) {
            $this->reset(['cardNumber', 'cardExpiry', 'cvv']);
        }
        if ($value !== 'ovo') {
            $this->reset(['ovoPhone']);
        }
    }

    public function updatedCardNumber($value)
    {
        // Remove non-numeric characters and format card number
        $cleaned = preg_replace('/[^0-9]/', '', $value);
        $this->cardNumber = $cleaned;
    }

    public function updatedCardExpiry($value)
    {
        // Format expiry date as MM/YY
        $cleaned = preg_replace('/[^0-9]/', '', $value);
        if (strlen($cleaned) >= 2) {
            $month = substr($cleaned, 0, 2);
            $year = substr($cleaned, 2, 2);
            $this->cardExpiry = $month . ($year ? '/' . $year : '');
        } else {
            $this->cardExpiry = $cleaned;
        }
    }

    public function updatedCvv($value)
    {
        // Keep only numeric characters for CVV
        $this->cvv = preg_replace('/[^0-9]/', '', $value);
    }


    public function madePayment()
    {
        // Validate all form fields
        $this->validate();

        // Check if cart is not empty
        if (empty($this->cartItems)) {
            session()->flash('error', 'Keranjang kosong! Silakan tambahkan tiket terlebih dahulu.');
            return;
        }

        // Check if user is authenticated
        if (!Auth::check()) {
            session()->flash('error', 'Anda harus login terlebih dahulu.');
            return redirect()->route('login');
        }

        try {
            DB::beginTransaction();

            // Create invoice record
            $invoice = Invoice::create([
                'user_id' => Auth::id(),
                'total_price' => $this->totalAmount,
                'payment_method' => $this->metode,
                'status' => 'paid', // Set as paid for successful payment
            ]);

            // Attach tickets to invoice with quantities
            foreach ($this->cartItems as $cartItem) {
                $invoice->tickets()->attach($cartItem['product']->id, [
                    'quantity' => $cartItem['quantity'],
                    'used_quantity' => 0
                ]);
            }

            DB::commit();

            // Clear cart after successful payment
            session()->forget('cart');
            $this->refreshCart();
            
            // Dispatch event to update queue widget
            $this->dispatch('ticketPurchased');

            session()->flash('success', 'Pembayaran berhasil diproses! Invoice #' . $invoice->id . ' telah dibuat.');

            // Reset form fields
            $this->reset([
                'metode', 'namaLengkap', 'email', 'noTelp', 
                'cardNumber', 'cardExpiry', 'cvv', 'ovoPhone'
            ]);
            
            // Dispatch event to update cart badge
            $this->dispatch('cartUpdated');

            // Redirect to invoice page
            return redirect()->route('invoice', ['id' => $invoice->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
            \Log::error('Payment processing error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.cart-page-checkout');
    }
}