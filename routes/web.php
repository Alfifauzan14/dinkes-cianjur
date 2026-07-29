<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil/tentang-dinkes', function () {
    return view('profil');
})->name('profil.tentang');

