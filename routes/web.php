<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\restaurantQueueDetail;
use App\Livewire\Pages\WahanaQueueDetail;
use App\Livewire\Pages\PriorityQueue;

Route::get('/', Home::class);
Route::get('/restaurant-queue-detail', RestaurantQueueDetail::class);
Route::get('/wahana-queue-detail', WahanaQueueDetail::class);
Route::get('/priority-queue', PriorityQueue::class);