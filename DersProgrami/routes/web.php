<?php
use App\Http\Controllers\BolumController;
use App\Http\Controllers\DersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BirimController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SinifController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'showDersProgramlari'])
    ->name('home.dersProgramiGoruntule');

Route::get('/ders-programlari', [HomeController::class, 'dersProgramlari'])
    ->name('home.dersProgramlari');

Route::get('/api/bolumler/{birimId}', [HomeController::class, 'getBolumlerByBirim']);


Route::get('home/dersProgramiOlustur', [HomeController::class, 'dersProgramiOlustur'])
    ->name('home.dersProgramiOlustur');

Route::post('home/dersProgramiOlustur', [HomeController::class, 'submitDersProgramiOlustur'])
    ->name('home.dersProgramiOlustur.submit');


Route::get('login', [LoginController::class, 'index'])->name('login'); // Giriş sayfası
Route::post('login', [LoginController::class, 'postLogin'])->name('postLogin'); // Giriş işlemi
Route::post('logout', [LoginController::class, 'logout'])->name('logout'); // Giriş işlemi

Route::group(['prefix' => 'admin'], function () {
    // AdminController routes
    Route::get('/kullanicilar', [AdminController::class, 'kullaniciListesi'])->name('admin.kullanici.listesi');
    Route::get('/kullanicilar/ekle', [AdminController::class, 'kullaniciEkleForm'])->name('admin.kullanici.ekle.form');
    Route::post('/kullanicilar/ekle', [AdminController::class, 'kullaniciEkle'])->name('admin.kullanici.ekle');
    Route::post('/kullanicilar/duzenle/{id}', [AdminController::class, 'kullaniciGuncelle'])->name('admin.kullanici.guncelle');
    Route::get('/kullanicilar/duzenle/{id}', [AdminController::class, 'kullaniciDuzenleForm'])->name('admin.kullanici.duzenle.form');
    Route::get('/kullanicilar/sil/{id}', [AdminController::class, 'kullaniciSil'])->name('admin.kullanici.sil');
    Route::get('/get-options', [AdminController::class, 'getOptions'])->name('admin.get.options');


    Route::get('/birimler', [BirimController::class, 'index'])->name('admin.birimler.index');
    Route::get('/birimler/{id}/edit', [BirimController::class, 'edit'])->name('admin.birimler.edit');
    Route::post('/birimler/{id}', [BirimController::class, 'update'])->name('admin.birimler.update');
    Route::post('/birimler', [BirimController::class, 'store'])->name('admin.birimler.store');
    Route::get('/birimler/{id}', [BirimController::class, 'destroy'])->name('admin.birimler.destroy');


    Route::get('/bolumler', [BolumController::class, 'index'])->name('admin.bolumler.index');
    Route::get('/bolumler/{id}/edit', [BolumController::class, 'edit'])->name('admin.bolumler.edit');
    Route::post('/bolumler/{id}', [BolumController::class, 'update'])->name('admin.bolumler.update');
    Route::post('/bolumler', [BolumController::class, 'store'])->name('admin.bolumler.store');
    Route::get('/bolumler/{id}', [BolumController::class, 'destroy'])->name('admin.bolumler.destroy');

    Route::get('/dersler', [DersController::class, 'index'])->name('admin.dersler.index');
    Route::get('/dersler/{id}/edit', [DersController::class, 'edit'])->name('admin.dersler.edit');
    Route::post('/dersler/{id}', [DersController::class, 'update'])->name('admin.dersler.update');
    Route::post('/dersler', [DersController::class, 'store'])->name('admin.dersler.store');
    Route::get('/dersler/{id}', [DersController::class, 'destroy'])->name('admin.dersler.destroy');


    Route::get('/siniflar', [SinifController::class, 'index'])->name('admin.siniflar.index');
    Route::get('/siniflar/{id}/edit', [SinifController::class, 'edit'])->name('admin.siniflar.edit');
    Route::post('/siniflar/{id}', [SinifController::class, 'update'])->name('admin.siniflar.update');
    Route::post('/siniflar', [SinifController::class, 'store'])->name('admin.siniflar.store');
    Route::get('/siniflar/{id}', [SinifController::class, 'destroy'])->name('admin.siniflar.destroy');
});

