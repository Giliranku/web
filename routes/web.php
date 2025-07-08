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
use App\Livewire\Pages\OrderRestoran;
use App\Livewire\Pages\OrderWahana;
use App\Livewire\Pages\History;
use App\Livewire\Pages\restaurantQueueDetail;
use App\Livewire\Pages\WahanaQueueDetail;
use App\Livewire\Pages\PriorityQueue;
use App\Livewire\Pages\LoginPage;
use App\Livewire\Pages\RegisterPage;
use App\Livewire\Pages\InvoicePage  ;
use App\Livewire\Pages\UserProfile;
use App\Livewire\Pages\StaffProfilePage;
use App\Livewire\MyNewPage;
use App\Livewire\TiketEcommerce;
use App\Livewire\CartPage;
use App\Livewire\CartPage2;

Route::get('/', Home::class);
Route::get('/contact-us', ContactUs::class);
Route::get('/news', NewsUser::class);
Route::get('/news-detail', NewsUserDetail::class);
Route::get('/manage-news', ManageNews::class);
Route::get('/manage-news-add', ManageNewsAdd::class);
Route::get('/manage-news-edit', ManageNewsEdit::class);

Route::get('/search', Sorting::class);
Route::get('/wahana-details', WahanaDetails::class)->name('wahana.detail');

Route::get('/order-restoran', OrderRestoran::class);
Route::get('/order-wahana', OrderWahana::class);
Route::get('/history', History::class);

Route::get('/login', LoginPage::class);

Route::get('/register', RegisterPage::class);

Route::get('/invoice', InvoicePage::class);

Route::get('/userprofile', UserProfile::class);

Route::get('/staffprofile', StaffProfilePage::class);
Route::get('/newPage', MyNewPage::class)->name('my-new-page');

Route::get('/tiketEcommerce', TiketEcommerce::class)->name('tiket-ecommerce');

Route::get('/cartPage', CartPage::class)->name('cart-page');

Route::get('/cartPage2', CartPage2::class)->name('cart-page2');

