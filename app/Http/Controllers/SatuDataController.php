<?php

namespace App\Http\Controllers;

use App\Models\Faskes;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Laporan;
use App\Models\LayananTerpadu;
use App\Models\Regulasi;
use App\Models\StatistikSetting;
use App\Services\WalagriApiClient;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SatuDataController extends Controller
{
    /**
     * Display the Satu Data Statistik page.
     */
    public function statistik(Request $request): View
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

        // Walagri API — filter bulan dari query param ?bulan=YYYY-MM, default bulan ini
        $bulan = $request->query('bulan');
        $selectedMonth = ($bulan && preg_match('/^\d{4}-\d{2}$/', $bulan))
            ? CarbonImmutable::createFromFormat('Y-m', $bulan)->startOfMonth()
            : CarbonImmutable::now()->startOfMonth();
        $startDate = $selectedMonth->format('Y-m-d');
        $endDate = $selectedMonth->isSameMonth(CarbonImmutable::now())
            ? CarbonImmutable::now()->format('Y-m-d')
            : $selectedMonth->endOfMonth()->format('Y-m-d');
        $cacheKey = "walagri.{$startDate}.{$endDate}";

        $walagri = Cache::get($cacheKey);
        if (! $walagri) {
            $client = WalagriApiClient::createFromEnv();
            $walagri = [
                'visits' => $client->getPatientVisits($startDate, $endDate),
                'diseases' => $client->getTopDiseases(10, $startDate, $endDate),
                'statusMale' => $client->getPatientStatus('male', $startDate, $endDate),
                'statusFemale' => $client->getPatientStatus('female', $startDate, $endDate),
                'professions' => $client->getTopProfessions(10, $startDate, $endDate),
            ];
            $allOk = collect($walagri)->every(fn ($r) => ! empty($r['success']));
            if ($allOk) {
                Cache::put($cacheKey, $walagri, 3600);
            } else {
                Log::warning('Walagri API partial failure', [
                    'failures' => collect($walagri)->filter(fn ($r) => empty($r['success']))->keys()->all(),
                ]);
            }
        }

        return view('satu-data.statistik', compact(
            'setting',
            'puskesmasCount',
            'rsCount',
            'kecamatanCount',
            'layananCount',
            'faskesDistribution',
            'maxFaskesCount',
            'walagri',
            'startDate',
            'endDate',
            'selectedMonth'
        ));
    }

    /**
     * Display the Satu Data Laporan page.
     */
    public function laporan(): View
    {
        $laporans = Laporan::orderBy('release_date', 'desc')->get();

        return view('satu-data.laporan', compact('laporans'));
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

        return view('satu-data.regulasi', compact('regulasis', 'kategoris'));
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
     * Increment downloads and directly download the laporan file.
     */
    public function downloadLaporan(Laporan $laporan)
    {
        $laporan->increment('downloads');
        $fullPath = storage_path('app/public/'.$laporan->file_path);

        if (file_exists($fullPath)) {
            $filename = Str::slug($laporan->title).'.pdf';

            return response()->download($fullPath, $filename);
        }

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
     * Increment downloads and directly download the regulasi file.
     */
    public function downloadRegulasi(Regulasi $regulasi)
    {
        $regulasi->increment('downloads');
        $fullPath = storage_path('app/public/'.$regulasi->file_path);

        if (file_exists($fullPath)) {
            $filename = Str::slug($regulasi->title).'.pdf';

            return response()->download($fullPath, $filename);
        }

        return redirect()->to(asset('storage/'.$regulasi->file_path));
    }
}
