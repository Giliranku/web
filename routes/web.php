<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\MyNewPage;
use App\Livewire\TiketEcommerce;

Route::get('/', Home::class);

Route::get('/newPage', MyNewPage::class)->name('my-new-page');

Route::get('/tiketEcommerce', TiketEcommerce::class)->name('tiket-ecommerce');

