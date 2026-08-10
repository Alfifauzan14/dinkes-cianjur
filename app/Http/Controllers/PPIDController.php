<?php

namespace App\Http\Controllers;

use App\Models\PpidKeberatan;
use App\Models\PpidPermohonan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PPIDController extends Controller
{
    /**
     * Display the PPID page.
     */
    public function index(): View
    {
        return view('ppid');
    }

    /**
     * Display the permohonan form.
     */
    public function permohonan(): View
    {
        return view('permohonan');
    }

    /**
     * Handle permohonan form submission.
     */
    public function storePermohonan(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_pemohon' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'numeric', 'digits:16'],
            'no_hp' => ['required', 'regex:/^[0-9]{10,13}$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'cara_memperoleh' => ['required', 'string', 'in:email,mengambil_langsung'],
            'cara_informasi' => ['nullable', 'string', 'in:melihat,mendengarkan,membaca,mencatat'],
            'bentuk_informasi' => ['nullable', 'string', 'in:softcopy,hardcopy'],
            'alamat' => ['required', 'string', 'max:1000'],
            'foto_ktp' => ['required', 'file', 'mimes:jpeg,png,jpg,webp,pdf', 'max:10240'],
            'jenis_informasi' => ['required', 'string'],
            'tujuan_penggunaan' => ['required', 'string'],
            'rincian_informasi' => ['required', 'string', 'max:5000'],
            'alasan_permohonan' => ['nullable', 'string', 'max:2000'],
            'format_informasi' => ['nullable', 'array'],
            'format_informasi.*' => ['string'],
            'persetujuan' => ['accepted'],
        ], [
            'nama_pemohon.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 16 digit angka.',
            'nik.numeric' => 'NIK harus 16 digit angka.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP harus berupa angka dan antara 10-13 digit.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'cara_memperoleh.required' => 'Cara memperoleh informasi wajib dipilih.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'foto_ktp.required' => 'Foto/Scan KTP wajib diunggah.',
            'foto_ktp.mimes' => 'Format file KTP harus berupa JPG, PNG, WEBP, atau PDF.',
            'foto_ktp.max' => 'Ukuran file KTP tidak boleh melebihi 10 MB.',
            'jenis_informasi.required' => 'Jenis informasi wajib dipilih.',
            'tujuan_penggunaan.required' => 'Tujuan penggunaan wajib dipilih.',
            'rincian_informasi.required' => 'Rincian informasi wajib diisi.',
            'persetujuan.accepted' => 'Anda harus menyetujui pernyataan di atas.',
        ]);

        $ktpPath = null;
        if ($request->hasFile('foto_ktp')) {
            $ktpPath = $request->file('foto_ktp')->store('ppid/ktp', 'public');
        }

        PpidPermohonan::create([
            'nama_pemohon' => $request->nama_pemohon,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'pekerjaan' => $request->pekerjaan,
            'cara_memperoleh' => $request->cara_memperoleh,
            'cara_informasi' => $request->cara_informasi,
            'bentuk_informasi' => $request->bentuk_informasi,
            'alamat' => $request->alamat,
            'foto_ktp' => $ktpPath,
            'jenis_informasi' => $request->jenis_informasi,
            'tujuan_penggunaan' => $request->tujuan_penggunaan,
            'rincian_informasi' => $request->rincian_informasi,
            'alasan_permohonan' => $request->alasan_permohonan,
            'format_informasi' => $request->bentuk_informasi ? [$request->bentuk_informasi] : [],
            'status' => 'pending',
        ]);

        return redirect()->route('permohonan')
            ->with('success', 'Permohonan informasi Anda berhasil dikirim. Kami akan memproses dalam 10 hari kerja dan menghubungi Anda melalui nomor HP yang terdaftar.');
    }

    /**
     * Display the keberatan form.
     */
    public function keberatan(): View
    {
        return view('keberatan');
    }

    /**
     * Check permohonan by token and email (AJAX).
     */
    public function cekPermohonan(Request $request): JsonResponse
    {
        $request->validate([
            'token' => ['required', 'string', 'size:7'],
            'email' => ['required', 'email'],
        ]);

        $permohonan = PpidPermohonan::where('token', $request->token)
            ->where('email', $request->email)
            ->first();

        if (! $permohonan) {
            return response()->json([
                'found' => false,
                'message' => 'Token atau email tidak sesuai. Pastikan data yang dimasukkan benar.',
            ]);
        }

        return response()->json([
            'found' => true,
            'data' => [
                'nama_pemohon' => $permohonan->nama_pemohon,
                'nik' => $permohonan->nik,
                'email' => $permohonan->email,
                'no_hp' => $permohonan->no_hp,
                'jenis_informasi' => $permohonan->jenis_informasi,
                'rincian_informasi' => $permohonan->rincian_informasi,
                'status' => $permohonan->status,
                'created_at' => $permohonan->created_at->format('d M Y'),
            ],
        ]);
    }

    /**
     * Display the cek status page.
     */
    public function cekStatus(): View
    {
        return view('cek-status');
    }

    /**
     * API to check permohonan status by token (AJAX).
     */
    public function cekStatusApi(Request $request): JsonResponse
    {
        $request->validate([
            'token' => ['required', 'string', 'size:7', 'alpha_num'],
        ]);

        $permohonan = PpidPermohonan::where('token', $request->token)->first();

        if (! $permohonan) {
            return response()->json([
                'found' => false,
                'message' => 'Token tidak ditemukan. Pastikan token yang dimasukkan benar.',
            ]);
        }

        $formatInformasi = $permohonan->format_informasi;
        if (is_string($formatInformasi)) {
            $formatInformasi = json_decode($formatInformasi, true) ?? array_filter(explode(',', $formatInformasi));
        }

        return response()->json([
            'found' => true,
            'data' => [
                'token' => $permohonan->token,
                'nama_pemohon' => $permohonan->nama_pemohon,
                'nik' => $permohonan->nik,
                'no_hp' => $permohonan->no_hp,
                'email' => $permohonan->email ?? '-',
                'pekerjaan' => $permohonan->pekerjaan,
                'alamat' => $permohonan->alamat,
                'foto_ktp' => $permohonan->foto_ktp,
                'jenis_informasi' => $permohonan->jenis_informasi,
                'tujuan_penggunaan' => $permohonan->tujuan_penggunaan,
                'cara_memperoleh' => $permohonan->cara_memperoleh,
                'format_informasi' => $formatInformasi,
                'rincian_informasi' => $permohonan->rincian_informasi,
                'alasan_permohonan' => $permohonan->alasan_permohonan,
                'status' => $permohonan->status,
                'tanggapan' => $permohonan->tanggapan,
                'file_tanggapan' => $permohonan->file_tanggapan,
                'created_at' => $permohonan->created_at->format('d M Y'),
                'updated_at' => $permohonan->updated_at->format('d M Y'),
            ],
        ]);
    }

    /**
     * Store a new keberatan.
     */
    public function storeKeberatan(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required', 'string', 'size:7'],
            'email' => ['required', 'email'],
            'alasan_keberatan' => ['required', 'string', 'max:5000'],
        ], [
            'token.required' => 'Token permohonan wajib diisi.',
            'token.size' => 'Token permohonan harus 7 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'alasan_keberatan.required' => 'Alasan keberatan wajib diisi.',
            'alasan_keberatan.max' => 'Alasan keberatan maksimal 5000 karakter.',
        ]);

        $permohonan = PpidPermohonan::where('token', $request->token)
            ->where('email', $request->email)
            ->first();

        if (! $permohonan) {
            return back()->withErrors([
                'token' => 'Token atau email tidak sesuai. Pastikan data yang dimasukkan benar.',
            ])->withInput();
        }

        PpidKeberatan::create([
            'permohonan_id' => $permohonan->id,
            'token' => $request->token,
            'email' => $request->email,
            'alasan_keberatan' => $request->alasan_keberatan,
            'status' => 'pending',
        ]);

        return redirect()->route('keberatan')
            ->with('success', 'Keberatan Anda berhasil dikirim. Kami akan menindaklanjuti dalam waktu yang ditentukan.');
    }
}
