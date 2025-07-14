<?php

namespace App\Livewire\Pages;
use Livewire\Attributes\Validate;
use Livewire\Component;

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