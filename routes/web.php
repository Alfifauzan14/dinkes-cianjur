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

Route::get('/satu-data/statistik', function () {
    return view('statistik');
})->name('satudata.statistik');

Route::get('/satu-data/laporan', function () {
    return view('laporan');
})->name('satudata.laporan');

// Admin Login Routes (Double-Gatekeeper)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/dinkes-login', function (Request $request) {
    // Jika sudah lolos gerbang lapis 1 (session gatekeeper_passed ada)
    if ($request->session()->get('gatekeeper_passed')) {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    // Gunakan HTTP Basic Authentication bawaan browser untuk Lapis 1
    $username = $request->getUser();
    $password = $request->getPassword();

    if ($username === 'admin' && $password === 'dinkes2026') {
        $request->session()->put('gatekeeper_passed', true);
        return redirect('/dinkes-login');
    }

    // Jika belum login / menekan cancel, kirim header WWW-Authenticate untuk memicu pop-up asli
    return response('<html><script>alert("Akses Ditolak! Kredensial Gerbang Salah."); window.location.href="/";</script></html>', 401, [
        'WWW-Authenticate' => 'Basic realm="Akses Terbatas Dinkes"'
    ]);
})->name('login');

Route::post('/dinkes-login', function (Request $request) {
    // Pastikan user sudah melewati gerbang lapis 1
    if (!$request->session()->get('gatekeeper_passed')) {
        return abort(403, 'Akses Terlarang.');
    }

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
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');


