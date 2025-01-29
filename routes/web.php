<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'home'])->name('home');

Route::middleware(['auth','role:admin|owner'])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::post('/add_roomType', [RoomController::class, 'add_roomType']);
    Route::get('/view_roomType', [RoomController::class, 'view_roomType'])->name('roomTypes.view');
    Route::post('/edit_roomType/{id}', [RoomController::class, 'edit_roomType'])->name('roomTypes.edit');
    Route::get('/delete_roomType/{id}', [RoomController::class, 'delete_roomType']);
    Route::post('/add_room', [RoomController::class, 'add_room']);
    Route::get('/view_room', [RoomController::class, 'view_room'])->name('rooms.view');
    Route::post('/edit_room/{id}', [RoomController::class, 'edit_room']);
    Route::get('/delete_room/{id}', [RoomController::class, 'delete_room']);

    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.booking');
    Route::get('/bookings/delete/{id}', [BookingController::class, 'delete'])->name('admin.bookings.delete');
    Route::post('/bookings/checkout/{id}', [BookingController::class, 'checkout'])->name('admin.bookings.checkout');
    Route::post('/bookings/confirm/{id}', [BookingController::class, 'confirm'])->name('admin.bookings.confirm');
    Route::get('/bookings/cancel/{id}', [BookingController::class, 'cancel'])->name('admin.bookings.cancel');
    Route::get('/bookings/detail-confirm/{id}', [BookingController::class, 'detailconfirm'])->name('admin.bookings.detailconfirm');
    Route::get('/bookings/detail-checkout/{id}', [BookingController::class, 'detailcheckout'])->name('admin.bookings.detailcheckout');

    Route::get('/message', [AdminController::class, 'message']);
    Route::get('/customer', [AdminController::class, 'customer']);

    Route::post('/update_user', [AdminController::class, 'update_user'])->name('update_user');
    Route::get('/report', [AdminController::class, 'report'])->name('report');
});
Route::get('/report/print_invoice/{id}', [AdminController::class, 'print_invoice'])->name('report.print_invoice');

Route::middleware(['auth','role:owner'])->group(function(){
    Route::get('/owner', [AdminController::class, 'owner']);
    Route::get('/bookings/export', [BookingController::class, 'export'])->name('bookings.export');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/history', [HomeController::class, 'history'])->name('history');
});

Route::post('/check-availability', [BookingController::class, 'checkAvailableRooms'])->name('check-availability');
Route::get('/book_room/{id}/{checkin_date}/{checkout_date}', [BookingController::class, 'book'])
    ->middleware('auth')
    ->name('book_room');
Route::post('/book-room', [BookingController::class, 'bookRoom'])->name('booking.bookRoom');

Route::post('/add_to_cart', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/rooms', [HomeController::class, 'room'])->name('rooms');
Route::get('/room_details/{id}', [HomeController::class, 'room_details'])->name('room_details');
Route::post('/add_booking/{id}', [HomeController::class, 'add_booking']);

Route::get('/contact_us', [HomeController::class, 'contact_us'])->name('contact_us');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/about', [HomeController::class, 'about'])->name('about_us');

Route::get('/payment', [PaymentController::class, 'index']);
Route::post('create-invoice', [PaymentController::class, 'createInvoice'])->name('create-invoice');

// Payment success and failure
// route('payment.success', ['id' => $payment->id]),
Route::get('/payment_success/{id}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment_failure/{id}', [PaymentController::class, 'failure'])->name('payment.failure');




