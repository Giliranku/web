<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\ContactUs;


Route::get('/', Home::class);
Route::get('/contact-us', ContactUs::class);

