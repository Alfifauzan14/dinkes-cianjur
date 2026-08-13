<?php

namespace App\Http\Controllers;

use App\Models\Faskes;
use App\Models\Kecamatan;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\LayananTerpadu;
use App\Models\Regulasi;
use App\Models\StatistikSetting;
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

        $puskesmasCount = Faskes::where('type', 'Puskesmas')->count();
        $rsCount = Faskes::where('type', 'Rumah Sakit')->count();
        $kecamatanCount = Kecamatan::count();
        $layananCount = LayananTerpadu::count();

        // Query sebaran faskes per kecamatan secara otomatis
        $allFaskes = Faskes::all();
        $faskesDistribution = $allFaskes->groupBy('kecamatan')->map(function ($items, $kecamatan) {
            return (object) [
                'kecamatan' => $kecamatan ?: 'Belum Ditentukan',
                'total' => $items->count(),
                'puskesmas' => $items->where('type', 'Puskesmas')->count(),
                'rs' => $items->where('type', 'Rumah Sakit')->count(),
                'list' => $items->pluck('name')->implode(', '),
            ];
        })->sortByDesc('total')->values();

        $maxFaskesCount = $faskesDistribution->max('total') ?: 1;

        return view('statistik', compact(
            'setting',
            'puskesmasCount',
            'rsCount',
            'kecamatanCount',
            'layananCount',
            'faskesDistribution',
            'maxFaskesCount'
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

        $kategoris = Kategori::ofType('regulasi')->orderBy('nama')->get();

        return view('regulasi', compact('regulasis', 'kategoris'));
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
