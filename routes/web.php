<?php

use App\Livewire\Admin\AttracionListManage;
use App\Livewire\Admin\AttracionListManageAdd;
use App\Livewire\Admin\AttracionListManageEdit;

// New Admin Management Components
use App\Livewire\Admin\ManageStaff;
use App\Livewire\Admin\AddStaff;
use App\Livewire\Admin\EditStaff;
use App\Livewire\Admin\ManageAttractions;
use App\Livewire\Admin\AddAttraction;
use App\Livewire\Admin\EditAttraction;
use App\Livewire\Admin\ManageRestaurants;
use App\Livewire\Admin\AddRestaurant;
use App\Livewire\Admin\EditRestaurant;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// User Pages Components
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Sorting;
use App\Livewire\Pages\WahanaDetails;
use App\Livewire\Pages\ContactUs;
use App\Livewire\Pages\NewsUser;
use App\Livewire\Pages\NewsUserDetail;
use App\Livewire\Pages\restaurantQueueDetail;
use App\Livewire\Pages\WahanaQueueDetail;
use App\Livewire\Pages\PriorityQueue;
use App\Livewire\Pages\OrderQueue;
use App\Livewire\Pages\OrderWahana;
use App\Livewire\Pages\History;
use App\Livewire\Pages\LoginPage;
use App\Livewire\Pages\RegisterPage;
use App\Livewire\Pages\InvoicePage;
use App\Livewire\Pages\UserProfile;
use App\Livewire\Pages\TiketEcommerce;
use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\CartPageCheckout;
use App\Livewire\Pages\ReservationBooking;
use App\Livewire\Pages\QueueWaiting;

// Admin Components
use App\Livewire\Admin\ManageNews;
use App\Livewire\Admin\ManageNewsAdd;
use App\Livewire\Admin\ManageNewsEdit;
use App\Livewire\Admin\ManageTicket;
use App\Livewire\Admin\ManageTicketAdd;
use App\Livewire\Admin\ManageTicketEdit;
use App\Livewire\Admin\ManageTicketComponent;
use App\Livewire\Admin\AddTicketComponent;
use App\Livewire\Admin\EditTicketComponent;
use App\Livewire\Admin\NewsIndex;
use App\Livewire\Admin\NewsCreate;
use App\Livewire\Admin\LoginPage as AdminLoginPage;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\ManageUsers;
use App\Livewire\Admin\EditUser;

// Staff Components
use App\Livewire\Pages\StaffProfilePage;
use App\Livewire\Staff\AttractionManagement;
use App\Livewire\Staff\Restaurant\Dashboard as RestaurantDashboard;
use App\Livewire\Staff\Attraction\Dashboard as AttractionDashboard;
use App\Livewire\Staff\QueueManager;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\TrixImageController;

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
| Routes for regular users (visitors/customers)
| Layout: app, full-screen, or specific user layouts
| These routes are accessible without authentication.
*/

// Public User Routes
Route::get('/', Home::class)->name('home');
Route::get('/about-us', ContactUs::class)->name('about');
Route::get('/news', NewsUser::class)->name('news.index');
Route::get('/news-detail/{id}', NewsUserDetail::class)->name('news.detail');
Route::get('/search', Sorting::class)->name('queues.index');
Route::get('/restaurant/{restaurant:id}', WahanaDetails::class)->name('restaurant.detail');
Route::get('/attraction/{attraction:id}', WahanaDetails::class)->name('attraction.detail');

// Authentication Routes
Route::get('/login', LoginPage::class)->name('login');
Route::get('/register', RegisterPage::class)->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/history', History::class)->name('history');
    Route::get('/userprofile', UserProfile::class)->name('userprofile');
    Route::get('/invoice/{id}', InvoicePage::class)->name('invoice');
    
    // E-commerce Routes
    Route::get('/tiket-ecommerce', TiketEcommerce::class)->name('tiket-ecommerce');
    Route::get('/cart-page', CartPage::class)->name('cart-page');
    Route::get('/cart-checkout', CartPageCheckout::class)->name('cart-page-checkout');
    
    // Reservation Routes
    Route::get('/reserve/attraction/{attraction}', ReservationBooking::class)->name('attraction.reserve');
    Route::get('/reserve/restaurant/{restaurant}', ReservationBooking::class)->name('restaurant.reserve');
    
    // Queue Routes
    Route::get('/queue/waiting/{invoiceId}', QueueWaiting::class)->name('queue.waiting');
    Route::get('/order', OrderQueue::class)->name('order.queue');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
