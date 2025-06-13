<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\ContactUs;
use App\Livewire\Pages\NewsUser;


Route::get('/', Home::class);
Route::get('/contact-us', ContactUs::class);
Route::get('/news', NewsUser::class);

