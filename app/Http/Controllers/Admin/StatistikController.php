<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikSetting;
use App\Models\StuntingRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class StatistikController extends Controller
{
    /**
     * Show the edit form for statistics dashboard.
     */
    public function edit(): \Illuminate\View\View
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
                ],
            ]
        );

        $stuntingRecords = StuntingRecord::orderBy('year', 'asc')->get();

        return view('admin.statistik.edit', compact('setting', 'stuntingRecords'));
    }

    /**
     * Update the statistics dashboard.
     */
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'status_badge'          => 'required|string|max:100',
            'stat_1_num'            => 'required|string|max:50',
            'stat_1_badge'          => 'required|string|max:100',
            'stat_1_caption'        => 'required|string|max:255',
            'stat_2_num'            => 'required|string|max:50',
            'stat_2_badge'          => 'required|string|max:100',
            'stat_2_caption'        => 'required|string|max:255',
            'stat_3_num'            => 'required|string|max:50',
            'stat_3_badge'          => 'required|string|max:100',
            'stat_3_caption'        => 'required|string|max:255',
            'stat_4_num'            => 'required|string|max:50',
            'stat_4_badge'          => 'required|string|max:100',
            'stat_4_caption'        => 'required|string|max:255',
            'stunting_title'        => 'required|string|max:255',
            'stunting_subtitle'     => 'required|string|max:255',
            'stunting_trend_badge'  => 'required|string|max:100',
            'stunting_footer_note'  => 'required|string',
            'nakes_names'           => 'nullable|array',
            'nakes_values'          => 'nullable|array',
            'nakes_widths'          => 'nullable|array',
            'sebaran_names'         => 'nullable|array',
            'sebaran_values'        => 'nullable|array',
            'sebaran_widths'        => 'nullable|array',
            'stunting_years'        => 'nullable|array',
            'stunting_total_balita' => 'nullable|array',
            'stunting_balita_stunt' => 'nullable|array',
            'stunting_wil_terendah' => 'nullable|array',
            'stunting_wil_tertinggi'=> 'nullable|array',
            'stunting_catatan'      => 'nullable|array',
            'highlighted_year'      => 'nullable|integer',
        ]);

        // Process Nakes JSON array
        $nakesData = [];
        if ($request->has('nakes_names')) {
            foreach ($request->nakes_names as $index => $name) {
                if (!empty($name)) {
                    $nakesData[] = [
                        'name'  => $name,
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
                        'name'  => $name,
                        'value' => $request->sebaran_values[$index] ?? '',
                        'width' => (int) ($request->sebaran_widths[$index] ?? 0),
                    ];
                }
            }
        }

        // Update settings
        $setting = StatistikSetting::firstOrCreate(['id' => 1]);
        $setting->update([
            'status_badge'         => $request->status_badge,
            'stat_1_num'           => $request->stat_1_num,
            'stat_1_badge'         => $request->stat_1_badge,
            'stat_1_caption'       => $request->stat_1_caption,
            'stat_2_num'           => $request->stat_2_num,
            'stat_2_badge'         => $request->stat_2_badge,
            'stat_2_caption'       => $request->stat_2_caption,
            'stat_3_num'           => $request->stat_3_num,
            'stat_3_badge'         => $request->stat_3_badge,
            'stat_3_caption'       => $request->stat_3_caption,
            'stat_4_num'           => $request->stat_4_num,
            'stat_4_badge'         => $request->stat_4_badge,
            'stat_4_caption'       => $request->stat_4_caption,
            'stunting_title'       => $request->stunting_title,
            'stunting_subtitle'    => $request->stunting_subtitle,
            'stunting_trend_badge' => $request->stunting_trend_badge,
            'stunting_footer_note' => $request->stunting_footer_note,
            'nakes_data'           => $nakesData,
            'sebaran_data'         => $sebaranData,
        ]);

        // Process Stunting Trend records with extended detail columns
        $submittedYears = [];
        if ($request->has('stunting_years')) {
            foreach ($request->stunting_years as $index => $year) {
                if (!empty($year)) {
                    $yearInt      = (int) $year;
                    $totalBalita  = (int) ($request->stunting_total_balita[$index] ?? 0);
                    $balitaStunt  = (int) ($request->stunting_balita_stunt[$index] ?? 0);
                    $rate         = $totalBalita > 0
                        ? StuntingRecord::calculateRate($totalBalita, $balitaStunt)
                        : (float) ($request->stunting_rates[$index] ?? 0.0);
                    $isHighlighted = ($yearInt === (int) $request->highlighted_year);

                    StuntingRecord::updateOrCreate(
                        ['year' => $yearInt],
                        [
                            'rate'              => $rate,
                            'is_highlighted'    => $isHighlighted,
                            'total_balita'      => $totalBalita ?: null,
                            'balita_stunting'   => $balitaStunt ?: null,
                            'wilayah_terendah'  => $request->stunting_wil_terendah[$index] ?? null,
                            'wilayah_tertinggi' => $request->stunting_wil_tertinggi[$index] ?? null,
                            'catatan'           => $request->stunting_catatan[$index] ?? null,
                        ]
                    );

                    $submittedYears[] = $yearInt;
                }
            }
        }

        // Delete records not in the submitted list
        StuntingRecord::whereNotIn('year', $submittedYears)->delete();

        // Ensure correct highlight
        if (!empty($request->highlighted_year)) {
            StuntingRecord::where('year', '!=', (int) $request->highlighted_year)->update(['is_highlighted' => false]);
            StuntingRecord::where('year', (int) $request->highlighted_year)->update(['is_highlighted' => true]);
        }

        return redirect()->route('admin.satudata.statistik.edit')->with('success', 'Dashboard Statistik berhasil diperbarui!');
    }

    /**
     * Show the CSV import form.
     */
    public function importForm(): \Illuminate\View\View
    {
        $stuntingRecords = StuntingRecord::orderBy('year', 'asc')->get();
        return view('admin.statistik.import', compact('stuntingRecords'));
    }

    /**
     * Download a blank CSV template for stunting data.
     */
    public function downloadTemplate(): \Illuminate\Http\Response
    {
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="template_stunting.csv"'];
        $columns = ['year', 'total_balita', 'balita_stunting', 'wilayah_terendah', 'wilayah_tertinggi', 'catatan', 'is_highlighted'];
        $example = ['2026', '44100', '4451', 'Pacet', 'Naringgul', 'Target <10% tercapai', 'true'];

        $callback = function () use ($columns, $example) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fputcsv($file, $example);
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Process a CSV file upload for stunting records.
     */
    public function importCsv(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file   = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle); // skip header row

        $imported = 0;
        $errors   = [];
        $rowNum   = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $rowNum++;
            $data = array_combine($header, $row);

            // Validate required fields
            if (empty($data['year']) || !is_numeric($data['year'])) {
                $errors[] = "Baris {$rowNum}: Kolom 'year' wajib diisi dengan angka.";
                continue;
            }
            if (empty($data['total_balita']) || !is_numeric($data['total_balita'])) {
                $errors[] = "Baris {$rowNum}: Kolom 'total_balita' wajib diisi dengan angka.";
                continue;
            }
            if (empty($data['balita_stunting']) || !is_numeric($data['balita_stunting'])) {
                $errors[] = "Baris {$rowNum}: Kolom 'balita_stunting' wajib diisi dengan angka.";
                continue;
            }

            $totalBalita = (int) $data['total_balita'];
            $balitaStunt = (int) $data['balita_stunting'];

            if ($balitaStunt > $totalBalita) {
                $errors[] = "Baris {$rowNum}: 'balita_stunting' tidak boleh lebih besar dari 'total_balita'.";
                continue;
            }

            $isHighlighted = in_array(strtolower(trim($data['is_highlighted'] ?? '')), ['1', 'true', 'yes']);

            StuntingRecord::updateOrCreate(
                ['year' => (int) $data['year']],
                [
                    'total_balita'      => $totalBalita,
                    'balita_stunting'   => $balitaStunt,
                    'rate'              => StuntingRecord::calculateRate($totalBalita, $balitaStunt),
                    'wilayah_terendah'  => $data['wilayah_terendah'] ?? null,
                    'wilayah_tertinggi' => $data['wilayah_tertinggi'] ?? null,
                    'catatan'           => $data['catatan'] ?? null,
                    'is_highlighted'    => $isHighlighted,
                ]
            );

            $imported++;
        }

        fclose($handle);

        if ($isHighlightedSet = StuntingRecord::where('is_highlighted', true)->count() > 1) {
            // Keep only the last highlighted = true
            $lastHighlighted = StuntingRecord::where('is_highlighted', true)->orderBy('year', 'desc')->first();
            StuntingRecord::where('id', '!=', $lastHighlighted->id)->update(['is_highlighted' => false]);
        }

        $message = "Berhasil mengimpor {$imported} baris data stunting.";
        if (!empty($errors)) {
            $message .= ' Terdapat ' . count($errors) . ' baris yang dilewati.';
            return redirect()->route('admin.satudata.statistik.import')
                ->with('success', $message)
                ->with('import_errors', $errors);
        }

        return redirect()->route('admin.satudata.statistik.import')->with('success', $message);
    }
}
