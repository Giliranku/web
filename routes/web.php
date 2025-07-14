<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\MyNewPage;
use App\Livewire\Pages\TiketEcommerce;
use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\CartPage2;

Route::get('/', Home::class);

Route::get('/newPage', MyNewPage::class)->name('my-new-page');

Route::get('/tiketEcommerce', TiketEcommerce::class)->name('tiket-ecommerce');

Route::get('/cartPage', CartPage::class)->name('cart-page');

Route::get('/cartPage2', CartPage2::class)->name('cart-page2');

Route::get('/newPage', MyNewPage::class)->name('my-new-page');

Route::get('/tiketEcommerce', TiketEcommerce::class)->name('tiket-ecommerce');

Route::get('/submitCartPage2', [CartPage2::class, 'submitBayar']);

