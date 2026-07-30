<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil/tentang-dinkes', function () {
    return view('profil');
})->name('profil.tentang');

Route::get('/ppid', function () {
    return view('ppid');
})->name('ppid');

// Admin Login Routes (Double-Gatekeeper)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/dinkes-login', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/dinkes-login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors([
        'email' => 'Kredensial yang dimasukkan tidak cocok dengan data kami.',
    ])->onlyInput('email');
});

Route::post('/dinkes-logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/admin/dashboard', function () {
    return view('welcome'); // sementara redirect ke welcome atau render teks info
})->middleware('auth')->name('admin.dashboard');


