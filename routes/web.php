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
use App\Livewire\Pages\OrderQueue;
use App\Livewire\Pages\OrderWahana;
use App\Livewire\Pages\History;
use App\Livewire\Pages\LoginPage;
use App\Livewire\Pages\RegisterPage;
use App\Livewire\Pages\InvoicePage;
use App\Livewire\Pages\UserProfile;
use App\Livewire\Pages\StaffProfilePage;
use App\Livewire\Pages\TiketEcommerce;
use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\CartPageCheckout;

// User routes
Route::get('/', Home::class)->name('home');
Route::get('/about-us', ContactUs::class)->name('about');
Route::get('/news', NewsUser::class)->name('news.index');
Route::get('/news-detail/{id}', NewsUserDetail::class);

Route::get('/search', Sorting::class)->name('queues.index');
Route::get('/wahana-details', WahanaDetails::class)->name('wahana.detail');

// Defined Attraction and Restaurant routes
Route::get('/restaurant/{restaurant:id}', WahanaDetails::class)->name('restaurant.detail');
Route::get('/attraction/{attraction:id}', WahanaDetails::class)->name('attraction.detail');

Route::get('/order', OrderQueue::class);
// Route::get('/order-wahana', OrderWahana::class);
Route::get('/history', History::class)->name('history')->middleware('auth');

Route::get('/login', LoginPage::class)->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/register', RegisterPage::class)->name('register');

Route::get('/invoice/{id}', InvoicePage::class)->name('invoice');

Route::get('/userprofile', UserProfile::class)->name('userprofile')->middleware('login');

Route::get('/staffprofile', StaffProfilePage::class);

// Route::get('/tiketEcommerce', TiketEcommerce::class)->name('tiket-ecommerce');
Route::get('/tiketEcommerce', TiketEcommerce::class)->name('tickets.index');

Route::get('/cartPage', CartPage::class)->name('cart-page');

Route::get('/cartPage2', CartPageCheckout::class)->name('cart-page2');

Route::get('/tiketEcommerce', TiketEcommerce::class)->name('tiket-ecommerce');


// Admin routes
Route::get('/manage-news', ManageNews::class);
Route::get('/manage-news-add', ManageNewsAdd::class);
Route::get('/manage-news-edit', ManageNewsEdit::class);