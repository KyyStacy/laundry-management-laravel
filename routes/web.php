<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\LaundryTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ADMIN & KARYAWAN FEATURES
Route::middleware(['auth', 'verified', 'role:admin,karyawan'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/employee/orders', [OrderController::class, 'employeeIndex'])->name('employee.orders.index');
    Route::get('/employee/orders/{order}', [OrderController::class, 'employeeShow'])->name('employee.orders.show');
    Route::put('/employee/orders/{order}', [OrderController::class, 'employeeUpdate'])->name('employee.orders.update');
});


// ADMIN FEATURES
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('users', UserManagementController::class)->except(['show']);
    Route::get('/users/statuses', [UserManagementController::class, 'statuses'])->name('users.statuses');
    Route::resource('laundry-types', LaundryTypeController::class);
});

//PELANGGAN FEATURES
Route::middleware(['auth', 'verified', 'role:pelanggan'])->group(function () {
    Route::resource('addresses', AddressController::class);
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/customer/orders', [OrderController::class, 'customerIndex'])->name('customer.orders.index');
    Route::get('/customer/orders/{order}', [OrderController::class, 'customerShow'])->name('customer.orders.show');

    Route::post('/orders/{order}/process-payment', [OrderController::class, 'processPayment'])->name('orders.process-payment');
    Route::get('/orders/{order}/finish', [OrderController::class, 'finishPayment'])->name('orders.finish');
    Route::get('/orders/{order}/check-payment-status', [OrderController::class, 'checkPaymentStatus'])->name('orders.check-payment-status');
    Route::post('/orders/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/payment-notification', [OrderController::class, 'handlePaymentCallback']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
