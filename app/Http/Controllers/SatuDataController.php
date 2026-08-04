<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Regulasi;
use App\Models\StatistikSetting;
use App\Models\StuntingRecord;
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
        $maxRate = $stuntingRecords->max('rate') ?: 1;

        return view('statistik', compact('setting', 'stuntingRecords', 'maxRate'));
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
}
