<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Customer\FoodController;

// untuk guest
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('guest.home');
    });

    Route::get('/about', function () {
        return view('guest.about');
    });


});

// Rute untuk halaman home dengan pengecekan apakah sudah login
Route::middleware('auth')->group(function () {
    Route::get('/home-user', function () {
        return view('user.home');  // Ganti 'home' dengan view sesuai kebutuhan
    })->name('home-user');


    Route::get('/foods', [FoodController::class, 'index'])->name('foods');

    Route::get('/transaksi', [FoodController::class, 'userTransactions'])->name('transaksi');
    Route::post('/order', [FoodController::class, 'storeTransaction'])->name('transactions.store');
    Route::put('/transactions/{id}/complete', [FoodController::class, 'update'])->name('transactions.complete');
    Route::get('/review', [ReviewController::class, 'index'])->name('review');
    Route::put('/review/{id}', [ReviewController::class, 'update'])->name('review.update');

    Route::post('/transactions/{id}/rate', [ReviewController::class, 'rate'])->name('transactions.rate');
    Route::get('/profile', [UserController::class, 'indexprofile'])->name('profile.index');
    Route::get('/account', [UserController::class, 'indexakun'])->name('akun.index');
    Route::post('/update-profile', [UserController::class, 'update'])->name('profile.update');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('password.update');
    Route::delete('/delete-account', [UserController::class, 'deleteAccount'])->name('account.delete');

});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
// Rute untuk pengunjung yang belum login
Route::get('/login', function () {
    return redirect()->route('filament.user.auth.login');
})->name('login');

Route::get('/register-mitra', function () {
    return redirect()->route('filament.partner.auth.register');
})->name('register');




