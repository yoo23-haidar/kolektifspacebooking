<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaceController;

Route::get('/', function () {
    // We can pass featured spaces here if needed
    $featuredSpaces = \App\Models\Space::limit(4)->get();
    return view('welcome', compact('featuredSpaces'));
})->name('home');

Route::get('/explore', [SpaceController::class, 'index'])->name('explore');
Route::get('/space/{space:slug}', [SpaceController::class, 'show'])->name('space.show');

// Booking Routes (Public)
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

Route::post('/booking/check', [BookingController::class, 'checkAvailability'])->name('booking.check');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}/payment', [PaymentController::class, 'show'])->name('booking.payment');

// Admin Routes
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SpaceController as AdminSpaceController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/spaces', [AdminSpaceController::class, 'index'])->name('spaces.index');
    Route::post('/spaces/{space}/toggle-active', [AdminSpaceController::class, 'toggleActive'])->name('spaces.toggle-active');
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{booking}/cancel', [AdminBookingController::class, 'cancel'])->name('bookings.cancel');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
