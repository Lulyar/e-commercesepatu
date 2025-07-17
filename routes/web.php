<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
Route::get('/browse/{category:slug}', [FrontController::class, 'category'])->name('front.category');

// View All routes
Route::get('/all-new', [FrontController::class, 'allNew'])->name('front.all_new');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Profile routes
Route::middleware('auth:customer')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
});

// details/air-jordan, seo friendly
Route::get('/details/{shoe:slug}', [FrontController::class, 'details'])->name('front.details');

Route::get('/check-booking', [OrderController::class, 'checkBooking'])->name('front.check_booking');
Route::post('/check-booking/details', [OrderController::class, 'checkBookingDetails'])->name('front.check_booking_details');

// Order routes that require authentication
Route::middleware('auth:customer')->group(function () {
    Route::post('/order/begin/{shoe:slug}', [OrderController::class, 'saveOrder'])->name('front.save_order');
    Route::get('/order/booking', [OrderController::class, 'booking'])->name('front.booking');
    Route::get('/order/booking/customer-data', [OrderController::class, 'customerData'])->name('front.customer_data');
    Route::post('/order/booking/customer-data/save', [OrderController::class, 'saveCustomerData'])->name('front.save_customer_data');
    Route::get('/order/payment', [OrderController::class, 'payment'])->name('front.payment');
    Route::post('/order/payment/confirm', [\App\Http\Controllers\OrderController::class, 'paymentConfirm'])->name('paymentConfirm');
    Route::get('/order/finished/{bookingId}', [\App\Http\Controllers\OrderController::class, 'orderFinished'])->name('order.finished');
    Route::get('/order/form', [\App\Http\Controllers\OrderController::class, 'form'])->name('order.form');
    Route::get('/order/my-order', [\App\Http\Controllers\OrderController::class, 'checkBooking'])->name('order.my_order');
});

// Location API routes
Route::get('/api/cities', [OrderController::class, 'getCities'])->name('api.cities');
Route::get('/api/cities/search', [OrderController::class, 'searchCities'])->name('api.cities.search');
Route::get('/api/postal-codes', [OrderController::class, 'getPostalCodes'])->name('api.postal_codes');
