<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form or gatekeeper.
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        // Menampilkan view login yang terpadu dengan Gatekeeper
        return view('auth.login');
    }

    /**
     * Handle verification of gatekeeper (Lapis 1) via AJAX.
     */
    public function verifyGatekeeper(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($request->username === 'admin' && $request->password === 'dinkes2026') {
            $request->session()->put('gatekeeper_passed', true);

            return response()->json(['success' => true]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username atau Password Gerbang salah!',
        ], 401);
    }

    /**
     * Handle standard database authentication (Lapis 2).
     */
    public function login(Request $request)
    {
        // Pastikan user sudah melewati gerbang lapis 1
        if (! $request->session()->get('gatekeeper_passed')) {
            return response()->json([
                'success' => false,
                'message' => 'Akses Terlarang. Lewati Gerbang Lapis 1 terlebih dahulu.',
            ], 403);
        }

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['success' => true]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Kredensial yang dimasukkan tidak cocok dengan data kami.',
        ], 401);
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Hapus status gatekeeper agar harus mengisi dari awal kembali
        $request->session()->forget('gatekeeper_passed');

        return redirect('/');
    }
}
