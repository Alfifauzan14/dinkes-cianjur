<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

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
     * Handle verification of gatekeeper (Lapis 1) via AJAX with rate limiting & timing attack protection.
     */
    public function verifyGatekeeper(Request $request)
    {
        $throttleKey = 'gatekeeper:'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return response()->json([
                'success' => false,
                'message' => "Terlalu banyak percobaan gagal. Silakan coba lagi dalam {$seconds} detik.",
                'retry_after' => $seconds,
            ], 429);
        }

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $expectedUsername = Setting::get('gatekeeper_username', config('services.gatekeeper.username', 'admin'));
        $expectedPassword = Setting::get('gatekeeper_password', config('services.gatekeeper.password', 'dinkes2026'));

        // Mencegah timing attack dengan hash_equals
        $isUsernameValid = hash_equals((string) $expectedUsername, (string) $request->username);
        $isPasswordValid = hash_equals((string) $expectedPassword, (string) $request->password);

        if ($isUsernameValid && $isPasswordValid) {
            RateLimiter::clear($throttleKey);

            $request->session()->put('gatekeeper_passed', true);
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Verifikasi Gerbang Lapis 1 berhasil!',
            ]);
        }

        RateLimiter::hit($throttleKey, 60);
        $remainingAttempts = RateLimiter::remaining($throttleKey, 5);

        return response()->json([
            'success' => false,
            'message' => "Username atau Password Gerbang tidak valid! (Sisa percobaan: {$remainingAttempts})",
            'remaining_attempts' => $remainingAttempts,
        ], 401);
    }

    /**
     * Handle standard database authentication (Lapis 2) with rate limiting.
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
            'password' => ['required', 'string'],
        ]);

        $throttleKey = 'login:'.Str::lower($request->input('email')).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return response()->json([
                'success' => false,
                'message' => "Terlalu banyak percobaan login gagal. Akun dikunci sementara selama {$seconds} detik.",
                'retry_after' => $seconds,
            ], 429);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($throttleKey);

            if (! Auth::user()->is_active) {
                Auth::logout();

                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda dinonaktifkan. Silakan hubungi administrator.',
                ], 403);
            }

            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil! Mengalihkan...',
            ]);
        }

        RateLimiter::hit($throttleKey, 60);
        $remainingAttempts = RateLimiter::remaining($throttleKey, 5);

        return response()->json([
            'success' => false,
            'message' => "Kredensial yang Anda masukkan tidak cocok dengan data kami. (Sisa percobaan: {$remainingAttempts})",
            'remaining_attempts' => $remainingAttempts,
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
