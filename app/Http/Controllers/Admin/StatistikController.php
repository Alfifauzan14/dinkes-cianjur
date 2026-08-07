<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikSetting;
use App\Models\StuntingRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class StatistikController extends Controller
{
    /**
     * Show the edit form for statistics dashboard.
     */
    public function edit(Request $request): View
    {
        $setting = StatistikSetting::firstOrCreate(
            ['id' => 1],
            [
                'status_badge' => 'Data Riil Semester I 2026',
                'indikator_data' => [
                    ['name' => 'PUSKESMAS', 'num' => '47', 'caption' => 'Seluruhnya Terakreditasi Paripurna'],
                    ['name' => 'RUMAH SAKIT RUJUKAN', 'num' => '8', 'caption' => '4 RSUD Pemda + 4 RS Swasta'],
                    ['name' => 'SDM KESEHATAN', 'num' => '3,820', 'caption' => 'Dokter, Perawat, Bidan, & Apoteker'],
                    ['name' => 'CAKUPAN IMUNISASI', 'num' => '94.8%', 'caption' => 'Target Nasional 2026: 95.0%'],
                ],
                'stunting_title' => 'Tren Jumlah Balita Stunting',
                'stunting_subtitle' => 'Kabupaten Cianjur 2014–2024',
                'nakes_data' => [
                    ['name' => 'Perawat Kesehatan', 'value' => 1604, 'width' => 42],
                    ['name' => 'Bidan Desa & Puskesmas', 'value' => 1184, 'width' => 31],
                    ['name' => 'Dokter Umum & Spesialis', 'value' => 573, 'width' => 15],
                    ['name' => 'Apoteker & Tenaga Kefarmasian', 'value' => 459, 'width' => 12],
                ],
                'sebaran_data' => [
                    ['name' => 'Zonasi Selatan', 'value' => 17, 'width' => 37],
                    ['name' => 'Zonasi Utara', 'value' => 16, 'width' => 35],
                    ['name' => 'Zonasi Tengah', 'value' => 14, 'width' => 30],
                ],
            ]
        );

        if (empty($setting->indikator_data)) {
            $indikatorData = [];
            for ($i = 1; $i <= 4; $i++) {
                $indikatorData[] = [
                    'name' => $setting->{"stat_{$i}_badge"} ?? '',
                    'num' => $setting->{"stat_{$i}_num"} ?? '',
                    'caption' => $setting->{"stat_{$i}_caption"} ?? '',
                ];
            }
            $setting->update(['indikator_data' => $indikatorData]);
            $setting->refresh();
        }

        $cleanedIndikator = array_map(function ($item) {
            $item['num'] = preg_replace('/[^0-9.\-]/', '', $item['num'] ?? '');

            return $item;
        }, $setting->indikator_data ?? []);
        $setting->indikator_data = $cleanedIndikator;

        $stuntingRecords = StuntingRecord::orderBy('year', 'asc')->get();

        $section = $request->query('section', 'indikator');
        if (! in_array($section, ['indikator', 'stunting', 'nakes', 'sebaran'])) {
            $section = 'indikator';
        }

        return view('admin.statistik.'.$section, compact('setting', 'stuntingRecords'));
    }

    /**
     * Update the statistics dashboard.
     */
    public function update(Request $request): RedirectResponse
    {
        $section = $request->input('section', 'indikator');
        $rules = [];

        if ($section === 'indikator') {
            $rules = [
                'status_badge' => 'nullable|string|max:100',
                'indikator_names' => 'nullable|array',
                'indikator_nums' => 'nullable|array',
                'indikator_captions' => 'nullable|array',
            ];
        } elseif ($section === 'stunting') {
            $rules = [
                'stunting_title' => 'required|string|max:255',
                'stunting_subtitle' => 'required|string|max:255',
                'stunting_years' => 'nullable|array',
                'stunting_balita_stunt' => 'nullable|array',
                'highlighted_year' => 'nullable|integer',
            ];
        } elseif ($section === 'nakes') {
            $rules = [
                'nakes_names' => 'nullable|array',
                'nakes_values' => 'nullable|array',
                'nakes_widths' => 'nullable|array',
            ];
        } elseif ($section === 'sebaran') {
            $rules = [
                'sebaran_names' => 'nullable|array',
                'sebaran_values' => 'nullable|array',
                'sebaran_widths' => 'nullable|array',
            ];
        }

        $request->validate($rules);

        $setting = StatistikSetting::firstOrCreate(['id' => 1]);

        if ($section === 'indikator') {
            $setting->update(['status_badge' => $request->input('status_badge') ?: null]);

            $indikatorData = [];
            if ($request->has('indikator_names')) {
                foreach ($request->indikator_names as $index => $name) {
                    if (! empty($name)) {
                        $num = $request->indikator_nums[$index] ?? '';
                        $num = preg_replace('/[^0-9.\-]/', '', $num);
                        $indikatorData[] = [
                            'name' => $name,
                            'num' => $num,
                            'caption' => $request->indikator_captions[$index] ?? '',
                        ];
                    }
                }
            }
            $setting->update(['indikator_data' => $indikatorData]);
        } elseif ($section === 'stunting') {
            $data = $request->only(['stunting_title', 'stunting_subtitle']);
            $setting->update($data);

            $submittedYears = [];
            if ($request->has('stunting_years')) {
                foreach ($request->stunting_years as $index => $year) {
                    if (! empty($year)) {
                        $yearInt = (int) $year;
                        $balitaStunt = (int) ($request->stunting_balita_stunt[$index] ?? 0);
                        $isHighlighted = ($yearInt === (int) $request->highlighted_year);

                        StuntingRecord::updateOrCreate(
                            ['year' => $yearInt],
                            [
                                'balita_stunting' => $balitaStunt,
                                'is_highlighted' => $isHighlighted,
                                'rate' => 0.0,
                            ]
                        );

                        $submittedYears[] = $yearInt;
                    }
                }
            }

            StuntingRecord::whereNotIn('year', $submittedYears)->delete();

            self::recalculateRates();

            if (! empty($request->highlighted_year)) {
                StuntingRecord::where('year', '!=', (int) $request->highlighted_year)->update(['is_highlighted' => false]);
                StuntingRecord::where('year', (int) $request->highlighted_year)->update(['is_highlighted' => true]);
            }
        } elseif ($section === 'nakes') {
            $nakesData = [];
            $totalNum = 0;
            $numValues = [];

            if ($request->has('nakes_names')) {
                foreach ($request->nakes_names as $index => $name) {
                    if (! empty($name)) {
                        $num = (int) ($request->nakes_values[$index] ?? 0);
                        $numValues[] = $num;
                        $totalNum += $num;
                        $nakesData[] = [
                            'name' => $name,
                            'value' => $num,
                            'width' => 0,
                        ];
                    }
                }
            }

            foreach ($nakesData as $i => &$item) {
                $item['width'] = $totalNum > 0 && ($numValues[$i] ?? 0) > 0
                    ? (int) round(($numValues[$i] / $totalNum) * 100)
                    : 0;
            }
            unset($item);

            $setting->update(['nakes_data' => $nakesData]);
        } elseif ($section === 'sebaran') {
            $sebaranData = [];
            $totalNum = 0;
            $numValues = [];

            if ($request->has('sebaran_names')) {
                foreach ($request->sebaran_names as $index => $name) {
                    if (! empty($name)) {
                        $num = (int) ($request->sebaran_values[$index] ?? 0);
                        $numValues[] = $num;
                        $totalNum += $num;
                        $sebaranData[] = [
                            'name' => $name,
                            'value' => $num,
                            'width' => 0,
                        ];
                    }
                }
            }

            foreach ($sebaranData as $i => &$item) {
                $item['width'] = $totalNum > 0 && ($numValues[$i] ?? 0) > 0
                    ? (int) round(($numValues[$i] / $totalNum) * 100)
                    : 0;
            }
            unset($item);

            $setting->update(['sebaran_data' => $sebaranData]);
        }

        return redirect()->route('admin.satudata.statistik.edit', ['section' => $section])
            ->with('success', 'Data Statistik berhasil diperbarui!');
    }

    /**
     * Show the CSV import form.
     */
    public function importForm(): View
    {
        $stuntingRecords = StuntingRecord::orderBy('year', 'asc')->get();

        return view('admin.statistik.import', compact('stuntingRecords'));
    }

    /**
     * Download a blank CSV template for stunting data.
     */
    public function downloadTemplate(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="template_stunting_cianjur.csv"'];
        $columns = ['jumlah_balita_stunting', 'tahun'];
        $examples = [
            ['26687', '2014'],
            ['26062', '2024'],
        ];

        $callback = function () use ($columns, $examples) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($examples as $example) {
                fputcsv($file, $example);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Process a CSV file upload for stunting records.
     */
    public function importCsv(Request $request): RedirectResponse
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:4096',
            'import_type' => 'required|in:government,template',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle);

        $imported = 0;
        $errors = [];
        $rowNum = 1;

        if ($request->import_type === 'government') {
            // Both government CSV and template use the same format
            while (($row = fgetcsv($handle)) !== false) {
                $rowNum++;
                $data = array_combine($header, $row);

                $kode = trim($data['kode_kabupaten_kota'] ?? '');
                if ($kode !== '3203') {
                    continue;
                }

                $tahun = (int) ($data['tahun'] ?? 0);
                $jumlah = (int) ($data['jumlah_balita_stunting'] ?? 0);

                if ($tahun === 0 || $jumlah < 0) {
                    $errors[] = "Baris {$rowNum}: Data tidak valid (tahun={$tahun}, jumlah={$jumlah}).";

                    continue;
                }

                StuntingRecord::updateOrCreate(
                    ['year' => $tahun],
                    ['balita_stunting' => $jumlah]
                );

                $imported++;
            }
        } else {
            // Template format: jumlah_balita_stunting,tahun (no kode_kabupaten_kota)
            while (($row = fgetcsv($handle)) !== false) {
                $rowNum++;
                $data = array_combine($header, $row);

                $tahun = (int) ($data['tahun'] ?? 0);
                $jumlah = (int) ($data['jumlah_balita_stunting'] ?? 0);

                if ($tahun === 0 || $jumlah < 0) {
                    $errors[] = "Baris {$rowNum}: Data tidak valid (tahun={$tahun}, jumlah={$jumlah}).";

                    continue;
                }

                StuntingRecord::updateOrCreate(
                    ['year' => $tahun],
                    ['balita_stunting' => $jumlah]
                );

                $imported++;
            }
        }

        fclose($handle);

        self::recalculateRates();

        if (StuntingRecord::where('is_highlighted', true)->count() > 1) {
            $lastHighlighted = StuntingRecord::where('is_highlighted', true)->orderBy('year', 'desc')->first();
            StuntingRecord::where('id', '!=', $lastHighlighted->id)->update(['is_highlighted' => false]);
        }

        $message = "Berhasil mengimpor {$imported} baris data stunting.";
        if (! empty($errors)) {
            $message .= ' Terdapat '.count($errors).' baris yang dilewati.';

            return redirect()->route('admin.satudata.statistik.import')
                ->with('success', $message)
                ->with('import_errors', $errors);
        }

        return redirect()->route('admin.satudata.statistik.import')->with('success', $message);
    }

    /**
     * Recalculate year-over-year rates for all stunting records.
     */
    private static function recalculateRates(): void
    {
        $records = StuntingRecord::orderBy('year', 'asc')->get();
        $previous = null;

        foreach ($records as $record) {
            $rate = self::calculateYearOverYear($record->balita_stunting, $previous);
            $record->update(['rate' => $rate]);
            $previous = $record->balita_stunting;
        }
    }

    /**
     * Calculate year-over-year change percentage.
     */
    private static function calculateYearOverYear(?int $current, ?int $previous): float
    {
        if ($previous === null || $previous === 0 || $current === null) {
            return 0.0;
        }

        return round(($current - $previous) / $previous * 100, 1);
    }
}
