<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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
    return view('home/dersProgramiGoruntule');
});
Route::get('login', [LoginController::class, 'index'])->name('login'); // Giriş sayfası
Route::post('login', [LoginController::class, 'postLogin'])->name('postLogin'); // Giriş işlemi
Route::post('logout', [LoginController::class, 'logout'])->name('logout'); // Giriş işlemi


Route::group(['prefix' => 'admin'], function () {
    // AdminController routes
    Route::get('/kullanicilar', [AdminController::class, 'kullaniciListesi'])->name('admin.kullanici.listesi');
    Route::get('/kullanicilar/ekle', [AdminController::class, 'kullaniciEkleForm'])->name('admin.kullanici.ekle.form');
    Route::post('/kullanicilar/ekle', [AdminController::class, 'kullaniciEkle'])->name('admin.kullanici.ekle');
    Route::get('/kullanicilar/duzenle/{id}', [AdminController::class, 'kullaniciDuzenleForm'])->name('admin.kullanici.duzenle.form');
    Route::post('/kullanicilar/duzenle/{id}', [AdminController::class, 'kullaniciGuncelle'])->name('admin.kullanici.duzenle');
    Route::get('/kullanicilar/sil/{id}', [AdminController::class, 'kullaniciSil'])->name('admin.kullanici.sil');

    // UserController routes
    Route::get('/kullanicilar/{id}', [UserController::class, 'show']);
    Route::post('/kullanicilar', [UserController::class, 'store']);
    Route::put('/kullanicilar/{id}', [UserController::class, 'update']);
    Route::delete('/kullanicilar/{id}', [UserController::class, 'destroy']);
});
