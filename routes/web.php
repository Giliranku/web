<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\LoginPage;
use App\Livewire\Pages\RegisterPage;
use App\Livewire\Pages\InvoicePage  ;
use App\Livewire\Pages\UserProfile;

Route::get('/', Home::class);

Route::get('/login', LoginPage::class);

Route::get('/register', RegisterPage::class);

Route::get('/invoice', InvoicePage::class);

Route::get('/userprofile', UserProfile::class);

