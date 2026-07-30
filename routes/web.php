<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/berita', function () {
    return view('berita');
});

Route::get('/profil/tentang-dinkes', function () {
    return view('profil');
})->name('profil.tentang');

Route::get('/ppid', function () {
    return view('ppid');
})->name('ppid');

Route::get('/agenda', function () {
    return view('agenda');
})->name('agenda');

Route::get('/media', function () {
    return view('media');
})->name('media');
