<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Rule;

class CartPageCheckout extends Component
{
    // FIX: Aturan 'in' memastikan hanya nilai-nilai ini yang diterima.
    #[Rule('required|in:mastercard,ovo,bca')]
    public string $metode = ''; // Dikosongkan agar validasi 'required' berfungsi

    #[Rule('required|string|min:3')]
    public string $namaLengkap = '';

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required|numeric')] // FIX: Lebih baik menggunakan 'numeric' untuk nomor telepon
    public string $noTelp = '';

    // FIX: Sintaks 'required_if' diperbaiki. Wajib jika 'metode' adalah 'mastercard'.
    #[Rule('required_if:metode,mastercard|numeric|digits_between:13,19')]
    public string $cardNumber = '';

    // FIX: 'paymentMethod' diubah menjadi 'metode'.
    #[Rule('required_if:metode,mastercard|date')]
    public string $cardExpiry = '';

    // FIX: Menambahkan aturan validasi untuk CVV. Wajib jika 'metode' adalah 'mastercard'.
    #[Rule('required_if:metode,mastercard|numeric|digits:3')]
    public string $cvv = '';

    // FIX: 'paymentMethod' diubah menjadi 'metode'.
    #[Rule('required_if:metode,ovo|numeric')]
    public string $ovoPhone = '';

    public function submitBayar()
    {
        // FIX: Baris ini WAJIB diaktifkan untuk menjalankan semua aturan validasi di atas.
        $this->validate();

        //
        // Logika untuk memproses pembayaran Anda letakkan di sini...
        //

        session()->flash('success', 'Detail Pembayaran Berhasil di Submit !');

        // Reset semua field form setelah berhasil submit
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.cart-page-checkout');
    }
}