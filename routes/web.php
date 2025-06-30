<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\ContactUs;
use App\Livewire\Pages\NewsUser;
use App\Livewire\Pages\NewsUserDetail;
use App\Livewire\Admin\ManageNews;
use App\Livewire\Admin\ManageNewsAdd;
use App\Livewire\Admin\ManageNewsEdit;


Route::get('/', Home::class);
Route::get('/contact-us', ContactUs::class);
Route::get('/news', NewsUser::class);
Route::get('/news-detail', NewsUserDetail::class);
Route::get('/manage-news', ManageNews::class);
Route::get('/manage-news-add', ManageNewsAdd::class);
Route::get('/manage-news-edit', ManageNewsEdit::class);

Route::post('/post/store', [PostController::class, 'store'])->name('posts.store');


