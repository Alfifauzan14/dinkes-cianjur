<?php

namespace App\Http\Controllers;

use App\Models\Faskes;
use App\Models\Kecamatan;
use App\Models\Laporan;
use App\Models\LayananTerpadu;
use App\Models\Regulasi;
use App\Models\StatistikSetting;
use App\Models\StuntingRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SatuDataController extends Controller
{
    /**
     * Display the Satu Data Statistik page.
     */
    public function statistik(): View
    {
        $setting = StatistikSetting::first() ?? new StatistikSetting;
        $stuntingRecords = StuntingRecord::orderBy('year', 'asc')->get();
        $maxRate = $stuntingRecords->max('balita_stunting') ?: 1;

        $puskesmasCount = Faskes::where('type', 'Puskesmas')->count();
        $rsCount = Faskes::where('type', 'Rumah Sakit')->count();
        $kecamatanCount = Kecamatan::count();
        $layananCount = LayananTerpadu::count();

        return view('statistik', compact(
            'setting',
            'stuntingRecords',
            'maxRate',
            'puskesmasCount',
            'rsCount',
            'kecamatanCount',
            'layananCount'
        ));
    }

    /**
     * Display the Satu Data Laporan page.
     */
    public function laporan(): View
    {
        $laporans = Laporan::orderBy('release_date', 'desc')->get();

        return view('laporan', compact('laporans'));
    }

    /**
     * Display the Satu Data Regulasi page.
     */
    public function regulasi(): View
    {
        $regulasis = Regulasi::orderBy('year', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('regulasi', compact('regulasis'));
    }

    /**
     * Increment views and redirect to the laporan file.
     */
    public function viewLaporan(Laporan $laporan): RedirectResponse
    {
        $laporan->increment('views');

        return redirect()->to(asset('storage/'.$laporan->file_path));
    }

    /**
     * Increment downloads and redirect to the laporan file.
     */
    public function downloadLaporan(Laporan $laporan): RedirectResponse
    {
        $laporan->increment('downloads');

        return redirect()->to(asset('storage/'.$laporan->file_path));
    }

    /**
     * Increment views and redirect to the regulasi file.
     */
    public function viewRegulasi(Regulasi $regulasi): RedirectResponse
    {
        $regulasi->increment('views');

        return redirect()->to(asset('storage/'.$regulasi->file_path));
    }

    /**
     * Increment downloads and redirect to the regulasi file.
     */
    public function downloadRegulasi(Regulasi $regulasi): RedirectResponse
    {
        $regulasi->increment('downloads');

        return redirect()->to(asset('storage/'.$regulasi->file_path));
    }
}
