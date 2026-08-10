<?php

namespace App\Http\Controllers;

use App\Models\IkmRating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IkmController extends Controller
{
    public function index()
    {
        return view('ikm');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'rating' => 'required|in:sangat_puas,puas,cukup,kurang',
            'description' => 'nullable|string',
        ]);

        $ipAddress = $request->ip();

        // Cek apakah IP ini sudah submit dalam 7 hari terakhir
        $recentSubmission = IkmRating::where('ip_address', $ipAddress)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->first();

        if ($recentSubmission) {
            return redirect()->back()->with('error', 'Anda sudah memberikan penilaian dalam minggu ini. Terima kasih atas partisipasi Anda!');
        }

        // Simpan
        IkmRating::create([
            'name' => $request->name,
            'whatsapp' => $request->whatsapp,
            'rating' => $request->rating,
            'description' => $request->description,
            'ip_address' => $ipAddress,
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Penilaian Anda telah kami terima.');
    }
}
