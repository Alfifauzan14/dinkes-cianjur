<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/berita', function () {
    return view('berita');
})->name('berita');

Route::get('/profil/tentang-dinkes', function () {
    return view('profil');
})->name('profil.tentang');

Route::get('/ppid', function () {
    return view('ppid');
})->name('ppid');

Route::get('/agenda', function () {
    return view('agenda');
})->name('agenda');

/* --- Satu Data Kesehatan Routes --- */
Route::get('/satu-data/statistik', function () {
    return view('statistik');
})->name('satudata.statistik');

Route::get('/satu-data/laporan', function () {
    return view('laporan');
})->name('satudata.laporan');

Route::get('/satu-data/regulasi', function () {
    return view('regulasi');
})->name('satudata.regulasi');

/* --- Labkesda & Faskes Routes --- */
Route::get('/media', function () {
    return view('media');
})->name('media');

Route::get('/faskes', function () {
    return view('faskes');
})->name('faskes');

Route::get('/labkesda', function () {
    return view('labkesda');
})->name('labkesda');

use App\Http\Controllers\AuthController;

/* --- Admin Login Routes (Double-Gatekeeper) --- */
Route::get('/dinkes-login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/dinkes-gatekeeper', [AuthController::class, 'verifyGatekeeper'])->name('gatekeeper.verify');
Route::post('/dinkes-login', [AuthController::class, 'login'])->name('login.post');
Route::post('/dinkes-logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::get('/layanan-terpadu', function () {
    return view('layanan-terpadu');
})->name('layanan-terpadu');

Route::get('/cianjur-bebas-stunting', function () {
    return view('stunting');
})->name('stunting');

Route::get('/kesehatan-ibu-anak', function () {
    return view('kia');
})->name('kia');
