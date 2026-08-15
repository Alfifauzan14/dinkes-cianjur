<?php

namespace App\Http\Controllers;

use App\Models\IkmRating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IkmController extends Controller
{
    public function index()
    {
        return view('ikm');
    }

    public function store(Request $request)
    {
        // Validasi Form Input & Google reCAPTCHA
        $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'rating' => 'required|in:sangat_puas,puas,cukup,kurang',
            'description' => 'nullable|string',
            'g-recaptcha-response' => 'required',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi.',
            'g-recaptcha-response.required' => 'Harap centang verifikasi "Saya bukan robot" terlebih dahulu.',
        ]);

        // Verifikasi reCAPTCHA ke Google API
        $recaptchaToken = $request->input('g-recaptcha-response');
        $secretKey = config('services.recaptcha.secret_key');

        if ($secretKey && ! app()->environment('testing')) {
            try {
                $verifyResponse = Http::withoutVerifying()
                    ->timeout(10)
                    ->asForm()
                    ->post('https://www.google.com/recaptcha/api/siteverify', [
                        'secret' => $secretKey,
                        'response' => $recaptchaToken,
                        'remoteip' => $request->ip(),
                    ]);

                if (! $verifyResponse->successful() || ! $verifyResponse->json('success')) {
                    return redirect()->back()->withInput()->with('error', 'Verifikasi Captcha gagal. Silakan coba centang kembali "Saya bukan robot".');
                }
            } catch (\Throwable $e) {
                logger()->error('reCAPTCHA Verification Error: '.$e->getMessage());
                if (! (app()->environment('local') && $secretKey === '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe')) {
                    return redirect()->back()->withInput()->with('error', 'Gagal terhubung ke layanan verifikasi Captcha. Silakan coba lagi.');
                }
            }
        }

        $ipAddress = $request->ip();

        // Simpan Penilaian (Tanpa batasan 7 hari, Waktu Indonesia WIB)
        IkmRating::create([
            'name' => $request->name,
            'whatsapp' => $request->whatsapp,
            'rating' => $request->rating,
            'description' => $request->description,
            'ip_address' => $ipAddress,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Penilaian Anda telah kami terima.');
    }
}
