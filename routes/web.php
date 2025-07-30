<?php

use App\Http\Controllers\Admin\AdminBeritaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UIController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SlideshowController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\SosialMediaController;
use App\Http\Controllers\Admin\SambutanController;

/*
|--------------------------------------------------------------------------
| Route untuk Autentikasi
|--------------------------------------------------------------------------
*/

Route::get('a9b7c3x-login-access', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('a9b7c3x-login-access', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// ❌ Blokir akses ke route /login lama
Route::get('login', function () {
    abort(404); // atau return redirect('/');
});
Route::post('login', function () {
    abort(404); // untuk keamanan, POST juga diblok
});

/*
|--------------------------------------------------------------------------
| Route Halaman Publik (UI)
|--------------------------------------------------------------------------
*/
Route::get('/', [UIController::class, 'home'])->name('beranda');
Route::get('/profil', [UIController::class, 'profil'])->name('profil');
Route::get('/tentang', [UIController::class, 'tentang'])->name('tentang');

// Halaman Kontak dengan Form Penilaian
Route::get('/kontak', [UIController::class, 'kontak'])->name('kontak');
Route::post('/kontak/penilaian', [UIController::class, 'storePenilaian'])->name('penilaian.store');

/*
|--------------------------------------------------------------------------
| Route Halaman Sub (Profil dan Layanan)
|--------------------------------------------------------------------------
*/

// ROUTE PROFIL
Route::get('/visi_misi', [UIController::class, 'visiMisi'])->name('profil.visi_misi');
Route::get('/struktur', [UIController::class, 'struktur'])->name('profil.struktur');
Route::get('/galeri', [UIController::class, 'galeri'])->name('profil.galeri');
Route::get('/landasan_hukum', [UIController::class, 'landasanHukum'])->name('profil.landasan_hukum');

// ROUTE LAYANAN
Route::get('/layanan/alur-pembayaran', [UIController::class, 'alurPembayaran'])->name('layanan.alur_pembayaran');
Route::get('/layanan/jenis-pajak', [UIController::class, 'jenisPajak'])->name('layanan.jenis_pajak');
Route::get('/layanan/aplikasi', [UIController::class, 'aplikasiPajak'])->name('layanan.aplikasi');

/*
|--------------------------------------------------------------------------
| Berita Publik
|--------------------------------------------------------------------------
*/
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');

/*
|--------------------------------------------------------------------------
| Placeholder Halaman Pengembangan
|--------------------------------------------------------------------------
*/
Route::view('/pengembangan', 'ui.pengembangan')->name('pengembangan');

/*
|--------------------------------------------------------------------------
| Route Admin (Hanya Untuk Admin Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Admin
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Berita Admin
    |--------------------------------------------------------------------------
    */
    Route::get('/berita', [AdminBeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create', [AdminBeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [AdminBeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{id}/edit', [AdminBeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{id}', [AdminBeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}', [AdminBeritaController::class, 'destroy'])->name('berita.destroy');

    /*
    |--------------------------------------------------------------------------
    | Slideshow Admin
    |--------------------------------------------------------------------------
    */
    Route::resource('slideshow', SlideshowController::class)->only(['index', 'create', 'store', 'destroy']);

    /*

    /*
    |--------------------------------------------------------------------------
    | Sambutan Admin
    |--------------------------------------------------------------------------
    */
       Route::get('/sambutan', [SambutanController::class, 'index'])->name('sambutan.index');
    Route::get('/sambutan/edit', [SambutanController::class, 'edit'])->name('sambutan.edit');
    Route::put('/sambutan/update', [SambutanController::class, 'update'])->name('sambutan.update');

    /*
    |--------------------------------------------------------------------------
    | Visi Misi Admin
    |--------------------------------------------------------------------------
    */
    // Visi Misi
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.index');
    Route::get('/visi-misi/create', [VisiMisiController::class, 'create'])->name('visi-misi.create');
    Route::post('/visi-misi', [VisiMisiController::class, 'store'])->name('visi-misi.store');
    Route::get('/visi-misi/{visiMisi}/edit', [VisiMisiController::class, 'edit'])->name('visi-misi.edit');
    Route::put('/visi-misi/{visiMisi}', [VisiMisiController::class, 'update'])->name('visi-misi.update');
    Route::delete('/visi-misi/{visiMisi}', [VisiMisiController::class, 'destroy'])->name('visi-misi.destroy');

    // Struktur Organisasi
    Route::get('/struktur', [StrukturOrganisasiController::class, 'index'])->name('struktur.index');
    Route::get('/struktur/create', [StrukturOrganisasiController::class, 'create'])->name('struktur.create');
    Route::post('/struktur', [StrukturOrganisasiController::class, 'store'])->name('struktur.store');
    Route::get('/struktur/{struktur}/edit', [StrukturOrganisasiController::class, 'edit'])->name('struktur.edit');
    Route::put('/struktur/{struktur}', [StrukturOrganisasiController::class, 'update'])->name('struktur.update');
    Route::delete('/struktur/{struktur}', [StrukturOrganisasiController::class, 'destroy'])->name('struktur.destroy');

    // Galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/{galeri}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
    Route::get('/kontak/create', [KontakController::class, 'create'])->name('kontak.create');
    Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
    Route::get('/kontak/{kontak}/edit', [KontakController::class, 'edit'])->name('kontak.edit');
    Route::put('/kontak/{kontak}', [KontakController::class, 'update'])->name('kontak.update');
    Route::delete('/kontak/{kontak}', [KontakController::class, 'destroy'])->name('kontak.destroy');

    Route::get('/sosialmedia', [SosialMediaController::class, 'index'])->name('sosialmedia.index');
    Route::get('/sosialmedia/create', [SosialMediaController::class, 'create'])->name('sosialmedia.create');
    Route::post('/sosialmedia', [SosialMediaController::class, 'store'])->name('sosialmedia.store');
    Route::get('/sosialmedia/{id}/edit', [SosialMediaController::class, 'edit'])->name('sosialmedia.edit');
    Route::put('/sosialmedia/{id}', [SosialMediaController::class, 'update'])->name('sosialmedia.update');
    Route::delete('/sosialmedia/{id}', [SosialMediaController::class, 'destroy'])->name('sosialmedia.destroy');

});
