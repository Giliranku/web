<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages;
use App\Livewire\MyNewPage;
use App\Livewire\Pages\TiketEcommerce;
use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\CartPage2;


Route::get('/', Home::class)->name('home');
Route::get('/contact-us', ContactUs::class)->name('about');
Route::get('/news', NewsUser::class)->name('news.index');
Route::get('/news-detail/{id}', NewsUserDetail::class);
Route::get('/manage-news', ManageNews::class);
Route::get('/manage-news-add', ManageNewsAdd::class);
Route::get('/manage-news-edit', ManageNewsEdit::class);

Route::get('/search', Sorting::class)->name('queues.index');
Route::get('/wahana-details', WahanaDetails::class)->name('wahana.detail');

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
Route::get('/newPage', MyNewPage::class)->name('my-new-page');

// Route::get('/tiketEcommerce', TiketEcommerce::class)->name('tiket-ecommerce');
Route::get('/tiketEcommerce', TiketEcommerce::class)->name('tickets.index');

Route::get('/cartPage', CartPage::class)->name('cart-page');

Route::get('/cartPage2', CartPage2::class)->name('cart-page2');

Route::get('/newPage', MyNewPage::class)->name('my-new-page');

Route::get('/tiketEcommerce', TiketEcommerce::class)->name('tiket-ecommerce');

Route::get('/submitCartPage2', [CartPage2::class, 'submitBayar']);

