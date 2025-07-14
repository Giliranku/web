<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Rule;

class CartPage2 extends Component
{
    #[Rule('required|in:mastercard,ovo,bca')]
    public string $metode = 'mastercard';

    #[Rule('required|string|min:3')]
    public string $namaLengkap = '';

    #[Rule('required|email')]
    public string $email = '';
    
    #[Rule('required')]
    public string $noTelp = '';

    #[Rule('required_if:paymentMethod,mastercard|string')]
    public string $cardNumber = '';

    #[Rule('required_if:paymentMethod,mastercard|string')]
    public string $cardExpiry = '';

    public string $cvv = '';

    #[Rule('required_if:paymentMethod,ovo|string')]
    public string $ovoPhone = '';

    public function submitBayar() {
        // dd($this->all());

        $this->validate();

        session()->flash('success', 'Detail Pembayaran Berhasil di Submit !');
    }

    public function render()
    {
        return view('livewire.pages.cart-page2');
    }
}
