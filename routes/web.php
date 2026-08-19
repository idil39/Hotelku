<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;

use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\PaymentController;

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Room Type
        Route::resource('room-types', RoomTypeController::class);

        // Room
        Route::resource('rooms', RoomController::class);

        // Facility
        Route::resource('facilities', FacilityController::class);

        // Booking
        Route::resource('bookings', AdminBookingController::class);

        // Payment
        Route::get('/payments', [AdminPaymentController::class, 'index'])
            ->name('payments.index');

        Route::get('/payments/{payment}', [AdminPaymentController::class, 'show'])
            ->name('payments.show');

        Route::put('/payments/{payment}/approve', [AdminPaymentController::class, 'approve'])
            ->name('payments.approve');

        Route::put('/payments/{payment}/reject', [AdminPaymentController::class, 'reject'])
            ->name('payments.reject');

        // User
        Route::resource('users', UserController::class);

        // Report
        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');

        Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])
            ->name('reports.pdf');

    });

/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', function () {

            return view('customer.dashboard');

        })->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Room
        |--------------------------------------------------------------------------
        */

        Route::get('/booking', [BookingController::class, 'index'])
            ->name('booking.index');

        Route::get('/room/{room}', [BookingController::class, 'show'])
            ->name('room.show');

        Route::get('/booking/{room}', [BookingController::class, 'create'])
            ->name('booking.create');

        Route::post('/booking/{room}', [BookingController::class, 'store'])
            ->name('booking.store');

        Route::get('/history', [BookingController::class, 'history'])
            ->name('history');

        /*
        |--------------------------------------------------------------------------
        | Payment
        |--------------------------------------------------------------------------
        */

        Route::get('/payments', [PaymentController::class, 'index'])
            ->name('payment.index');

        Route::get('/payments/create/{booking}', [PaymentController::class, 'create'])
            ->name('payment.create');

        Route::post('/payments/store/{booking}', [PaymentController::class, 'store'])
            ->name('payment.store');

        Route::get('/payments/{payment}', [PaymentController::class, 'show'])
            ->name('payment.show');

    });

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {

        if (auth()->user()->role === 'admin') {

            return redirect()->route('admin.dashboard');

        }

        return redirect()->route('customer.dashboard');

    })->name('dashboard');

});