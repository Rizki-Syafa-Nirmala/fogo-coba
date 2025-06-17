<?php

use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\Pelanggan\MakananController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\LogoutController;


// Route::get('/storage/{path}', function ($path) {
//     $fullPath = storage_path('app/public/' . $path);

//     if (!File::exists($fullPath)) {
//         abort(404);
//     }

//     return Response::file($fullPath);
// })->where('path', '.*');
// untuk guest
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->is_admin) {
            // Jika admin, arahkan ke panel Filament
            return redirect()->route('filament.user.pages.dashboard');
        } else {
            // Jika user biasa
            return redirect()->route('foods');
        }
    }
    // Kalau belum login, tampilkan halaman guest
    return redirect()->route('guest.home');
})->name('gerbang');
Route::middleware('guest')->group(function () {


    Route::get('/home/guest', [MakananController::class, 'index'])->name('guest.home');
    Route::get('/about', function () {
        return view('guest.about');
    });

    // Redirect /login ke route login Filament yang ada di /user/login
    Route::get('/login', function () {
        return redirect('/user/login');
    })->name('login');

    Route::get('edukasi', function () {
        return view('guest.edukasi');
    })->name('edukasi');
});

// Rute untuk halaman home dengan pengecekan apakah sudah login
Route::middleware(['auth', 'cekDevice'])->group(function () {

    Route::prefix('mobile')->name('mobile.')->group(function () {
        Route::get('/profile', function () {
            return view('user-mobile.profile');
        })->name('profile');
        Route::get('/profile-saya', function () {
            return view('user-mobile.profile-saya');
        })->name('profile-saya');
        Route::get('/profile/pengaturan-alamat', function () {
            return view('user-mobile.alamat');
        })->name('pengaturan-alamat');
        Route::get('/profile/ganti-password', function () {
            return view('user-mobile.ganti-password');
        })->name('ganti-password');
        Route::get('/foods', [MakananController::class, 'index'])->name('foods');
        Route::get('/detailmakanan/mobile/{id}', [MakananController::class, 'detailmakanan'])->name('detailmakanan')->where('id', '[0-9]+'); //mobile
        Route::get('/rekomendasi/mobile/{filter}', [RekomendasiController::class, 'rekomendasimakananmobile'])->name('rekomendasimobile');
        Route::get('/makanan/Kategori/{kategori?}', [MakananController::class, 'semuamakananmobile'])->name('makananmobile');
        Route::get('/transaksi-berlangsung', [TransaksiController::class, 'transaksi'])->name('transaksiberlangsung');
        Route::get('/ajax/transaksi', [TransaksiController::class, 'ajaxStatus'])->name('ajax.transaksi.statusSemua');
        Route::get('/semua', [TransaksiController::class, 'semuatransaksi'])->name('semua-transaksi');
        Route::get('/transaksi/{id}', [TransaksiController::class, 'tampilkantransaksi'])->name('transaksi.lihat')->where('id', '[0-9]+');
        Route::post('/transaksi/{id}/selesai', [MakananController::class, 'update'])->name('transaksi.selesai')->where('id', '[0-9]+');
        Route::get('/transaksi/{id}/bayar', [TransaksiController::class, 'bayar'])->name('bayar')->where('id', '[0-9]+');
        Route::post('/transaksi/beli', [TransaksiController::class, 'buattransaksi'])->name('buat.transaksi');
        Route::post('/update-password', [UserController::class, 'updatePassword'])->name('password.update');
        Route::get('/ulasan/{id}', [ReviewController::class, 'create'])->name('ulasan');
        Route::post('ulasan/{id}/rating', [ReviewController::class, 'rate'])->name('transaksi.ulasan')->where('id', '[0-9]+');    Route::post('/transaksi/hitung-potongan/{id}', [TransaksiController::class, 'hitungPotongan'])->name('hitungPotongan');
        Route::post('/transaksi/hitung-potongan/{id}', [TransaksiController::class, 'hitungPotongan'])->name('hitungPotongan');



        Route::get('/transaksi', function () {
            return view('user-mobile.detail-transaksi');
        });

    });
    Route::get('/foods', [MakananController::class, 'index'])->name('foods');
    Route::get('/makanan/Kategori/{kategori?}', [MakananController::class, 'byCategory'])->name('makanan.kategori');
    Route::get('/semua-transaksi', [MakananController::class, 'userTransactions'])->name('transaksi');
    Route::put('/transaksi/{id}/selesai', [MakananController::class, 'update'])->name('transactions.complete')->where('id', '[0-9]+');

    Route::post('/transaksi/beli', [TransaksiController::class, 'buattransaksi'])->name('transaksi.store');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'tampilkantransaksi'])->name('transaksi.show')->where('id', '[0-9]+');
    Route::get('/transaksi/{id}/bayar', [TransaksiController::class, 'bayar'])->name('bayar')->where('id', '[0-9]+');
    Route::get('/belum-dibayar', [TransaksiController::class, 'transaksi'])->name('belum-dibayar');
    Route::get('/semua', [TransaksiController::class, 'semuatransaksi'])->name('semua-transaksi');
    Route::post('/transaksi/hitung-potongan/{id}', [TransaksiController::class, 'hitungPotongan'])->name('hitungPotongan');

    // route rekomendasi
    Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi');
    Route::get('/rekomendasi/{filter}', [RekomendasiController::class, 'lihatsemua'])->name('lihatsemuarekomendasi');


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

Route::post('/ambil-kota', [LokasiController::class, '__invoke']);
Route::post('/ganti-kota', [LokasiController::class, 'gantiKota'])->name('ganti.kota');


