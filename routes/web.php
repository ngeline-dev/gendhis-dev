<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterTravelController;
use App\Http\Controllers\MasterBimbelController;
use App\Http\Controllers\MasterJasaFotoController;
use App\Http\Controllers\ListPaketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListCustomerController;
use App\Http\Controllers\AboutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.beranda');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Login */
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('post.login');

/* Register */
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('post.login');

/* Logout */
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/* Dashboard Customer */
Route::get('/beranda', [DashboardController::class, 'indexcust'])->name('user.beranda');

/* List Paket */
Route::get('/list-paket-travel', [ListPaketController::class, 'ListTravel'])->name('list-paket.travel');
Route::get('/list-paket-bimbel', [ListPaketController::class, 'ListBimbel'])->name('list-paket.bimbel');
Route::get('/list-paket-jasa-foto', [ListPaketController::class, 'ListJasaFoto'])->name('list-paket.foto');

/* Middleware && Auth */
Route::group(['middleware' => 'auth'], function(){
    /* Admin */
    Route::group(['middleware' => 'CheckRole:Admin'], function(){
        /* Master Travel */
        Route::resource('master-travel', MasterTravelController::class, ['except' => [
            'update', 'destroy'
        ]]);
        Route::post('/master-travel/{master_travel}', [MasterTravelController::class, 'update'])->name('master-travel.update');
        Route::get('/master-travel/{master_travel}', [MasterTravelController::class, 'destroy'])->name('master-travel.destroy');

        /* Master Bimbel */
        Route::resource('master-bimbel', MasterBimbelController::class, ['except' => [
            'update', 'destroy'
        ]]);
        Route::post('/master-bimbel/{master_bimbel}', [MasterBimbelController::class, 'update'])->name('master-bimbel.update');
        Route::get('/master-bimbel/{master_bimbel}', [MasterBimbelController::class, 'destroy'])->name('master-bimbel.destroy');

        /* Master Jasa Foto */
        Route::resource('master-jasa-foto', MasterJasaFotoController::class, ['except' => [
            'update', 'destroy'
        ]]);
        Route::post('/master-jasa-foto/{master_jasa_foto}', [MasterJasaFotoController::class, 'update'])->name('master-jasa-foto.update');
        Route::get('/master-jasa-foto/{master_jasa_foto}', [MasterJasaFotoController::class, 'destroy'])->name('master-jasa-foto.destroy');

        /* List Order Travel */
        Route::get('/list-order-travel', [OrderController::class, 'ListOrderTravel'])->name('list-order.travel');
        Route::get('/list-order-travel/create', [OrderController::class, 'ListOrderTravelCreate'])->name('list-order-create.travel');

        /* List Order Bimbel */
        Route::get('/list-order-bimbel', [OrderController::class, 'ListOrderBimbel'])->name('list-order.bimbel');
        Route::get('/list-order-bimbel/create', [OrderController::class, 'ListOrderBimbelCreate'])->name('list-order-create.bimbel');

        /* List Order Jasa Foto */
        Route::get('/list-order-jasa-foto', [OrderController::class, 'ListOrderJasaFoto'])->name('list-order.foto');
        Route::get('/list-order-jasa-foto/create', [OrderController::class, 'ListOrderJasaFotoCreate'])->name('list-order-create.foto');

        /* Store Offline */
        Route::post('/store-offline', [OrderController::class, 'OfflineStore'])->name('offline.store');

        /* Konfirmasi */
        Route::post('/konfirmasi-order/{id}', [OrderController::class, 'KonfirmasiOrder'])->name('order.konfirmasi');
        Route::post('/konfirmasi-pembayaran/{id}', [OrderController::class, 'KonfirmasiPembayaran'])->name('pembayaran.konfirmasi');

        /* List Customer */
        Route::get('/list-customer', [ListCustomerController::class, 'ListCustomer'])->name('list.customer');
    });

    /* Customer */
    Route::group(['middleware' => 'CheckRole:Customer'], function(){
        /* Order */
        Route::get('/form-order/{id}', [OrderController::class, 'FormOrder'])->name('form.order');
        Route::post('/form-order/{id}', [OrderController::class, 'StoreOrder'])->name('store.order');
        Route::get('/history-order', [OrderController::class, 'HistoryOrder'])->name('history.order');

        /* Transaksi */
        Route::get('/form-pembayaran/{id}', [TransaksiController::class, 'FormPembayaran'])->name('form.pembayaran');
        Route::post('/form-pembayaran/{id}', [TransaksiController::class, 'StorePembayaran'])->name('store.pembayaran');
        Route::get('/cetak-nota-bayar/{id}/{kategori}', [TransaksiController::class, 'CetakNota'])->name('cetak.nota');

        /* Profile */
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile',  [ProfileController::class, 'update']);

        /* About */
        Route::get('/about', [AboutController::class, 'index'])->name('about');

    });

    /* Owner */
    Route::group(['middleware' => 'CheckRole:Owner'], function(){
        /* Master Kelola Admin */
        Route::resource('master-kelolaadmin', OwnerController::class, ['except' => [
            'update', 'destroy'
        ]]);
        Route::post('/master-kelolaadmin/{master_kelolaadmin}', [OwnerController::class, 'update'])->name('master-kelolaadmin.update');
        Route::get('/master-kelolaadmin/{master_kelolaadmin}', [OwnerController::class, 'destroy'])->name('master-kelolaadmin.destroy');

    });

    /* Owner & Admin */
    Route::group(['middleware' => 'CheckRole:Owner,Admin'], function(){
        /* Owner & admin */
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /* Laporan Travel */
        Route::get('/laporan-travel', [TransaksiController::class, 'LaporanTravel'])->name('laporan.travel');
        Route::post('/laporan-travel', [TransaksiController::class, 'CetakLaporanTravel'])->name('cetak-laporan.travel');

        /* Laporan Bimbel */
        Route::get('/laporan-bimbel', [TransaksiController::class, 'LaporanBimbel'])->name('laporan.bimbel');
        Route::post('/laporan-bimbel', [TransaksiController::class, 'CetakLaporanBimbel'])->name('cetak-laporan.bimbel');

        /* Laporan Jasa Foto */
        Route::get('/laporan-jasa-foto', [TransaksiController::class, 'LaporanJasaFoto'])->name('laporan.foto');
        Route::post('/laporan-jasa-foto', [TransaksiController::class, 'CetakLaporanJasaFoto'])->name('cetak-laporan.foto');
    });

});
