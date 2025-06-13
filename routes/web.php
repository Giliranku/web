<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Sorting;
use App\Livewire\Pages\WahanaDetails;


Route::get('/', Home::class);

Route::get('/search', Sorting::class);
Route::get('/wahana-details', WahanaDetails::class)->name('wahana.detail');
