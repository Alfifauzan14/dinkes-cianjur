<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $homeBeritas = \App\Models\Berita::where('status', 'published')
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get();
    return view('welcome', compact('homeBeritas'));
});

Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [App\Http\Controllers\BeritaController::class, 'show'])->name('berita.show');

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

Route::resource('/admin/berita', App\Http\Controllers\Admin\BeritaController::class, [
    'names' => [
        'index' => 'admin.berita.index',
        'create' => 'admin.berita.create',
        'store' => 'admin.berita.store',
        'edit' => 'admin.berita.edit',
        'update' => 'admin.berita.update',
        'destroy' => 'admin.berita.destroy',
    ]
])->middleware('auth');

Route::get('/layanan-terpadu', function () {
    return view('layanan-terpadu');
})->name('layanan-terpadu');

Route::get('/cianjur-bebas-stunting', function () {
    return view('stunting');
})->name('stunting');

Route::get('/kesehatan-ibu-anak', function () {
    return view('kia');
})->name('kia');