| Routes for super admin
| Layout: dashboard-admin
| These routes are accessible only to authenticated admin users.
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Authentication
    Route::get('/login', AdminLoginPage::class)->name('login');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    
    // Admin Dashboard & Management
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/profile', StaffProfilePage::class)->name('profile');
    
    // User Management
    Route::get('/manage-users', ManageUsers::class)->name('manage-users');
    Route::get('/manage-users/edit/{userId}', EditUser::class)->name('edit-user');
    
    // News Management
    Route::get('/manage-news', NewsIndex::class)->name('manage-news');
    Route::get('/manage-news-add', NewsCreate::class)->name('news.create');
    Route::get('/manage-news-edit/{news}', ManageNewsEdit::class)->name('news.edit');
    
    // Ticket Management
    Route::get('/manage-ticket', ManageTicketComponent::class)->name('ticket.index');
    Route::get('/manage-ticket-add', AddTicketComponent::class)->name('ticket.create');
    Route::get('/manage-ticket-edit/{ticket}', EditTicketComponent::class)->name('ticket.edit');
    
    // Staff Management
    Route::get('/manage-staff', ManageStaff::class)->name('staff.index');
    Route::get('/manage-staff/add', AddStaff::class)->name('staff.create');
    Route::get('/manage-staff/edit/{staff}', EditStaff::class)->name('staff.edit');
    
    // Attraction Management (Admin level)
    Route::get('/manage-attractions', ManageAttractions::class)->name('attractions.index');
    Route::get('/manage-attractions/add', AddAttraction::class)->name('attractions.create');
    Route::get('/manage-attractions/edit/{attraction}', EditAttraction::class)->name('attractions.edit');
    
    // Restaurant Management
    Route::get('/manage-restaurants', ManageRestaurants::class)->name('restaurants.index');
    Route::get('/manage-restaurants/add', AddRestaurant::class)->name('restaurants.create');
    Route::get('/manage-restaurants/edit/{restaurant}', EditRestaurant::class)->name('restaurants.edit');
    
    // Legacy Attraction Management (keep for backward compatibility)
    Route::get('/attraction-list', AttracionListManage::class)->name('attractions.manage');
    Route::get('/attraction-list/add', AttracionListManageAdd::class)->name('attractions.create.legacy');
    Route::get('/attraction-list/edit/{attraction}', AttracionListManageEdit::class)->name('attractions.edit.legacy');
});

/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
| Routes for staff members (restaurant & attraction staff)
| Layout: dashboard-restaurant, dashboard-attraction
| These routes are accessible only to authenticated staff users.
| Staff roles are determined by their session data.
*/

Route::prefix('staff')->name('staff.')->group(function () {
    
    // Restaurant Staff Routes
    Route::prefix('restaurant')->name('restaurant.')->group(function () {
        Route::get('/dashboard', RestaurantDashboard::class)->name('dashboard');
        Route::get('/edit', \App\Livewire\Staff\Restaurant\EditRestaurant::class)->name('edit');
        Route::get('/queue/{restaurant}', QueueManager::class)->name('queue');
    });
    
    // Attraction Staff Routes  
    Route::prefix('attraction')->name('attraction.')->group(function () {
        Route::get('/dashboard', AttractionDashboard::class)->name('dashboard');
        Route::get('/edit', \App\Livewire\Staff\Attraction\EditAttraction::class)->name('attraction.edit');
        Route::get('/queue/{attraction}', QueueManager::class)->name('queue');
        Route::get('/manage', AttractionManagement::class)->name('manage');
    });
});

/*
|--------------------------------------------------------------------------
| UTILITY ROUTES
|--------------------------------------------------------------------------
| Routes for file uploads, AJAX requests, etc.
|
*/

// Trix Editor Image Upload
Route::post('/trix/upload', [TrixImageController::class, 'upload'])->name('trix.upload');
Route::delete('/trix/destroy', [TrixImageController::class, 'destroy'])->name('trix.destroy');