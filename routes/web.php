<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Sorting;
use App\Livewire\Pages\WahanaDetails;
use App\Livewire\Pages\ContactUs;
use App\Livewire\Pages\NewsUser;
use App\Livewire\Pages\NewsUserDetail;


Route::get('/', Home::class);
Route::get('/contact-us', ContactUs::class);
Route::get('/news', NewsUser::class);
Route::get('/news-detail', NewsUserDetail::class);

Route::get('/search', Sorting::class);
Route::get('/wahana-details', WahanaDetails::class)->name('wahana.detail');
