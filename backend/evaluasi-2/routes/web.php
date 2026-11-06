<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DigicamController;
use App\Http\Controllers\KategoriDigicamController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('digicam', DigicamController::class);

Route::resource('kategori-digicam', KategoriDigicamController::class);

Route::view('/admin/about', 'admin.about')->name('admin.about');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');

Route::post('/checkout', [CartController::class, 'storeCheckout'])->name('checkout.store');

Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');

Route::view('/react-digicam', 'react-digicam')->name('react.digicam');

require __DIR__.'/auth.php';