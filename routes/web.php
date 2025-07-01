<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Sorting;
use App\Livewire\Pages\WahanaDetails;
use App\Livewire\Pages\ContactUs;
use App\Livewire\Pages\NewsUser;
use App\Livewire\Pages\NewsUserDetail;
use App\Livewire\Admin\ManageNews;
use App\Livewire\Admin\ManageNewsAdd;
use App\Livewire\Admin\ManageNewsEdit;
use App\Livewire\Pages\restaurantQueueDetail;
use App\Livewire\Pages\WahanaQueueDetail;
use App\Livewire\Pages\PriorityQueue;


Route::get('/', Home::class);
Route::get('/contact-us', ContactUs::class);
Route::get('/news', NewsUser::class);
Route::get('/news-detail', NewsUserDetail::class);
Route::get('/manage-news', ManageNews::class);
Route::get('/manage-news-add', ManageNewsAdd::class);
Route::get('/manage-news-edit', ManageNewsEdit::class);

Route::post('/post/store', [PostController::class, 'store'])->name('posts.store');


Route::get('/search', Sorting::class);
Route::get('/wahana-details', WahanaDetails::class)->name('wahana.detail');

Route::get('/restaurant-queue-detail', RestaurantQueueDetail::class);
Route::get('/wahana-queue-detail', WahanaQueueDetail::class);
Route::get('/priority-queue', PriorityQueue::class);
