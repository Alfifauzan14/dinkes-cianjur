<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikSetting;
use App\Models\StuntingRecord;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    /**
     * Show the edit form for statistics dashboard.
     */
    public function edit()
    {
        $setting = StatistikSetting::firstOrCreate(
            ['id' => 1],
            [
                'status_badge' => 'Data Riil Semester I 2026',
                'stat_1_num' => '47',
                'stat_1_badge' => '100% Aktif!',
                'stat_1_caption' => 'Seluruhnya Terakreditasi Paripurna',
                'stat_2_num' => '8',
                'stat_2_badge' => 'Mitra BPJS',
                'stat_2_caption' => '4 RSUD Pemda + 4 RS Swasta',
                'stat_3_num' => '3,820',
                'stat_3_badge' => 'Tersertifikasi',
                'stat_3_caption' => 'Dokter, Perawat, Bidan, & Apoteker',
                'stat_4_num' => '94.8%',
                'stat_4_badge' => '+3.2% YoY',
                'stat_4_caption' => 'Target Nasional 2026: 95.0%',
                'stunting_title' => 'Tren Penurunan Prevalensi Stunting',
                'stunting_subtitle' => 'Target Daerah Cianjur 2026: <10%',
                'stunting_trend_badge' => 'Tren Positif',
                'stunting_footer_note' => 'Penurunan sebesar -8.4% dalam 2 tahun melalui Program Pendampingan Keluarga Terpadu.',
                'nakes_data' => [
                    ['name' => 'Perawat Kesehatan', 'value' => '1,604 (42%)', 'width' => 42],
                    ['name' => 'Bidan Desa & Puskesmas', 'value' => '1,184 (31%)', 'width' => 31],
                    ['name' => 'Dokter Umum & Spesialis', 'value' => '573 (15%)', 'width' => 15],
                    ['name' => 'Apoteker & Tenaga Kefarmasian', 'value' => '459 (12%)', 'width' => 12],
                ],
                'sebaran_data' => [
                    ['name' => 'Zonasi Selatan', 'value' => '17 Puskesmas (36%)', 'width' => 36],
                    ['name' => 'Zonasi Utara', 'value' => '16 Puskesmas (34%)', 'width' => 34],
                    ['name' => 'Zonasi Tengah', 'value' => '14 Puskesmas (30%)', 'width' => 30],
                ]
            ]
        );

        $stuntingRecords = StuntingRecord::orderBy('year', 'asc')->get();

        return view('admin.statistik.edit', compact('setting', 'stuntingRecords'));
    }

    /**
     * Update the statistics dashboard.
     */
    public function update(Request $request)
    {
        $request->validate([
            // Subheader & Indikator
            'status_badge' => 'required|string|max:100',
            'stat_1_num' => 'required|string|max:50',
            'stat_1_badge' => 'required|string|max:100',
            'stat_1_caption' => 'required|string|max:255',
            'stat_2_num' => 'required|string|max:50',
            'stat_2_badge' => 'required|string|max:100',
            'stat_2_caption' => 'required|string|max:255',
            'stat_3_num' => 'required|string|max:50',
            'stat_3_badge' => 'required|string|max:100',
            'stat_3_caption' => 'required|string|max:255',
            'stat_4_num' => 'required|string|max:50',
            'stat_4_badge' => 'required|string|max:100',
            'stat_4_caption' => 'required|string|max:255',

            // Stunting
            'stunting_title' => 'required|string|max:255',
            'stunting_subtitle' => 'required|string|max:255',
            'stunting_trend_badge' => 'required|string|max:100',
            'stunting_footer_note' => 'required|string',

            // Progress lists JSON inputs
            'nakes_names' => 'nullable|array',
            'nakes_values' => 'nullable|array',
            'nakes_widths' => 'nullable|array',
            'sebaran_names' => 'nullable|array',
            'sebaran_values' => 'nullable|array',
            'sebaran_widths' => 'nullable|array',

            // Stunting trend records
            'stunting_years' => 'nullable|array',
            'stunting_rates' => 'nullable|array',
            'highlighted_year' => 'nullable|integer',
        ]);

        // Process Nakes JSON array
        $nakesData = [];
        if ($request->has('nakes_names')) {
            foreach ($request->nakes_names as $index => $name) {
                if (!empty($name)) {
                    $nakesData[] = [
                        'name' => $name,
                        'value' => $request->nakes_values[$index] ?? '',
                        'width' => (int) ($request->nakes_widths[$index] ?? 0),
                    ];
                }
            }
        }

        // Process Sebaran Zonasi JSON array
        $sebaranData = [];
        if ($request->has('sebaran_names')) {
            foreach ($request->sebaran_names as $index => $name) {
                if (!empty($name)) {
                    $sebaranData[] = [
                        'name' => $name,
                        'value' => $request->sebaran_values[$index] ?? '',
                        'width' => (int) ($request->sebaran_widths[$index] ?? 0),
                    ];
                }
            }
        }

        // Update settings
        $setting = StatistikSetting::firstOrCreate(['id' => 1]);
        $setting->update([
            'status_badge' => $request->status_badge,
            'stat_1_num' => $request->stat_1_num,
            'stat_1_badge' => $request->stat_1_badge,
            'stat_1_caption' => $request->stat_1_caption,
            'stat_2_num' => $request->stat_2_num,
            'stat_2_badge' => $request->stat_2_badge,
            'stat_2_caption' => $request->stat_2_caption,
            'stat_3_num' => $request->stat_3_num,
            'stat_3_badge' => $request->stat_3_badge,
            'stat_3_caption' => $request->stat_3_caption,
            'stat_4_num' => $request->stat_4_num,
            'stat_4_badge' => $request->stat_4_badge,
            'stat_4_caption' => $request->stat_4_caption,
            'stunting_title' => $request->stunting_title,
            'stunting_subtitle' => $request->stunting_subtitle,
            'stunting_trend_badge' => $request->stunting_trend_badge,
            'stunting_footer_note' => $request->stunting_footer_note,
            'nakes_data' => $nakesData,
            'sebaran_data' => $sebaranData,
        ]);

        // Process Stunting Trend records
        $submittedYears = [];
        if ($request->has('stunting_years')) {
            foreach ($request->stunting_years as $index => $year) {
                if (!empty($year)) {
                    $yearInt = (int)$year;
                    $rateFloat = (float)($request->stunting_rates[$index] ?? 0.0);
                    $isHighlighted = ($yearInt === (int)$request->highlighted_year);

                    StuntingRecord::updateOrCreate(
                        ['year' => $yearInt],
                        ['rate' => $rateFloat, 'is_highlighted' => $isHighlighted]
                    );

                    $submittedYears[] = $yearInt;
                }
            }
        }

        // Delete any stunting records not in the submitted list
        StuntingRecord::whereNotIn('year', $submittedYears)->delete();

        // Double check highlighted year assignment
        if (!empty($request->highlighted_year)) {
            StuntingRecord::where('year', '!=', (int)$request->highlighted_year)->update(['is_highlighted' => false]);
            StuntingRecord::where('year', (int)$request->highlighted_year)->update(['is_highlighted' => true]);
        }

        return redirect()->route('admin.satudata.statistik.edit')->with('success', 'Dashboard Statistik berhasil diperbarui!');
    }
}
