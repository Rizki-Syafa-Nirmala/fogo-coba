<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\Pelanggan\MakananController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\LogoutController;


// untuk guest
Route::get('/', function () {
    if (auth()->check()) {
        // Kalau user sudah login, redirect ke halaman dashboard misal
        return redirect()->route('home-user');
    }
    // Kalau belum login, tampilkan halaman guest
    return redirect()->route('guest.home');
});
Route::middleware('guest')->group(function () {
    Route::get('/home/guest', function () {
        return view('guest.home');
    })->name('guest.home');

    Route::get('/about', function () {
        return view('guest.about');
    });

    // Redirect /login ke route login Filament yang ada di /user/login
    Route::get('/login', function () {
        return redirect('/user/login');
    })->name('login');

    // Kalau ada halaman register khusus
    Route::get('/register-mitra', function () {
        return redirect()->route('filament.partner.auth.register');
    })->name('register');
});

// Rute untuk halaman home dengan pengecekan apakah sudah login
Route::middleware('auth')->group(function () {
    Route::get('/home-user', function () {
        return redirect()->route('foods');  // Ganti 'home' dengan view sesuai kebutuhan
    })->name('home-user');


    Route::get('/foods', [MakananController::class, 'index'])->name('foods');
    Route::get('/makanan/category/{kategori}', [MakananController::class, 'byCategory'])->name('makanan.kategori');

    Route::get('/transaksi', [MakananController::class, 'userTransactions'])->name('transaksi');

    Route::post('/transaksi/beli', [TransaksiController::class, 'buattransaksi'])->name('transaksi.store');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'tampilkantransaksi'])->name('transaksi.show');
    Route::get('/transaksi/{id}/bayar', [TransaksiController::class, 'bayar'])->name('bayar');

    Route::get('/transaksi-', function () {
        return redirect()->route('belum-dibayar');  // Ganti 'home' dengan view sesuai kebutuhan
    })->name('transaksi-semua');
    // Route::get('/rekomendasi', function () {
    //     return view('user.rekomendasi');  // Ganti 'home' dengan view sesuai kebutuhan
    // })->name('rekomendasi');

    // route rekomendasi
    Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi');
    Route::get('/rekomendasi/{filter}', [RekomendasiController::class, 'lihatsemua'])->name('lihatsemuarekomendasi');

    Route::get('/belum-dibayar', [TransaksiController::class, 'transaksi'])->name('belum-dibayar');
    Route::get('/semua', [TransaksiController::class, 'semuatransaksi'])->name('semua-transaksi');
    Route::post('/transaksi/hitung-potongan/{id}', [TransaksiController::class, 'hitungPotongan'])->name('hitungPotongan');
    // Route::get('/Transaksi', [TransaksiController::class, 'transaksi'])->name('transaksi.pembayaran');

    Route::put('/transactions/{id}/complete', [MakananController::class, 'update'])->name('transactions.complete');
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

Route::post('/midtrans-callback', [PaymentController::class, 'callback']);

Route::post('/ambil-kota', [LokasiController::class, '__invoke'])->name('ambil.kota');
Route::post('/ganti-kota', [LokasiController::class, 'gantiKota'])->name('ganti.kota');


