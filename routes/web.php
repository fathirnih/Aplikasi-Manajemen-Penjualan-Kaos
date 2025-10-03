<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\OrderController;

//order
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::resource('admin/orders', OrderController::class);
Route::get('admin/orders/create/{lead}', [OrderController::class, 'create'])->name('admin.orders.create');
Route::post('admin/orders', [OrderController::class, 'store'])->name('admin.orders.store');
    
});


// admin dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

        
    Route::resource('leads', LeadController::class);
   // Route::resource('admin/leads', LeadController::class);
    Route::patch('leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.updateStatus');
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('leads', LeadController::class);
});
});




// halaman utama diarahkan ke login
Route::get('/', function () {
    return redirect()->route('login'); // supaya langsung ke login
});

// dashboard user (harus login dulu)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // profile user (harus login)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// auth route bawaan breeze
require __DIR__.'/auth.php';